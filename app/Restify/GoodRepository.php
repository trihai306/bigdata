<?php

namespace App\Restify;

use App\Models\Delivery;
use App\Models\Good;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Repositories\Repository;

class GoodRepository extends Repository
{
    public static string $model = Good::class;
    public static int $globalSearchResults = 10;
    public static array $match = [
        'name' => 'string',
        'quantity' => 'string',
        'weight' => 'string',
        'delivery_id' => 'string',
    ];
    public static array $search = ['name', 'quantity', 'weight', 'delivery_id'];
    public static array $sort = ['id', 'name', 'quantity', 'weight', 'delivery_id'];

    public static function indexQuery(RestifyRequest $request, $query)
    {
      $delivery =   Delivery::findOrFail($request->get('delivery_id'));
      if(!$delivery){
          return response()->json(['message' => 'chưa tạo vận chuyển'], 404);
      }
        return parent::indexQuery($request, $query);
    }
    public function fields(RestifyRequest $request): array
    {
        return [
            id(),

            Field::make('name')
                ->rules('required', 'string', 'max:255'),

            Field::make('quantity')
                ->rules('required', 'integer', 'min:1'),

            Field::make('weight')
                ->rules('required', 'numeric', 'min:0'),

            Field::make('delivery_id')
                ->rules('required', 'exists:deliveries,id')
        ];
    }
}
