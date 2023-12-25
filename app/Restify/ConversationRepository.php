<?php

namespace App\Restify;

use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Modules\Conversation\app\Models\Conversation;

class ConversationRepository extends Repository
{
    public static string $model = Conversation::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('type'),
            field('name'),
        ];
    }


}
