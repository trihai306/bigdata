<?php

namespace App\Restify;

use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Modules\Conversation\Models\Message;

class MessageRepository extends Repository
{
    public static string $model = Message::class;

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
