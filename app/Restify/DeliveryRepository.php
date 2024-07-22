<?php

namespace App\Restify;

use App\Models\Delivery;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Repositories\Repository;

class DeliveryRepository extends Repository
{
    public static string $model = Delivery::class;
    public static int $globalSearchResults = 10;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),

            Field::make('scheduled_delivery_time')
                ->rules('required', 'date_format:Y-m-d H:i:s')
                ->messages([
                    'required' => 'Thời gian giao hẹn là bắt buộc.',
                    'date_format' => 'Thời gian giao hẹn phải theo định dạng Y-m-d H:i:s.',
                ]),
            Field::make('shipping_code')->canStore(fn()=>false)->canUpdate(fn()=>false),
            Field::make('special_nature')
                ->rules('nullable', 'string'),

            Field::make('package_image')->canStore(fn()=>false)->canUpdate(fn()=>false),

            Field::make('length')
                ->rules('required', 'numeric')
                ->messages([
                    'required' => 'Chiều dài là bắt buộc.',
                    'numeric' => 'Chiều dài phải là một số.',
                ]),

            Field::make('width')
                ->rules('required', 'numeric')
                ->messages([
                    'required' => 'Chiều rộng là bắt buộc.',
                    'numeric' => 'Chiều rộng phải là một số.',
                ]),

            Field::make('height')
                ->rules('required', 'numeric')
                ->messages([
                    'required' => 'Chiều cao là bắt buộc.',
                    'numeric' => 'Chiều cao phải là một số.',
                ]),

            Field::make('delivery_service')
                ->rules('required', 'string')
                ->messages([
                    'required' => 'Dịch vụ chuyển phát là bắt buộc.',
                ]),

            Field::make('additional_services')
                ->rules('nullable', 'array'),

            Field::make('order_note')
                ->rules('nullable', 'string'),

            Field::make('status')
                ->rules('required', 'string')
                ->messages([
                    'required' => 'Trạng thái đơn hàng là bắt buộc.',
                ]),

            Field::make('user_delivery_info_id')
                ->rules('required', 'exists:user_delivery_infos,id')
                ->messages([
                    'required' => 'Thông tin người dùng vận chuyển là bắt buộc.',
                    'exists' => 'Thông tin người dùng vận chuyển phải tồn tại trong hệ thống.',
                ])
        ];
    }

    public static function stored($resource, RestifyRequest $request){
        if($request->hasFile('package_image')){
            $package_images = [];
            //lưu nhiều ảnh ảnh vào storage thư mục delivery/id cho từng delivery
            foreach($request->file('package_image') as $file){
                $path = $file->store('delivery/'.$resource->id);
                $package_images[] = $path;
            }
            //decode thành json để lưu vào db
            $resource->package_image = json_encode($package_images);
            $resource->save();
        }

    }

    public static function related(): array
    {
        return [
            'goods' => GoodRepository::class,
            'userDeliveryInfo' => UserDeliveryInfoRepository::class,
        ];
    }
}
