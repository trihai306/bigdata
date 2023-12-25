<?php

namespace App\Restify;

use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Modules\Conversation\app\Models\UserConversation;

class UserConversationRepository extends Repository
{
    public static string $model = UserConversation::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('user_id')->rules('required', 'exists:users,id')->messages([
                'required' => 'Trường này là bắt buộc.',
                'exists' => 'Trường này đã tồn tại.',
            ]),
            field('conversation_id')->rules('required', 'exists:conversations,id')->messages([
                'required' => 'Trường này là bắt buộc.',
                'exists' => 'Trường này đã tồn tại.',
            ]),
            field('date_joined')->rules('required')->messages([
                'required' => 'Trường này là bắt buộc.',
            ]),
            field('last_read_at'),
        ];
    }
}
