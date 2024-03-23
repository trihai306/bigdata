<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserConversation;
use Illuminate\Http\Request;

class UserConversationController extends Controller
{
    public function updateLastSeenMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id'
        ]);

        $userConversation = UserConversation::where('conversation_id', $conversationId)
            ->where('user_id', auth()->id())
            ->first();

        if ($userConversation) {
            $userConversation->last_seen_message_id = $request->message_id;
            $userConversation->save();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['error' => 'No matching user conversation found'], 404);
        }
    }
}
