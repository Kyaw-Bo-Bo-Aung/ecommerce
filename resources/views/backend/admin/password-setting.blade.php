@extends('layouts.backend.master')
@section('title', 'Password setting')
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
                        Admin password setting</div>
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
                <h5 class="card-title">Update Password</h5>
                <form id="update-password-form" method="POST" action="{{ route('admin.update-password') }}">
                    @csrf
                    @method('PUT')
                    <div class="position-relative row form-group">
                        <label for="username" class="col-sm-2 col-form-label">Admin name</label>
                        <div class="col-sm-10">
                            <input name="username" id="username" type="text" value="{{ auth('admin')->user()->name }}"
                                class="form-control" readonly>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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
                        <label for="cpassword" class="col-sm-2 col-form-label">Current Password</label>
                        <div class="col-sm-10">
                            <input name="cpassword" id="cpassword" type="password" class="form-control"
                                placeholder="Enter current password">
                            @error('cpassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('fail')
                                <span class="text-danger">{{ $message }}</span>   
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="position-relative row form-group">
                        <label for="npassword" class="col-sm-2 col-form-label">New password</label>
                        <div class="col-sm-10">
                            <input name="npassword" id="npassword" type="password" class="form-control"
                                placeholder="Enter new password">
                            @error('npassword')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm password</label>
                        <div class="col-sm-10">
                            <input name="confirm_password" id="confirm_password" type="password" class="form-control"
                                placeholder="Confirm new password">
                            @error('confirm_password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div id="password-update-btn">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end setting form -->
</div>
@endsection
