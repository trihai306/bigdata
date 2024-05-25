<?php

namespace App\Restify;

use App\Models\Contract;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ContractRepository extends Repository
{
    public static string $model = Contract::class;
    public static array $search = [
        'invoice_image', 'product_image', 'description', 'total_amount', 'deposit_amount', 'confirmation_a', 'confirmation_b', 'confirmation_c', 'terms_agreed', 'status', 'estimated_delivery_date'
    ];
    public static function indexQuery(RestifyRequest $request, Relation|Builder $query): Builder
    {
        $query->whereHas('partyAInfo', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        })->orWhereHas('partyBInfo', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });

        return parent::indexQuery($request, $query);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('invoice_image'),
            field('product_image'),
            field('description'),
            field('total_amount')->rules('required'),
            field('deposit_amount')->rules('required'),
            field('confirmation_a'),
            field('confirmation_b'),
            field('confirmation_c'),
            field('terms_agreed'),
            field('status'),
            field('estimated_delivery_date'),
        ];
    }
}
