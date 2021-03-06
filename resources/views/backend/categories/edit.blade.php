@extends('layouts.backend.master')
@section('title', 'Edit category')
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
                            Edit category</div>
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
                    <h5 class="card-title">Category info</h5>
                    <form id="category_edit_form" method="POST"
                        action="{{ route('admin.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="position-relative row form-group">
                            <label for="name" class="col-sm-2 col-form-label">Category name</label>
                            <div class="col-sm-10">
                                <input value="{{ $category->name }}" name="name" id="name" type="text"
                                    class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="position-relative row form-group">
                            <label for="section" class="col-sm-2 col-form-label">Section name</label>
                            <div class="col-sm-10">
                                <select name="section" id="section" class="form-control">
                                    <option value=""></option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </form>
                    <div class="text-right">
                        <a href="{{ route('admin.categories.index') }}"><button
                                class="btn btn-secondary">Cancel</button></a>
                        <button id="category_edit_btn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div> <!-- end setting form -->
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            $('#category_edit_btn').on('click', function(e) {
                e.preventDefault();
                $('#category_edit_form').trigger('submit');
            });

            $('#section').select2({
                theme: 'bootstrap4',
                placeholder: "{{$category->section->name}}"
            })
            .val('{{$category->section->id}}');
        })
    </script>
@endsection
