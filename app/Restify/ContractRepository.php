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
        'id',
        'description',
        'status',
    ];

    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
//        $query->whereHas('partyAInfo', function ($q) use ($request) {
//            $q->where('user', auth()->user()->account_number);
//        });
        return parent::indexQuery($request, $query);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('invoice_image'),
            field('product_image'),
            field('description'),
            field('total_amount'),
            field('deposit_amount'),
            field('confirmation_a'),
            field('confirmation_b'),
            field('confirmation_c'),
            field('terms_agreed'),
            field('status'),
            field('estimated_delivery_date')
        ];
    }

    public static function related()
    {
        return [
            'partyAInfo',
            'partyBInfo',
        ];
    }
}
