@extends('layouts.backend.master')
@section('title', 'Edit sub-category')
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
                            Edit sub-category</div>
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
                    <form id="subcategory_update_form" method="POST"
                        action="{{ route('admin.subcategories.update', $subcategory->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="name" class="font-weight-bolder">Subcategory name</label>
                                    <input name="name" id="name" placeholder="Enter subcategory name" type="text"
                                        class="form-control" value="{{ $subcategory->name }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="discount" class="font-weight-bolder">Discount</label>
                                    <input name="discount" id="discount" placeholder="Enter discount %" type="number"
                                        class="form-control" value="{{ $subcategory->discount }}">
                                    @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="category" class="font-weight-bolder">Select category</label>
                                    <select name="category_id" id="category" class="form-control select_option" required>
                                        <option></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <label for="image" class="font-weight-bolder">Subcategory Image</label>
                                        <nav>
                                            <div class="nav nav-tabs mb-1" id="nav-tab" role="tablist">
                                                <a class="py-1 px-2 nav-link active" id="old_image_tab" data-toggle="tab"
                                                    href="#old_image" role="tab" aria-controls="old_image"
                                                    aria-selected="true">Current image</a>
                                                <a class="py-1 px-2 nav-link" id="new_image_tab" data-toggle="tab" href="#new_image"
                                                    role="tab" aria-controls="new_image" aria-selected="false">New image</a>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="old_image" role="tabpanel"
                                                aria-labelledby="old_image_tab">
                                                <input type="text" value="{{$subcategory->image}}" class="d-none" id="current_image" name="current_image">
                                                <img src="{{ asset('storage/'.$subcategory->image) }}" alt="subcategory-img"
                                                    height="98">
                                            </div>
                                            <div class="tab-pane fade" id="new_image" role="tabpanel"
                                                aria-labelledby="new_image_tab">
                                                <input type="file" class="d-block" id="new_image" name="new_image">
                                            </div>
                                        </div>

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
                                            placeholder="Enter description">{{ $subcategory->description }}</textarea>
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
                                        <label for="url" class="font-weight-bolder">Subcategory url</label>
                                        <input name="url" id="url" type="text" class="form-control"
                                            placeholder="Enter subcategory url" value="{{ $subcategory->url }}" />
                                        @error('url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="meta_title" class="font-weight-bolder">Meta title</label>
                                        <textarea name="meta_title" id="meta_title" rows="2" class="form-control"
                                            placeholder="Enter meta title">{{ $subcategory->meta_title }}</textarea>
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
                                            class="form-control"
                                            placeholder="Enter meta description">{{ $subcategory->meta_description }}</textarea>
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
                                            placeholder="Enter meta keywords">{{ $subcategory->meta_keywords }}</textarea>
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
                        <button id="subcategory_update_btn" class="btn btn-primary">Update</button>
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
            $('#subcategory_update_btn').on('click', function(e) {
                e.preventDefault();
                $('#subcategory_update_form').trigger('submit');
            });

            $('#category').select2({
                    theme: 'bootstrap4',
                    placeholder: "{{ $subcategory->category->name }}"
                })
                .val("{{ $subcategory->category->id }}");


        })
    </script>
@endsection
