<?php

namespace Modules\Core\Livewire\Admin;

use Livewire\Component;
use Modules\Core\Http\Models\Menu;

class MenuHeader extends Component
{
    public function render()
    {
        $excludedPatterns = ['login', 'logout', 'register', 'forgot', 'create', 'edit', 'show', 'destroy'];

        // Bắt đầu truy vấn
        $query = Menu::query();

        // Thêm điều kiện 'not like' cho mỗi mẫu trong mảng
        foreach ($excludedPatterns as $pattern) {
            $query->where('url', 'not like', '%' . $pattern . '%');
        }

        // Thực hiện truy vấn và lấy kết quả
        $menus = $query->get();
        return view('core::livewire.admin.menu-header', compact('menus'));
    }
}
