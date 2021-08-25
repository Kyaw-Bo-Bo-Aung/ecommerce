@extends('layouts.backend.master')
@section('title', 'Edit product')
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
                            Edit product</div>
                    </div>
                </div>
            </div>
            {{-- product form --}}
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Product info</h5>
                    <form id="product_update_form" method="POST"
                        action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="name" class="font-weight-bolder">Product name</label>
                                    <input name="name" id="name" value="{{ $product->name }}" type="text"
                                        class="form-control" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="code" class="font-weight-bolder">Product code</label>
                                    <input name="code" id="code" value="{{ $product->code }}" type="text"
                                        class="form-control" required>
                                    @error('code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="color" class="font-weight-bolder d-block">Product color</label>
                                    <input name="color" id="color" value="{{ $product->color }}" type="color" required>
                                    <label for="color" id="color_changed_code" class="font-weight-bolder ml-2">
                                        {{ $product->color }}
                                    </label>
                                    @error('color')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="price" class="font-weight-bolder">Product price</label>
                                    <input name="price" id="price" value="{{ $product->price }}" type="text"
                                        class="form-control" required>
                                    @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="discount" class="font-weight-bolder">Product discount</label>
                                    <input name="discount" id="discount" value="{{ $product->discount }}" type="number"
                                        class="form-control" required>
                                    @error('discount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="feature" class="font-weight-bolder">Feature</label>
                                    <input name="feature" id="feature" value="{{ $product->feature }}" type="text"
                                        class="form-control" required>
                                    @error('feature')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="category" class="font-weight-bolder">Select category</label>
                                <select id="category" class="form-control select_option" required>
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
                                <input type="hidden" name="subcategory_id" value="{{$product->subcategory_id}}" class="d-none">
                                <select name="new_subcategory_id" id="subcategoryHTML" class="form-control select_option"
                                    required>

                                </select>
                                @error('subcategory')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6 my-2">
                                <div class="position-relative form-group">
                                    <label for="image" class="font-weight-bolder">Image</label>
                                    <nav>
                                        <div class="nav nav-tabs mb-1" id="nav-tab" role="tablist">
                                            <a class="py-1 px-2 nav-link active" id="old_image_tab" data-toggle="tab"
                                                href="#old_image" role="tab" aria-controls="old_image"
                                                aria-selected="true">Current image</a>
                                            <a class="py-1 px-2 nav-link" id="new_image_tab" data-toggle="tab"
                                                href="#new_image" role="tab" aria-controls="new_image"
                                                aria-selected="false">New image</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="old_image" role="tabpanel"
                                            aria-labelledby="old_image_tab">
                                            <input type="text" value="{{$product->image}}" class="d-none"
                                                id="current_image" name="current_image">
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="product-img"
                                                height="98">
                                        </div>
                                        <div class="tab-pane fade" id="new_image" role="tabpanel"
                                            aria-labelledby="new_image_tab">
                                            <input type="file" class="d-block" id="new_image" name="new_image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 my-2">
                                <div class="position-relative form-group">
                                    <label for="video" class="font-weight-bolder">Video</label>
                                    <nav>
                                        <div class="nav nav-tabs mb-1" id="nav-tab" role="tablist">
                                            <a class="py-1 px-2 nav-link active" id="old_video_tab" data-toggle="tab"
                                                href="#old_video" role="tab" aria-controls="old_video"
                                                aria-selected="true">Current video</a>
                                            <a class="py-1 px-2 nav-link" id="new_video_tab" data-toggle="tab"
                                                href="#new_video" role="tab" aria-controls="new_video"
                                                aria-selected="false">New video</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="old_video" role="tabpanel"
                                            aria-labelledby="old_video_tab">
                                            <input type="text" value="{{ $product->video }}" class="d-none"
                                                id="current_video" name="current_video">
                                            <img src="{{ asset('storage/' . $product->video) }}" alt="product-img"
                                                height="98">
                                        </div>
                                        <div class="tab-pane fade" id="new_video" role="tabpanel"
                                            aria-labelledby="new_video_tab">
                                            <input type="file" class="d-block" id="new_video" name="new_video">
                                        </div>
                                    </div>
                                    @error('video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="weight" class="font-weight-bolder">Weight</label>
                                    <input name="weight" id="weight" value="{{ $product->weight }}" type="number"
                                        class="form-control">
                                    @error('weight')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6 mb-2">
                                <div class="position-relative form-group">
                                    <label for="url" class="font-weight-bolder">Url</label>
                                    <input name="url" id="url" value="{{ $product->url }}" type="text"
                                        class="form-control" required>
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="position-relative form-group">
                                    <div class="position-relative form-group">
                                        <label for="meta_title" class="font-weight-bolder">Meta title</label>
                                        <textarea name="meta_title" id="meta_title" rows="2" class="form-control"
                                            placeholder="Enter meta title">{{ $product->meta_title }}</textarea>
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
                                            placeholder="Enter meta description">{{ $product->meta_description }}</textarea>
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
                                            placeholder="Enter meta keywords">{{ $product->meta_keywords }}</textarea>
                                        @error('meta_keywords')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                    <div class="text-right my-3">
                        <a href="{{ route('admin.products.index') }}"><button
                                class="btn btn-secondary">Cancel</button></a>
                        <button id="product_update_btn" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div> <!-- end product form -->
    </div>

@endsection
@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\CreateProductRequest') !!}
    <script>
        $(function() {
            $('#product_update_btn').on('click', function(e) {
                e.preventDefault();
                $('#product_update_form').trigger('submit');
            });
            // select2 
            $('#category').select2({
                theme: 'bootstrap4',
                placeholder: "{{ $product->subcategory->category->name }}"
            });
            $('#subcategoryHTML').select2({
                theme: 'bootstrap4',
                placeholder: "{{ $product->subcategory->name }}"
            }).val('{{ $product->subcategory_id }}');

            // select option change event 
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
                            html +=
                                `
                                <option value=""></option>
                                <option value="${subcategory.id}">${subcategory.name}</option>
                                `
                        });
                        $('#subcategoryHTML').html(html);
                    }
                })
            })

            // color picker 
            $('input[name="color"]').on('input', function(e) {
                let color = $(this).val();
                // console.log(color);
                $('#color_changed_code').text(color);
            })
        })
    </script>
@endsection
