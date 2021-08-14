@extends('layouts.backend.master')
@section('title', 'Profile setting')
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
                    <div> <i class="metismenu-icon pe-7s-config d-inline-block d-md-none"></i> 
                        Admin profile setting</div>
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
                <h5 class="card-title">Update profile</h5>
                <form method="POST" action="{{ route('admin.update-profile') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="position-relative row form-group">
                        <label for="email" class="col-sm-2 col-form-label">Admin email</label>
                        <div class="col-sm-10">
                            <input name="email" id="email" type="text" value="{{ auth('admin')->user()->email }}"
                                class="form-control" readonly>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="type" class="col-sm-2 col-form-label">Admin type</label>
                        <div class="col-sm-10">
                            <input name="type" id="type" type="text" value="{{ auth('admin')->user()->type }}"
                                class="form-control" readonly>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="username" class="col-sm-2 col-form-label">Admin username</label>
                        <div class="col-sm-10">
                            {{-- @php
                                dd(auth('admin')->user()->name);
                            @endphp --}}
                            <input name="username" id="username" type="text" class="form-control"
                                value="{{ auth('admin')->user()->name }}" required>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="mobile" class="col-sm-2 col-form-label">Mobile number</label>
                        <div class="col-sm-10">
                            <input name="mobile" id="mobile" type="text" class="form-control"
                                value="{{ auth('admin')->user()->mobile }}" required>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="photo" class="col-sm-2 col-form-label">User photo</label>
                        <div class="col-sm-10">
                            @if (!auth('admin')->user()->photo)
                                <input name="new_photo" id="new_photo" type="file" class="">
                                @error('new_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @else
                                <ul class="nav nav-tabs" id="photo" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="current_photo_tab" data-toggle="tab"
                                            href="#current_photo" role="tab" aria-controls="current_photo"
                                            aria-selected="true">Current photo</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="new_photo_tab" data-toggle="tab" href="#new_photo"
                                            role="tab" aria-controls="new_photo" aria-selected="false">New photo</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="photoContent">
                                    <div class="tab-pane fade show active" id="current_photo" role="tabpanel"
                                        aria-labelledby="current_photo_tab">
                                        <input type="text" value="{{auth('admin')->user()->photo}}" name="current_photo" hidden>
                                        <img src="{{ asset('storage/' . auth('admin')->user()->photo )}}" alt="admin_avatar" 
                                        class="img-fluid" width="70px">
                                    </div>
                                    <div class="tab-pane fade" id="new_photo" role="tabpanel"
                                        aria-labelledby="new_photo_tab">
                                        <input name="new_photo" id="new_photo" type="file" class="">
                                    </div>
                                </div>
                                @error('new_photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            @endif
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end setting form -->
</div>
@endsection
