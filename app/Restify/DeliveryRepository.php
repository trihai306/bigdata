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
            field('name'),
            field('code'),
            field('contract_id'),
            field('package_image'),
            file('product_length'),
            file('product_width'),
            file('product_height'),
            file('product_weight'),
            field('product_note'),
            field('delivery_user_a_info'),
            field('delivery_user_b_info'),
            field('list_products'),
            field('money_total_ship'),
            field('order_note'),
            field('order_service'),
            field('order_service_add'),
            field('status'),
            field('created_at'),
            field('updated_at'),
        ];
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
            'userDeliveryInfo' => UserDeliveryInfoRepository::class,
        ];
    }
}
