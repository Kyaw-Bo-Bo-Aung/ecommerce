@extends('layouts.backend.master')
@section('title', 'Create sub-category')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-network icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div><i class="metismenu-icon pe-7s-network d-inline-block d-md-none"></i>
                            Add new sub-category</div>
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
                    <form id="subcategory_create_form" method="POST" action="{{ route('admin.subcategories.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="name" class="font-weight-bolder">Subcategory name</label>
                                    <input name="name" id="name" placeholder="Enter subcategory name" type="text"
                                        class="form-control" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="discount" class="font-weight-bolder">Discount</label>
                                    <input name="discount" id="discount" placeholder="Enter discount %" type="number"
                                        class="form-control">
                                    @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="category" class="font-weight-bolder">Select category</label>
                                    <select name="category_id" id="category" class="form-control select_option" required>
                                        <option value=""></option>
                                        @foreach ($sections as $section)
                                            <optgroup label="{{ $section->name }}">
                                                @foreach ($section->categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="url" class="font-weight-bolder">Subcategory url</label>
                                        <input name="url" id="url" type="text" class="form-control"
                                            placeholder="Enter subcategory url" />
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="image" class="font-weight-bolder">Subcategory Image</label>
                                        <input type="file" class="d-block" id="image" name="image">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="description" class="font-weight-bolder">Description</label>
                                        <textarea name="description" id="description" rows="5" class="form-control"
                                            placeholder="Enter description"></textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="meta_title" class="font-weight-bolder">Meta title</label>
                                        <textarea name="meta_title" id="meta_title" rows="2" class="form-control"
                                            placeholder="Enter meta title"></textarea>
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="meta_description" class="font-weight-bolder">Meta description</label>
                                        <textarea name="meta_description" id="meta_description" rows="2"
                                            class="form-control" placeholder="Enter meta description"></textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="meta_keywords" class="font-weight-bolder">Meta keywords</label>
                                        <textarea name="meta_keywords" id="meta_keywords" rows="2" class="form-control"
                                            placeholder="Enter meta keywords"></textarea>
                                        @error('meta_keywords')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="text-right my-3">
                        <a href="{{ route('admin.subcategories.index') }}"><button
                                class="btn btn-secondary">Cancel</button></a>
                        <button id="subcategory_create_btn" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div> <!-- end setting form -->
    </div>

@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateSubcategoryRequest') !!}
    <script>
        $(function() {
            $('#subcategory_create_btn').on('click', function(e) {
                e.preventDefault();
                $('#subcategory_create_form').trigger('submit');
            })
            $('#section').select2({
                theme: 'bootstrap4',
                placeholder: "<--- Select section --->"
            });
            $('#category').select2({
                theme: 'bootstrap4',
                placeholder: "<--- Select category --->"
            });
        })
    </script>
@endsection
