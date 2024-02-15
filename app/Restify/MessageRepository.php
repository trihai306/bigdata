<?php

namespace App\Restify;

use App\Events\UserPrivateMessageEvent;
use Binaryk\LaravelRestify\Fields\BelongsTo;
use Binaryk\LaravelRestify\Fields\HasMany;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Modules\Conversation\app\Models\Conversation;
use Modules\Conversation\app\Models\Message;

class MessageRepository extends Repository
{

    public static string $model = Message::class;
    public static int $defaultPerPage = 20;
    public static array $search = [
        'id',
        'content',
    ];

    public static array $sort = [
        'id',
        'content',
        'sender_id',
        'created_at',
        'updated_at',
    ];

    public static array $match = [
        'id' => 'integer',
        'sender_id' => 'integer',
        'content' => 'string',
        'conversation_id' => 'integer',
    ];

    public static int $globalSearchResults = 10;

    public function index(RestifyRequest $request)
    {
//        return parent::index($request);
        if (Auth::user()->hasConversation($request->conversation_id)) {
            return parent::index($request);
        }
        return response()->json(['message' => 'You are not allowed to access this conversation'], 403);
    }

    public function store(RestifyRequest $request)
    {

        try {
            if ($request->conversation_id == null && $request->user_id != null) {
                if ($request->user_id == Auth::id()) {
                    return response()->json(['message' => 'You cannot send message to yourself'], 403);
                }
                //kiểm tra xem đã có conversation giữa 2 người này chưa
                $conversation = Conversation::whereHas('users', function (Builder $query) use ($request) {
                    $query->where('user_id', $request->user_id);
                })->whereHas('users', function (Builder $query) {
                    $query->where('user_id', Auth::id());
                })->first();
                if ($conversation) {
                    $request->merge(['conversation_id' => $conversation->id]);
                    $request->request->remove('user_id');
                    return parent::store($request);
                }
                $conversation = Conversation::create(['type' => 'private']);
                $conversation->users()->attach(Auth::id());
                $request->merge(['conversation_id' => $conversation->id]);
                $conversation->users()->attach($request->user_id);
                $request->request->remove('user_id');
            }
            if (Auth::user()->hasConversation($request->conversation_id)) {
                if ($request->type == 'image') {
                    $request->merge(['attachment_url' => $request->file('attachment_url')->store('messages')]);
                }
                $request->merge(['sender_id' => Auth::id()]);
                return parent::store($request);
            }
            return response()->json(['message' => 'You are not allowed to access this conversation'], 403);
        }
        catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public static function stored($resource, RestifyRequest $request)
    {
        $sender = Auth::user();
        event(new \App\Events\UserMessageEvent($request->user_id, $resource, $sender->id));
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('conversation_id'),
            field('sender_id'),
            field('reply_to_id'),
            field('content')->rules('required'),
            field('type')->rules('required'),
            field('attachment_url'),
            field('created_at'),
            field('updated_at'),
        ];
    }

    public static function related(): array
    {
        return [
            'sender' => BelongsTo::make('sender', UserRepository::class),
        ];
    }
}