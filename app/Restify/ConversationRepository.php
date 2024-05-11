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
        'users.name',
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
        'users.name'=>'string',
    ];

    public static function indexQuery(RestifyRequest $request, Relation|Builder $query)
    {
        $query->whereHas('users', function ($q) use ($request) {
            $q->where('user_id', auth()->user()->id);

            if ($request->username) {
                $q->where('name', 'like', '%' . $request->username . '%');
            }
        })
            ->with(['messages' => function ($q) {
                $q->orderBy('created_at', 'desc');
            }]);

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
            field('lastSeenMessage')->canStore(fn() => false)->canUpdate(fn() => false),
        ];
    }


    public static function related(): array
    {
        return [
            'messages' =>HasMany::make('messages', MessageRepository::class),
//            'userConversations' => HasMany::make('userConversations', UserConversationRepository::class),
        ];
    }
}
