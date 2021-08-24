@extends('layouts.backend.master')
@section('title', 'Categories')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-config icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div><i class="metismenu-icon pe-7s-config d-inline-block d-md-none"></i>
                        Categories</div>
                </div>
            </div>
        </div>
        {{-- table --}}
        <div class="main-card mb-3 card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">Manage your categories</div>
                <div class="mr-2">
                    <a href="{{ route('admin.categories.create') }}"><button class="btn btn-success">Add
                            category</button></a>
                </div>
            </div>
            <div class="card-body">
                <table id="categories_table" class="table table-hover">
                    <thead class="bg-light">
                        <th>Name</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tfoot class="bg-light">
                        <th>Name</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <!-- end table -->
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        let table = $('#categories_table').dataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/categories/data-tables/ssd",
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'section_id',
                    name: 'section_id'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false,
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    orderable: false
                }
            ]
        });

        $(document).on('change', '.update_status_toggler', function(e) {
            e.preventDefault();
            let status = $(this).attr('status');
            let category_id = $(this).attr('category_id');
            $.ajax({
                url: '/admin/categories/update-status',
                type: 'POST',
                data: {
                    status: status,
                    category_id: category_id
                },
                success: function(res) {
                    let category_id = res.category_id;
                    let status = res.status;
                    //    console.log(status);
                    if (status == 1) {
                        $('#category_' + category_id).text('Active');
                        $('#customSwitch' + category_id).attr('status', status);
                    } else if (status == 0) {
                        $('#category_' + category_id).text('Inactive');
                        $('#customSwitch' + category_id).attr('status', status);
                    }
                }
            })
        })

        $(document).on('click', '.delete_btn', function() {
            let id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#bbb',
                confirmButtonText: 'Delete',
                reverseButtons: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/categories/' + id,
                        type: 'DELETE',
                        success: function(res) {
                            // console.log(table);
                            table.api().ajax.reload();
                        }
                    })
                    // sweetalert 2 toast 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Deleted successfully'
                    })
                }
            })
        })
    })
</script>
@endsection
