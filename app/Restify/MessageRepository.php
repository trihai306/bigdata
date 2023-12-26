<?php

namespace App\Restify;

use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Modules\Conversation\app\Models\Message;

class MessageRepository extends Repository
{
    public static string $model = Message::class;

    public static array $search = [
        'id',
        'content',
    ];

    public static array $sort = [
        'id',
        'content',
        'created_at',
        'updated_at',
    ];

    public static array $match = [
        'id' => 'integer',
        'content'=>'string',
    ];

    public static int $globalSearchResults = 10;
    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('conversation_id')->rules('required'),
            field('sender_id')->rules('required'),
            field('reply_to_id'),
            field('content')->rules('required'),
            field('type')->rules('required'),
            field('attachment_url'),
            field('created_at'),
            field('updated_at'),
        ];
    }
}
