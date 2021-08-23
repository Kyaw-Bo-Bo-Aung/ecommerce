@extends('layouts.backend.master')
@section('title', 'Create product')
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
                            Add new product</div>
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
                    <form id="product_create_form" method="POST" action="{{ route('admin.products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="name" class="font-weight-bolder">Product name</label>
                                    <input name="name" id="name" placeholder="Enter product name" type="text"
                                        class="form-control" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="code" class="font-weight-bolder">Product code</label>
                                    <input name="code" id="code" placeholder="Enter product code" type="text"
                                        class="form-control" required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="color" class="font-weight-bolder">Product color</label>
                                    <input name="color" id="color" placeholder="Enter product color" type="text"
                                        class="form-control" required>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="price" class="font-weight-bolder">Product price</label>
                                    <input name="price" id="price" placeholder="Enter product price" type="text"
                                        class="form-control" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="discount" class="font-weight-bolder">Product discount</label>
                                    <input name="discount" id="discount" placeholder="Enter product discount" type="text"
                                        class="form-control" required>
                                    @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="feature" class="font-weight-bolder">Feature</label>
                                    <input name="feature" id="feature" placeholder="Enter product feature" type="text"
                                        class="form-control" required>
                                    @error('feature')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="category" class="font-weight-bolder">Select category</label>
                                <select name="category_id" id="category" class="form-control select_option" required>
                                    <option></option>
                                    @foreach ($sections as $section)
                                        <optgroup label="{{ $section->name }}">
                                            @forelse ($section->categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @empty
                                               <option value="" disabled="disabled">-</option> 
                                            @endforelse
                                            
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('section')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="subcategory" class="font-weight-bolder">Select subcategory</label>
                                    <select name="subcategory_id" id="subcategoryHTML" class="form-control select_option" required>
                                        
                                    </select>
                                    @error('subcategory')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                            </div>

                            {{-- <div class="col-md-12 mb-2">
                                <label for="section" class="font-weight-bolder">Select section</label>
                                <select name="section_id" id="section" class="form-control select_option" required>
                                    <option></option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-2">
                                <label for="section" class="font-weight-bolder">Select section</label>
                                <select name="section_id" id="section" class="form-control select_option" required>
                                    <option></option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

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
            $('#category').select2({
                theme: 'bootstrap4',
                placeholder: "<--- Select category --->"
            });
            $('#subcategoryHTML').select2({
                theme: 'bootstrap4',
                placeholder: "<--- Select subcategory --->"
            });

            $('#category').on('change', function(e) {
                e.preventDefault();
                let category_id = $('#category').val();
                // alert(category_id);
                $.ajax({
                    url: '/admin/products/get-relating-subcategory',
                    type: 'POST',
                    data: {
                        category_id: category_id
                    },
                    success: function(res) {
                        let html;
                        res.subcategories.forEach(subcategory => {
                            html += `<option value="${subcategory.id}">${subcategory.name}</option>`
                        });
                        $('#subcategoryHTML').html(html);
                    }
                })
            })
        })
    </script>
@endsection
