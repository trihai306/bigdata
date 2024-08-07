<?php

namespace Adminftr\Core\Future\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    public $avatar;
    public $email;
    use WithFileUploads;

    public function mount()
    {
        $user = auth()->user();
        $this->email = $user->email;
    }

    public function updatedAvatar()
    {
        $this->validate(['avatar' => 'image|max:2048']);
        if ($this->avatar && $this->avatar->isValid()) {
            $fileName = $this->avatar->store('avatars', 'private');
            auth()->user()->update(['avatar' => $fileName]);
            $this->dispatch('swalSuccess',[
                'message' => 'Avatar updated successfully!'
            ]);
        }
    }

    public function updateEmail()
    {
        $this->validate(['email' => 'required|email|unique:users,email,' . auth()->id(),]);
        try {
            auth()->user()->update(['email' => $this->email]);
            $this->dispatch('swalSuccess',[
                'message' => 'Email updated successfully!'
            ]);
        }catch (\Exception $e) {
            $this->dispatch('swalError',[
                'message' => $e->getMessage()
            ]);
        }
    }

    public function updateProfile()
    {

    }

    public function render()
    {
        return view('future::future.profile.profile');
    }
}
