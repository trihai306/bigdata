<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use SpeedSMSAPI;
use Ichtrojan\Otp\Otp;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => ['required', 'numeric', 'unique:users', 'regex:/^(0|(\+84))[3|5|7|8|9][0-9]{8}$/'],
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|string|same:password',
                'address' => 'required|string',
                'store_name' => 'required|string',
                'type' => 'required|string|in:buyer,seller',
                'field' => 'required_if:type,seller|string|in:leather_goods,clothing,all',
            ]);

            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);
            $otp = (new Otp)->generate($user->phone, 'numeric', 6, 6);
            $sms = new SpeedSMSAPI('X5ypO-zjgfecptVf1C5vLVJ0MdyMZPzr');
           $sms->sendSMS([$user->phone], 'Ma xac thuc SPEEDSMS.VN cua ban la ' . $otp->token,
                SpeedSMSAPI::SMS_TYPE_CSKH, 'SPEEDSMS.VN');
            return response()->json([
                'message' => 'Đăng ký tài khoản thành công',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'phone' => ['required', 'numeric', 'regex:/^(0|(\+84))[3|5|7|8|9][0-9]{8}$/','exists:users'],
                'password' => 'required|string',
                'phone_token' => 'string',
            ]);

            $user = User::where('phone', $request->phone)->first();
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Thông tin đăng nhập không hợp lệ'], 401);
            }

            // Check if the user's account has been validated
            if (!$user->validated) {
                return response()->json(['message' => 'Tài khoản chưa được xác thực'], 401);
            }

            if ($request->has('phone_token')) {
                $user->phone_token = $request->phone_token;
                $user->save();
            }

            // Xóa tất cả các token hiện có của người dùng
            $user->tokens()->delete();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function getProfile(Request $request)
    {
        return response()->json($request->user());
    }

    public function editProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|max:255',
            'phone' => ['numeric', 'regex:/^(0|(\+84))[3|5|7|8|9][0-9]{8}$/'],
            'address' => 'string',
            'store_name' => 'string',
            'type' => 'string|in:buyer,seller',
            'field' => 'type,seller|string|in:leather_goods,clothing,all',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data['avatar'] = $filename;
        }

        $user = $request->user();
        $user->update($data);

        return response()->json(['message' => 'Cập nhật thông tin thành công','user'=>$user], 200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Người dùng đã đăng xuất']);
    }

    public function forgotPassword(Request $request)
    {
        try {
            $request->validate(['phone' => ['required', 'numeric', 'regex:/^(0|(\+84))[3|5|7|8|9][0-9]{8}$/']]);

            $user = User::where('phone', $request->phone)->first();

            if (!$user) {
                return response(['message' => 'Không tìm thấy người dùng'], 404);
            }

            $token = Str::random(60);
            $user->password_reset_token = hash('sha256', $token);
            $user->save();

            Mail::raw("Mã token để đặt lại mật khẩu của bạn là: $token", function ($message) use ($user) {
                $message->to($user->phone . '@your-sms-gateway.com')
                    ->subject('Mã Token Đặt Lại Mật Khẩu');
            });

            return response(['message' => 'Đã gửi mã token đặt lại mật khẩu.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'phone' => ['required', 'numeric', 'regex:/^(0|(\+84))[3|5|7|8|9][0-9]{8}$/'],
                'token' => 'required|string',
                'password' => 'required|string|min:6'
            ]);

            $user = User::where('phone', $request->phone)
                ->where('password_reset_token', hash('sha256', $request->token))
                ->first();

            if (!$user) {
                return response(['message' => 'Token không hợp lệ hoặc đã hết hạn.'], 400);
            }

            $user->password = Hash::make($request->password);
            $user->password_reset_token = null;
            $user->save();

            return response(['message' => 'Cập nhật mật khẩu thành công.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:6'
            ]);

            $user = $request->user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response(['message' => 'Mật khẩu hiện tại không chính xác.'], 400);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return response(['message' => 'Đổi mật khẩu thành công.'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function sendOTP(Request $request)
    {
//        $sms = new SpeedSMSAPI('X5ypO-zjgfecptVf1C5vLVJ0MdyMZPzr');
//        $sms = $sms->sendSMS(['84396130621'], 'Ma xac thuc SPEEDSMS.VN cua ban la 12345',
//            SpeedSMSAPI::SMS_TYPE_CSKH, 'SPEEDSMS.VN');
        $otp = (new Otp)->generate('abc', 'numeric', 6, 6)->token;
        return response(['message' => $otp], 200);
    }

    public function veriOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|string',
            'phone' => 'required|string'
        ]);

        $otp = (new Otp)->validate($request->phone, $request->otp);

        if (!$otp) {
            return response(['message' => 'Xác thực thất bại'], 400);
        }

        $user = User::where('phone', $request->phone)->firstOrFail();
        $user->update(['validated' => true]);

        return response(['message' => 'Xác thực thành công'], 200);
    }
}
