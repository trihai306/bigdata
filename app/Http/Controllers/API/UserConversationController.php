<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\UserConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserConversationController extends Controller
{
    public function updateLastSeenMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message_id' => 'required|exists:messages,id'
        ]);

        $user = Auth::user(); // Get the authenticated user

        // Check if the authenticated user is part of the conversation
        $userConversation = $user->userConversations()
            ->where('conversation_id', $conversationId)
            ->first();

        if (!$userConversation) {
            return response()->json(['message' => 'UserConversation not found'], 404);
        }

        $userConversation->last_seen_message_id = $request->message_id;
        $userConversation->save();
    }
}
