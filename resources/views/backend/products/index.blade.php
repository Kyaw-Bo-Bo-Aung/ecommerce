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
                <div class="page-title-actions">
                    <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                        class="btn-shadow mr-3 btn btn-dark">
                        <i class="fa fa-star"></i>
                    </button>
                    <div class="d-inline-block dropdown">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="btn-shadow dropdown-toggle btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-business-time fa-w-20"></i>
                            </span>
                            Buttons
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        <i class="nav-link-icon lnr-inbox"></i>
                                        <span>
                                            Inbox
                                        </span>
                                        <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        <i class="nav-link-icon lnr-book"></i>
                                        <span>
                                            Book
                                        </span>
                                        <div class="ml-auto badge badge-pill badge-danger">5</div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link">
                                        <i class="nav-link-icon lnr-picture"></i>
                                        <span>
                                            Picture
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a disabled href="javascript:void(0);" class="nav-link disabled">
                                        <i class="nav-link-icon lnr-file-empty"></i>
                                        <span>
                                            File Disabled
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
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
                            <th>Section</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Product_color</th>
                            <th>Product_image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tfoot class="bg-light">
                            <th>Name</th>
                            <th>Section</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Product_color</th>
                            <th>Product_image</th>
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
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'section_id',
                    name: 'section_id'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
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
                },
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,

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

        // $(document).on('click', '.delete_btn', function() {
        //     let id = $(this).data('id');
        //     Swal.fire({
        //         title: "Are you sure?",
        //         showCancelButton: true,
        //         confirmButtonColor: '#d33',
        //         cancelButtonColor: '#bbb',
        //         confirmButtonText: 'Delete',
        //         reverseButtons: true,
        //         focusConfirm: false
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 url: '/admin/subcategories/' + id,
        //                 type: 'DELETE',
        //                 success: function(res) {
        //                     // console.log(table);
        //                     table.ajax.reload();
        //                 }
        //             })
        //             // sweetalert 2 toast 
        //             const Toast = Swal.mixin({
        //                 toast: true,
        //                 position: 'top-end',
        //                 showConfirmButton: false,
        //                 timer: 3000,
        //                 timerProgressBar: true,
        //                 didOpen: (toast) => {
        //                     toast.addEventListener('mouseenter', Swal.stopTimer)
        //                     toast.addEventListener('mouseleave', Swal.resumeTimer)
        //                 }
        //             })
        //             Toast.fire({
        //                 icon: 'success',
        //                 title: 'Deleted successfully'
        //             })
        //         }
        //     })
        // })
    })
</script>
@endsection
