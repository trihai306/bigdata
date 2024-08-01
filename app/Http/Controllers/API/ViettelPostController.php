<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ViettelPostAPI;

class ViettelPostController extends Controller
{
    public function getService(Request $request)
    {
        $sender = Auth::user()->deliveryInfo;
        $receiver = User::find($request->receiver_id)->deliveryInfo;
        $product = $request->input(['weight', 'price', 'length', 'width', 'height']);
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
        $ViettelPostAPI = new ViettelPostAPI();
        $response = $ViettelPostAPI->getService($input);
        return response()->json($response);
    }

    public function getPrice(Request $request)
    {
        $sender = Auth::user()->deliveryInfo;
        $receiver = User::find($request->receiver_id)->deliveryInfo;
        $product = $request->input(['weight', 'price', 'length', 'width', 'height']);
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
