<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserConversationController extends Controller
{
    public function updateLastSeenMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id'
        ]);

        $userConversation = auth()->user()->userConversations()->where('conversation_id', $conversationId)->first();

        if ($userConversation) {
            $userConversation->update(['last_seen_message_id' => $request->message_id]);
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['error' => 'No matching user conversation found'], 404);
        }
    }
}
