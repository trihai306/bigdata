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

            // Chuẩn bị dữ liệu cho API
            $input = [
                "SENDER_ADDRESS" => $sender->address,
                "RECEIVER_ADDRESS" => $receiver->address,
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
            dd($input);
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
       $inputDelivery = $request->input(['sender_id', 'receiver_id']);
        $product = $request->input(['weight', 'price', 'length', 'width', 'height']);
        $sender = UserDeliveryInfo::find($inputDelivery['sender_id']);
        $receiver = UserDeliveryInfo::find($inputDelivery['receiver_id']);

        if (!$sender || !$receiver) {
            return response()->json(['error' => 'Không tìm thấy thông tin người gửi hoặc người nhận.'], 204);
        }

        $data = [
            "PRODUCT_WEIGHT" => $product['weight'],
            "PRODUCT_PRICE" => $product['price'],
            "MONEY_COLLECTION" => 0,
            "ORDER_SERVICE_ADD" => "",
            "ORDER_SERVICE" => $request->input('service'),
             "SENDER_ADDRESS" => $sender->address,
            "RECEIVER_ADDRESS" => $receiver->address,
            "PRODUCT_LENGTH" => $product['length'],
            "PRODUCT_WIDTH" => $product['width'],
            "PRODUCT_HEIGHT" => $product['height'],
            "PRODUCT_TYPE" => "HH",
            "NATIONAL_TYPE" => 1
        ];
        $ViettelPostAPI = new ViettelPostAPI();
        $response = $ViettelPostAPI->getPrice($data);
        return response()->json($response);
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
                'PRODUCT_WEIGHT' => 50,
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

    }
}
