@extends('layouts.backend.master')
@section('title', 'Product detail')
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
                            Product detail</div>
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
                    <h5 class="card-title">Product info</h5>
                    <table class="table table-hover table-bordered">
                        <thead class="table-primary">
                            <th colspan="2" class="text-center">Detail information</th>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Product Code</th>
                                <td>{{ $product->code ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Section</th>
                                @if ($product->subcategory->category->section->status == 1)
                                    <td>{{ $product->subcategory->category->section->name ?? 'no section' }}</td>
                                @else
                                    <td>{{ $product->subcategory->category->section->name ?? 'no section' }}
                                        <small class="bg-danger text-white font-bold rounded-pill p-1 mx-2">Inactive</small>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Category</th>
                                @if ($product->subcategory->category->status == 1)
                                    <td>{{ $product->subcategory->category->name ?? 'no category' }}</td>
                                @else
                                    <td>{{ $product->subcategory->category->name ?? 'no category' }}
                                        <small class="bg-danger text-white font-bold rounded-pill p-1 mx-2">Inactive</small>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Subcategory</th>
                                @if ($product->subcategory->status == 1)
                                    <td>{{ $product->subcategory->name ?? 'no category' }}</td>
                                @else
                                    <td>{{ $product->subcategory->name ?? 'no category' }}
                                        <small class="bg-danger text-white font-bold rounded-pill p-1 mx-2">Inactive</small>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Image</th>
                                @if ($product->image)
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="product img"
                                            width="100">
                                    </td>
                                @else
                                    <td>
                                        <img src="https://ui-avatars.com/api/?name={{ $product->name }}" alt="product img"
                                            width="100">
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Product color</th>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-inline-block my-0 mr-2 rounded-circle"
                                            style="background-color:{{ $product->color }}; width: 1.5em; height:1.5em">
                                        </div>
                                        <div class="d-inline-block">{{ $product->color }}</div>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>{{ $product->price ?? '-' }} MMK</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{ $product->discount ?? '-' }} MMK</td>
                            </tr>
                            <tr>
                                <th>Feature</th>
                                <td>
                                    @php
                                        $index = rand(0,6);
                                        $badge_colors = ['light', 'dark', 'danger', 'success', 'warning',
                                                        'secondary', 'primary'];
                                    @endphp
                                    <div class="badge badge-{{$badge_colors[$index]}}">{{ $product->feature ?? '-' }}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Url</th>
                                <td>{{ $product->url }}</td>
                            </tr>
                            <tr>
                                <th>Meta title</th>
                                <td>{{ $product->meta_title }}</td>
                            </tr>
                            <tr>
                                <th>Meta description</th>
                                <td>{{ $product->meta_description }}</td>
                            </tr>
                            <tr>
                                <th>Meta_keywords</th>
                                <td>{{ $product->meta_keywords }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                @if ($product->status == 1)
                                    <td><span class="badge badge-success">Active</span></td>
                                @else
                                    <td><span class="badge badge-danger">Inactive</span></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-5 text-right">
                        <a href="{{ route('admin.products.index') }}">
                            <button class="btn btn-primary px-5">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
