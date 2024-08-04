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
        try {
            $sender = UserDeliveryInfo::find($request->get('sender_id'));
            $receiver = UserDeliveryInfo::find($request->get('receiver_id'));
            if (!$sender || !$receiver) {
                throw new \Exception("Không tìm thấy thông tin người gửi hoặc người nhận.");
            }

            $product = $request->input(['weight', 'price', 'length', 'width', 'height', 'product_name', 'note', 'quantity']);
            $order = $request->input(['order_service', 'order_note', 'order_service_add']);
            $contract = $request->input('contract_id');

            $listProduct = Product::where('contract_id', $contract)->get();
            if ($listProduct->isEmpty()) {
                throw new \Exception("Không tìm thấy sản phẩm nào cho mã hợp đồng đã cung cấp.");
            }

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
                "SENDER_FULLNAME" => $sender->receiver_name,
                "SENDER_ADDRESS" => $sender->address,
                "SENDER_PHONE" => $sender->phone,
                "RECEIVER_FULLNAME" => $receiver->receiver_name,
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
                "ORDER_SERVICE_ADD" => $order['order_service_add'],
                "ORDER_NOTE" => $order['order_note'],
                "MONEY_COLLECTION" => 56827,
                "EXTRA_MONEY" => 0,
                "CHECK_UNIQUE" => true,
                "LIST_ITEM" => $listItem
            ];

            $ViettelPostAPI = new ViettelPostAPI();
            $response = $ViettelPostAPI->createOrder($orderDetails);
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

}
