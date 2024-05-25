<?php

namespace App\Restify;

use App\Models\PartyAInfo;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class PartyAInfoRepository extends Repository
{
    public static string $model = PartyAInfo::class;
    public static array $search = [
        'contract_id', 'account_number', 'email', 'bank_name', 'address', 'recipient_name'
    ];
    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
        $query->whereHas('contract', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });
        return parent::indexQuery($request, $query); // TODO: Change the autogenerated stub
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('user_id')->rules('required'), // Add this line
            field('contract_id')->rules('required'),
            field('account_number')->rules('required'),
            field('email')->rules( 'email'),
            field('bank_name')->rules('required'),
            field('address')->rules('required'),
            field('recipient_name')->rules('required'),
        ];
    }
}
