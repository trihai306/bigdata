<?php

namespace App\Restify;

use App\Models\PartyBInfo;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class PartyBInfoRepository extends Repository
{
    public static string $model = PartyBInfo::class;
    public static array $search = [
        'contract_id', 'email', 'user_id', 'tax_id', 'bank_account_number', 'bank_name', 'business_name', 'position', 'address', 'phone_number', 'full_name'
    ];
    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
        $query->whereHas('contract', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });
        return parent::indexQuery($request, $query);
    }

    public function store(RestifyRequest $request)
    {
        $request->merge(['user_id' => $request->user()->id]);
        if ($request->contract_id) {
            $contract = $request->user()->contracts()->find($request->contract_id);
            if (!$contract) {
                return response()->json(['message' => 'Hơp đồng không tồn tại'], 404);
            }
        }
        return parent::store($request);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('user_id')->rules('required'),
            field('contract_id')->rules('required'),
            field('email')->rules('email'),
            field('tax_id')->rules('required'),
            field('bank_account_number')->rules('required'),
            field('bank_name')->rules('required'),
            field('business_name')->rules('required'),
            field('position')->rules('required'),
            field('address')->rules('required'),
            field('phone_number')->rules('required'),
            field('full_name')->rules('required'),
        ];
    }
}
