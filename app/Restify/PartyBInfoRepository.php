<?php

namespace App\Restify;

use App\Models\Contract;
use App\Models\PartyBInfo;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->type == 'buyer') {
            return response()->json(['message' => 'Bạn không có quyền thực hiện hành động này'], 403);
        }
        if ($request->contract_id) {
            $contract = Contract::find($request->contract_id);
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
            field('user_id'),
            field('contract_id'),
            field('email'),
            field('tax_id'),
            field('bank_account_number'),
            field('bank_name'),
            field('business_name'),
            field('position'),
            field('address'),
            field('phone_number'),
            field('full_name'),
        ];
    }
}
