<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\User;
use App\Models\UserDeliveryInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ViettelPostAPI;

class ViettelPostController extends Controller
{
    public function getService(Request $request)
    {
        try {
            // Thu thập thông tin từ request
            $inputDelivery = $request->only(['sender_id', 'receiver_id']);
            $product = $request->only(['weight', 'price', 'length', 'width', 'height']);
            // Tìm thông tin giao hàng của người gửi và người nhận
            $sender = UserDeliveryInfo::find($inputDelivery['sender_id']);
            $receiver = UserDeliveryInfo::find($inputDelivery['receiver_id']);

            // Kiểm tra người gửi và người nhận có tồn tại không
            if (!$sender || !$receiver) {
                return response()->json(['error' => 'Không tìm thấy thông tin người gửi hoặc người nhận.'], 404);
            }
            // xóa " -" chuyen sang ","
            $sender->address = str_replace(' -', ',', $sender->address);
            $receiver->address = str_replace(' -', ',', $receiver->address);
            // Chuẩn bị dữ liệu cho API
            $input = [
                "SENDER_DISTRICT" => $sender->district_id,
                "SENDER_PROVINCE" => $sender->province_id,
                "RECEIVER_DISTRICT" => $receiver->district_id,
                "RECEIVER_PROVINCE" => $receiver->province_id,
                "PRODUCT_TYPE" => "HH",
                "PRODUCT_WEIGHT" => $product['weight'],
                "PRODUCT_PRICE" => $product['price'],
                "MONEY_COLLECTION" => "0",
                "PRODUCT_LENGTH" => $product['length'],
                "PRODUCT_WIDTH" => $product['width'],
                "PRODUCT_HEIGHT" => $product['height'],
                "TYPE" => 1,
            ];
            // Gọi API để lấy dịch vụ
            $ViettelPostAPI = new ViettelPostAPI();
            $response = $ViettelPostAPI->getService($input);

            // Trả về phản hồi từ API
            return response()->json($response);

        } catch (\Exception $e) {
            // Xử lý ngoại lệ nếu có
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }


    public function getPrice(Request $request)
    {
        try {
            $sender = UserDeliveryInfo::find($request->get('sender_id'));
            $receiver = UserDeliveryInfo::find($request->get('receiver_id'));

            // Check if sender and receiver information is found
            if (!$sender || !$receiver) {
                return response()->json(['error' => 'Không tìm thấy thông tin người gửi hoặc người nhận.'], 204); // No Content
            }

            $data = [
                "PRODUCT_WEIGHT" => $request->input('weight'),
                "PRODUCT_PRICE" => $request->input('price'),
                "MONEY_COLLECTION" => 0,
                "ORDER_SERVICE_ADD" => $request->input('service_add'),
                "ORDER_SERVICE" => $request->input('service'),
                "SENDER_DISTRICT" => $sender->district_id,
                "SENDER_PROVINCE" => $sender->province_id,
                "RECEIVER_DISTRICT" => $receiver->district_id,
                "RECEIVER_PROVINCE" => $receiver->province_id,
                "PRODUCT_LENGTH" => $request->input('length'),
                "PRODUCT_WIDTH" => $request->input('width'),
                "PRODUCT_HEIGHT" => $request->input('height'),
                "PRODUCT_TYPE" => "HH",
                "NATIONAL_TYPE" => 1
            ];
//            $data = [
//                "PRODUCT_WEIGHT" => 100,
//                "PRODUCT_PRICE" => 96000,
//                "MONEY_COLLECTION" => 0,
//                "ORDER_SERVICE_ADD" => "",
//                "ORDER_SERVICE" => "VCBO",
//                "SENDER_DISTRICT" => 12,
//                "SENDER_PROVINCE" => 1,
//                "RECEIVER_DISTRICT" => 12,
//                "RECEIVER_PROVINCE" => 1,
//                "PRODUCT_LENGTH" => 0,
//                "PRODUCT_WIDTH" => 0,
//                "PRODUCT_HEIGHT" => 0,
//                "PRODUCT_TYPE" => "HH",
//                "NATIONAL_TYPE" => 1
//            ];
            // Call API to get price
            $ViettelPostAPI = new ViettelPostAPI();
            $response = $ViettelPostAPI->getPrice($data);

            // Return API response
            return response()->json($response);
        } catch (\Exception $e) {
            // Handle exceptions that occur during API call or data processing
            return response()->json(['error' => 'Lỗi xử lý yêu cầu: ' . $e->getMessage()], 500);
        }
    }


    public function createOrder(Request $request)
    {
        $sender = Auth::user()->deliveryInfo;
        $receiver = User::find($request->receiver_id)->deliveryInfo;
        $product = $request->input(['weight', 'price', 'length', 'width', 'height', 'product_name','note','quantity']);
        $order = $request->input(['order_servie', 'order_note']);
        $contract = $request->input(['contract_id']);
        $listProduct = Product::where('contract_id', $contract)->get();
        $listItem = [];
        foreach ($listProduct as $product) {
            $listItem[] = [
                "PRODUCT_NAME" => $product->name,
                "PRODUCT_QUANTITY" => $product->quantity,
                "PRODUCT_PRICE" => $product->price,
                'PRODUCT_WEIGHT' => 100,
            ];
        }
        $orderDetails = [
            "SENDER_FULLNAME" => $sender->name,
            "SENDER_ADDRESS" => $sender->address,
            "SENDER_PHONE" => $sender->phone,
            "RECEIVER_FULLNAME" => $receiver->name,
            "RECEIVER_ADDRESS" => $receiver->address,
            "RECEIVER_PHONE" => $receiver->phone,
            "PRODUCT_NAME" => $product['product_name'],
            "PRODUCT_DESCRIPTION" => $product['note'],
            "PRODUCT_QUANTITY" => $product['quantity'],
            "PRODUCT_PRICE" => $product['price'],
            "PRODUCT_WEIGHT" => $product['weight'],
            "PRODUCT_LENGTH" => $product['length'],
            "PRODUCT_WIDTH" => $product['width'],
            "PRODUCT_HEIGHT" => $product['height'],
            "ORDER_PAYMENT" => 3,
            "ORDER_SERVICE" => $order['order_service'],
            "PRODUCT_TYPE" => "HH",
            "ORDER_SERVICE_ADD" => null,
            "ORDER_NOTE" => $order['order_note'],
            "MONEY_COLLECTION" => 56827,
            "EXTRA_MONEY" => 0,
            "CHECK_UNIQUE" => true,
            "LIST_ITEM" => $listItem
        ];
        $ViettelPostAPI = new ViettelPostAPI();
        $response = $ViettelPostAPI->createOrder($orderDetails);
        return response()->json($response);
    }
}
