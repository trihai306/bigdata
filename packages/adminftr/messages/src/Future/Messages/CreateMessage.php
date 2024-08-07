<?php

namespace Adminftr\Messages\Future\Messages;

use Adminftr\Messages\Http\Models\Conversation;
use Adminftr\Messages\Http\Models\Message;
use App\Events\UserMessageEvent;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateMessage extends Component
{
    use WithFileUploads;

    public $message;

    public $files;

    #[Locked]
    public $conversationId;

    public $users;

    protected $rules = [
        'message' => 'required',
        'files.*' => 'max:524288,mimes:jpg,jpeg,png,gif,doc,docx,pdf,xls,xlsx,ppt,pptx,zip,rar,mp3,mp4,avi,mov,wmv,flv',
    ];

    public function mount($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->users = Conversation::find($this->conversationId)
            ->users()->where('id', '!=', Auth::user()->id)->get();
    }

    #[On('changeConversation')]
    public function changeConversation($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->message = '';
    }

    public function sendMessage()
    {
        $this->validate();
        $messageData = $this->prepareMessageData('text');
        $this->eventMessages($messageData);
        $this->saveMessage($messageData);
        $this->reset('message');
    }

    protected function prepareMessageData($type, $filesArray = [])
    {
        $sender = Auth::user();

        return [
            'conversation_id' => $this->conversationId,
            'sender_id' => $sender->id,
            'content' => $this->message,
            'type' => $type,
            'created_at' => now()->diffForHumans(),
            'attachment_url' => $type === 'files' ? json_encode($filesArray) : null,
            'sender' => $sender,
        ];
    }

    protected function eventMessages($messageData)
    {
        foreach ($this->users as $user) {
            event(new UserMessageEvent($user, $messageData, $messageData['sender']));
        }
        $this->dispatch('message-sent', ['message' => $messageData]);
    }

    protected function saveMessage($messageData)
    {
        $message = new Message($messageData);
        $message->save();

        return $message;
    }

    public function sendFile()
    {
        $this->validate();
        try {
            $filesArray = $this->processFiles();
            $messageData = $this->prepareMessageData('files', $filesArray);
            $this->eventMessages($messageData);
            $this->saveMessage($messageData);
            $this->reset('message', 'files');
        } catch (Exception $e) {
            $this->addError('files', $e->getMessage());
        }
    }

    protected function processFiles()
    {
        $filesArray = [];
        foreach ($this->files as $file) {
            $filesArray[] = $this->storeFile($file);
        }

        return $filesArray;
    }

    protected function storeFile($file)
    {
        $filename = $file->getClientOriginalName();
        $linkFile = $file->store('public/messages/'.$this->conversationId);
        $linkFile = str_replace('public/', '', $linkFile);

        return [
            'name' => $filename,
            'url' => $linkFile,
            'type' => $file->getClientOriginalExtension(),
            'sizeText' => round($file->getSize() / 1024, 2).' KB',
        ];
    }

    public function render()
    {
        return view('messages::create-message');
    }
}
