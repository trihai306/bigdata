<div class="flex-lg-row-fluid ms-lg-10">
    <!--begin::Card-->
    <div class="card card-flush mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header pt-5">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <input type="text" wire:model.live="search" class="form-control form-control-solid w-250px ps-15"
                           placeholder="Search Users"/>
                </div>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-actions">
                <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userSelectModal">
                    Add User
                </div>
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table-->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed  gy-5 mb-0" id="kt_roles_view_table">
                    <thead>
                    <tr class="text-start text-muted fw-bold  text-uppercase gs-0">

                        <th class="min-w-50px">ID</th>
                        <th class="min-w-150px">User</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Phone</th>
                        <th class="min-w-125px">Joined Date</th>
                        <th class="text-end min-w-100px">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? '' }}</td>
                            <td>{{
                                \Carbon\Carbon::parse($user->created_at)->format('d/m/Y')
 }}</td>
                            <td class="text-end">
                                <div class="">
                                    <a class="btn btn-primary"
                                       href="">View</a>

                                    <a class="btn btn-danger" wire:click.prevent="$dispatch('swalConfirm',
                                      {
                                        message: 'Are you sure you want to delete roles this user?',
                                        id: {{$user->id}},
                                        nameMethod: 'deleteRoleUser'
                                      })">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            {{ $users->links() }}
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <div class="modal fade" wire:ignore id="userSelectModal" tabindex="-1" aria-labelledby="userSelectModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userSelectModalLabel">Select User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="relative" x-data="{ open: false }">
                            <input type="text" id="user-search" class="form-control" wire:model="selectedUserName"
                                   placeholder="Search Users" @click="open = true">
                            <div class="absolute z-10 w-full mt-1 rounded-md shadow-lg" x-show="open"
                                 @click.away="open = false">
                                @foreach($this->searchUser() as $user)
                                    <div class="cursor-pointer px-4 py-2"
                                         wire:click="selectUser({{ $user->id }}, '{{ $user->name }}'); open = false">{{ $user->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" wire:click="saveUser">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
