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
            <div class="card-body">
                <h5 class="card-title">Manage your categories</h5>

                <table id="categories_table" class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Status</th>
                    </thead>
                    {{-- <tbody>
                        @php
                            $category_no = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td> {{ $category_no++ }}</td>
                                <td> {{ $category->name }}</td>
                                <td>
                                    @if ($category->status === 1)
                                        <div id="status_label_{{ $category->id }}" class="custom-control custom-switch">
                                            <input type="checkbox" status="{{ $category->status }}"
                                                class="update_status_toggler custom-control-input"
                                                id="customSwitch{{ $category->id }}" checked
                                                category_id="{{ $category->id }}">
                                            <label class="custom-control-label" id="category_{{$category->id}}"
                                                for="customSwitch{{ $category->id }}">Active</label>
                                        </div>
                                    @else
                                        <div id="status_label_{{ $category->id }}" class="custom-control custom-switch">
                                            <input type="checkbox" status="{{ $category->status }}"
                                                class="update_status_toggler custom-control-input"
                                                id="customSwitch{{ $category->id }}" category_id="{{ $category->id }}">
                                            <label class="custom-control-label" id="category_{{$category->id}}"
                                                for="customSwitch{{ $category->id }}">Inactive</label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                    <tfoot>
                        <th>Name</th>
                        <th>Status</th>
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
        let data_table = $('#categories_table').dataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "/admin/categories/data-tables/ssd",
                            columns: [
                                {
                                    data: 'name',
                                    name: 'name'
                                },
                                {
                                    data: 'status',
                                    name: 'status',
                                    searchable : false,
                                    orderable : false
                                }
                            ]
                        });

        // $(document).on('change', '.update_status_toggler', function(){
        //     alert('ok');
        // })
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
                       if(status == 1) {
                        $('#category_'+category_id).text('Active');
                        $('#customSwitch'+category_id).attr('status', status);
                       }else if(status == 0){
                        $('#category_'+category_id).text('Inactive');
                        $('#customSwitch'+category_id).attr('status', status);
                       }    
                }
            })
        })
    })
</script>
@endsection
