<?php

namespace App\Restify;

use App\Models\Conversation;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

class ConversationRepository extends Repository
{
    public static string $model = Conversation::class;
    public static array $search = [
        'id',
        'name',
    ];
    public static array $sort = [
        'id',
        'name',
        'type',
        'created_at',
        'updated_at',
    ];

    public static array $match = [
        'id' => 'integer',
        'name'=>'string',
        'type'=>'string',
    ];

    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)

    {
        $query->whereHas('users', function ($q) {
            $q->where('user_id', auth()->user()->id);
        });
        return parent::indexQuery($request, $query);
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('type'),
            field('name'),
            field('users')->canStore(fn() => false)->canUpdate(fn() => false),
            field('lastMessage')->canStore(fn() => false)->canUpdate(fn() => false),
        ];
    }

    public static function related(): array
    {
        return [
            'messages' =>HasMany::make('messages', MessageRepository::class),
        ];
    }
}
