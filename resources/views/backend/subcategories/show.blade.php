@extends('layouts.backend.master')
@section('title', 'Subcategory detail')
@section('content')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div><i class="metismenu-icon pe-7s-photo-gallery d-inline-block d-md-none"></i> 
                        Subcatgory detail</div>
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
        {{-- setting form --}}
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Subcategory info</h5>
                <table class="table table-hover table-bordered">
                    <thead class="table-primary">
                        <th colspan="2" class="text-center">Detail information</th>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Name</th>
                            <td>{{ $subcategory->name }}</td>
                        </tr>
                        <tr>
                            <th>Section</th>
                            <td>{{ $subcategory->section_id }}</td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td>{{ $subcategory->category_id }}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td>
                                <img src="{{ asset('storage/'.$subcategory->image) }}" alt="subcategory img"
                                width="100">
                            </td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>{{ $subcategory->discount }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $subcategory->description }}</td>
                        </tr>
                        <tr>
                            <th>Url</th>
                            <td>{{ $subcategory->url }}</td>
                        </tr>
                        <tr>
                            <th>Meta title</th>
                            <td>{{ $subcategory->meta_title }}</td>
                        </tr>
                        <tr>
                            <th>Meta description</th>
                            <td>{{ $subcategory->meta_description }}</td>
                        </tr>
                        <tr>
                            <th>Meta_keywords</th>
                            <td>{{ $subcategory->meta_keywords }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            @if ($subcategory->status == 1)
                                <td><span class="badge badge-success">Active</span></td>
                            @else 
                                <td><span class="badge badge-danger">Inactive</span></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end setting form -->
    
</div>

@endsection
@section('scripts')
<script>
    $(function(){
        $('#category_create_btn').on('click', function(e){
            e.preventDefault();
            $('#category_create_form').trigger('submit');
        })
    })
</script>
@endsection
