<?php

namespace Modules\Permission\Livewire\Roles\View;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $role;
    public $searchUser = '';
    public $selectedUserName = '';
    public $search = ''; // Thêm biến tìm kiếm nếu cần
    public $selectedUser = null;

    protected $listeners = [
        'deleteRoleUser',
    ];

    public function mount($role)
    {
        $this->role = $role;
    }

    public function searchUser()
    {
        $users = User::whereNotIn('id', $this->role->users->pluck('id'))
            ->where('name', 'like', '%'.$this->searchUser.'%')
            ->get();

        return $users;
    }

    public function selectUser($userId, $userName)
    {
        $this->selectedUser = $userId;
        $this->selectedUserName = $userName;
    }

    public function saveUser()
    {
        try {
            if ($this->selectedUser) {
                $this->role->users()->attach($this->selectedUser);
                $this->selectedUser = null;
                $this->selectedUserName = '';
            }
            $this->dispatch('swalSuccess', [
                'message' => 'Thêm người dùng thành công'
            ]);
        }catch (\Exception $exception) {
            $this->dispatch('swalError', [
                'message' => 'Thêm người dùng thất bại'
            ]);
        }
    }

    public function deleteRoleUser($id)
    {
        try {
            $this->role->users()->detach($id);
            $this->dispatch('swalSuccess', [
                'message' => 'Xóa người dùng thành công'
            ]);
        }catch (\Exception $exception) {
            $this->dispatch('swalError', [
                'message' => 'Xóa người dùng thất bại'
            ]);
        }
    }

    public function render()
    {
        // Cập nhật truy vấn để hỗ trợ tìm kiếm và phân trang
        $users = $this->role->users()
            ->where('name', 'like', '%'.$this->search.'%')
            ->paginate(10);

        return view('permission::livewire.roles.view.users', compact('users'));
    }
}
