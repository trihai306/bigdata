@extends('core::layouts.app')

@section('content')
    <!--begin::Content-->
    <div  class="app-content flex-row-fluid">
        <!--begin::Row-->
        <livewire:user::permission.roles />
        <!--end::Row-->
        <!--begin::Modals-->
        <!--begin::Modal - Add role-->
        <div class="modal" id="modal_add_role">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Add a Role</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn-close" onclick="hiddenModal()">
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <livewire:user::permission.roles.create />

                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Add role-->
        <!--begin::Modal - Update role-->
        <div class="modal fade" id="modal_update_role" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered" style="max-width: 800px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bold">Update Role</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" onclick="hiddenUpdateModal()">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <livewire:user::permission.roles.edit />
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Update role-->
        <!--end::Modals-->
    </div>
    <!--end::Content-->
@endsection
@section('script')
   <script >
        var modal_add_role = document.getElementById('modal_add_role');

        var modal_update_role = document.getElementById('modal_update_role')

        function hiddenUpdateModal() {
            modal_update_role.style.display = 'none';
        }

        function showUpdateModal() {
            modal_update_role.style.display = 'block';
        }

        function hiddenModal(){
            modal_add_role.style.display = 'none';
        }

        function showModal(){
            modal_add_role.style.display = 'block';
        }

        window.addEventListener('show-create-role-modal', event => {
            showModal();
        });

        window.addEventListener('hide-create-role-modal', event => {
            hiddenModal();
        });

        window.addEventListener('show-update-role-modal', event => {
            showUpdateModal();
        });

        window.addEventListener('hide-update-role-modal', event => {
            hiddenUpdateModal();
        });

        function confimDetele(id){
            swalConfirm('Are you sure?', 'Bạn sẽ xóa nó?', function () {
                Livewire.dispatch('deleteRole', {'roleId': id});
            });
        }
    </script>

@endsection
