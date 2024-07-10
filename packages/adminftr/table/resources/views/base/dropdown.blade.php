<div class='dropdown action-dropdown'>
    <button class="btn align-text-top border-0 text-box" data-bs-toggle='dropdown' data-bs-auto-close="outside">
        <i class="fa-solid fa-ellipsis-vertical" style="font-size:20px; color:rgba(47, 43, 61, 0.7);"></i>
    </button>
    <div class='dropdown-menu dropdown-menu-end'>
        @foreach($actions as $action)
            <div class='dropdown-item'>
                {{$action->render()}}
            </div>
        @endforeach
    </div>
</div>
