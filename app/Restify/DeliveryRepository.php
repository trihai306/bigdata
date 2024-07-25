<?php

namespace App\Restify;

use App\Models\Delivery;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class DeliveryRepository extends Repository
{
    public static string $model = Delivery::class;
    public static int $globalSearchResults = 10;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),

            Field::make('scheduled_delivery_time')
                ->rules('required', 'in:full_day,morning,afternoon,night,sunday,holiday,time_work')
                ->messages([
                    'required' => 'Thời gian giao hàng dự kiến là bắt buộc.',
                    'in' => 'Thời gian giao hàng dự kiến phải là một trong những tùy chọn được định trước.',
                ]),

            Field::make('contract_id')
                ->rules('required', 'string', 'exists:contracts,id')
                ->messages([
                    'required' => 'Mã hợp đồng là bắt buộc.',
                    'exists' => 'Mã hợp đồng phải tồn tại trong hệ thống.',
                ]),
            Field::make('special_nature')
                ->rules('nullable', 'string'),

            Field::make('package_image')
                ->rules('nullable', 'array'),

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
                ->rules('required', 'string', 'in:economical_delivery,fast_ecommerce_package,express_ecommerce_package')
                ->messages([
                    'required' => 'Dịch vụ giao hàng là bắt buộc.',
                    'in' => 'Dịch vụ giao hàng phải là một trong các tùy chọn hợp lệ.',
                ]),

            Field::make('additional_services')
                ->rules('nullable', 'array'),

            Field::make('order_note')
                ->rules('nullable', 'string'),

            Field::make('status')
                ->rules('required', 'in:picking_up,picked_up,in_transit,delivering,awaiting_redelivery,successfully_delivered,awaiting_processing,return_approved,returned,delivery_cancelled,returning,continue_delivery,shop_cancelled_pickup,vtp_cancelled_pickup')
                ->messages([
                    'required' => 'Trạng thái đơn hàng là bắt buộc.',
                    'in' => 'Trạng thái đơn hàng phải là một trong các tùy chọn hợp lệ.',
                ]),

            Field::make('user_delivery_info_id')
                ->rules('required')
                ->messages([
                    'required' => 'Thông tin người gửi là bắt buộc.'
                ])
        ];
    }

    public static function stored($resource, RestifyRequest $request){
        if($request->hasFile('package_image')){
            $package_images = [];
            // Lưu nhiều ảnh vào thư mục 'delivery/id' cho mỗi đơn hàng
            foreach($request->file('package_image') as $file){
                $path = $file->store('delivery/'.$resource->id);
                $package_images[] = $path;
            }
            // Encode thành JSON để lưu vào cơ sở dữ liệu
            $resource->package_image = json_encode($package_images);
            $resource->save();
        }
    }


    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
        // so sánh user id trong contract với user dăng nhập theo inforparty a va b truy câập vào info party a và b so sánh theo user_id
        $query->whereHas('contract', function($q) use ($request){
          $q->whereHas('partyAInfo', function($q) use ($request){
              $q->where('user_id', $request->user()->id);
          })->orWhereHas('partyBInfo', function($q) use ($request){
              $q->where('user_id', $request->user()->id);
          });
        });
        return parent::indexQuery($request, $query);

    }

    public static function related(): array
    {
        return [
            'goods' => GoodRepository::class,
            'userDeliveryInfo' => UserDeliveryInfoRepository::class,
        ];
    }
}