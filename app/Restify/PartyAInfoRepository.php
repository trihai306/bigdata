<?php

namespace App\Restify;

use App\Models\Contract;
use App\Models\PartyAInfo;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

class PartyAInfoRepository extends Repository
{
    public static string $model = PartyAInfo::class;
    public static array $search = ['account_number', 'email', 'bank_name', 'address', 'recipient_name'];
    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
       $user = $request->user();
       $request->merge(['user_id' => $user->id]);
        return parent::indexQuery($request, $query); // TODO: Change the autogenerated stub
    }

    public function store(RestifyRequest $request)
    {
        $request->merge(['user_id' => $request->user()->id]);
        if (Auth::user()->type == 'seller') {
            return response()->json(['message' => 'Bạn không có quyền thực hiện hành động này'], 403);
        }
        return parent::store($request);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('user_id'), // Add this line
            field('account_number')->rules('required')->messages([
                'required' => 'Số tài khoản không được để trống',
            ]),
            field('district_id')->rules('required')->messages([
                'required' => 'Quận/Huyện không được để trống',
            ]),
            field('province_id')->rules('required')->messages([
                'required' => 'Tỉnh/Thành phố không được để trống',
            ]),
            field('email')->rules('email')->messages([
                'email' => 'Email không hợp lệ',
            ]),
            field('bank_name')->rules('required')->messages([
                'required' => 'Tên ngân hàng không được để trống',
            ]),
            field('address')->rules('required')->messages([
                'required' => 'Địa chỉ không được để trống',
            ]),
            field('recipient_name')->rules('required')->messages([
                'required' => 'Tên người nhận không được để trống',
            ])
            ];
    }
}
