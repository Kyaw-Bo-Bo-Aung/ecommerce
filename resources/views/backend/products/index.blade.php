@extends('layouts.backend.master')
@section('title', 'Products')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-box2 icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div><i class="metismenu-icon pe-7s-box2 d-inline-block d-md-none"></i>
                        Products</div>
                </div>
            </div>
        </div>
        {{-- table --}}
        <div class="main-card mb-3 card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">Manage your products</div>
                <div class="mr-2">
                    <a href="{{ route('admin.products.create') }}">
                        <button class="btn btn-success">Add new product</button>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="products_table">
                        <thead class="bg-light">
                            <th>Name</th>
                            <th>Subcategory</th>
                            <th>Product color</th>
                            <th>Product image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tfoot class="bg-light">
                            <th>Name</th>
                            <th>Subcategory</th>
                            <th>Product color</th>
                            <th>Product image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end table -->
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        let table = $('#products_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/admin/products/data-tables/ssd",
            columnDefs: [
                {
                    targets : "_all",
                    className: 'text-center'
                }
            ],
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'subcategory_id',
                    name: 'subcategory_id'
                },
                {
                    data: 'color',
                    name: 'color',
                    searchable: false,
                },
                {
                    data: 'image',
                    name: 'image',
                    searchable: false,
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

                },
            ]
        });

        $(document).on('change', '.update_status_toggler', function(e) {
            e.preventDefault();
            let status = $(this).attr('status');
            let product_id = $(this).attr('product_id');
            $.ajax({
                url: '/admin/products/update-status',
                type: 'POST',
                data: {
                    status: status,
                    product_id: product_id
                },
                success: function(res) {
                    let product_id = res.product_id;
                    let status = res.status;
                    //    console.log(status);
                    if (status == 1) {
                        $('#product_' + product_id).text('Active');
                        $('#customSwitch' + product_id).attr('status', status);
                    } else if (status == 0) {
                        $('#product_' + product_id).text('Inactive');
                        $('#customSwitch' + product_id).attr('status', status);
                    }
                }
            })
        });

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
                        url: '/admin/products/' + id,
                        type: 'DELETE',
                        success: function(res) {
                            // console.log(table);
                            table.ajax.reload();
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
