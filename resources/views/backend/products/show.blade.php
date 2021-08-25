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
                        <a href="{{ route('admin.products.index') }}">
                            <button type="button" class="btn-shadow mr-3 btn btn-dark">
                                <i class="fa fa-long-arrow-alt-left mr-2"></i> View products
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            {{-- product info --}}
            <div class="row">
                <div class="col-md-4 my-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}_image" class="img-fluid" width="200">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ $product->name }}&background=12e100"
                                        alt="{{ $product->name }}_image" class="img-fluid" width="200">
                                @endif
                            </div>
                            <div class="product-detail">
                                <h6 class="mt-4 mb-0 text-muted">Product name:</h6>
                                <div class="display-4">{{ $product->name }}</div>
                            </div>

                            <div class="product-detail">
                                <h6 class="mt-4 mb-0 text-muted">Section:</h6>
                                <div class="h5 font-weight-bold">
                                    {{ $product->subcategory->category->section->name }}</div>
                            </div>

                            <div class="product-detail">
                                <h6 class="mt-4 mb-0 text-muted">Category:</h6>
                                <div class="h5 font-weight-bold">{{ $product->subcategory->category->name }}</div>
                            </div>

                            <div class="product-detail">
                                <h6 class="mt-4 mb-0 text-muted">Subcategory:</h6>
                                <div class="h5 font-weight-bold">{{ $product->subcategory->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 my-3">
                    <div class="card">
                        <div class="card-header py-0">
                            <div>Product info</div>
                        </div>
                        <div class="card-body">
                            <div class="product-info">
                                <label class="text-muted h6">Code:</label>
                                <div>{{ $product->code }}</div>
                            </div>
                            <hr>
                            <div class="product-info">
                                <label class="text-muted h6">Color:</label>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle mr-2"
                                        style="background-color: {{ $product->color }}; width: 30px; height: 30px;">
                                    </div>
                                    <div>{{ $product->color }}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="product-info">
                                <label class="text-muted h6">Price:</label>
                                <div>{{ $product->price }} MMK</div>
                            </div>
                            <hr>
                            <div class="product-info">
                                <label class="text-muted h6">Discount:</label>
                                <div>{{ $product->discount }} MMK</div>
                            </div>
                            <hr>
                            <div class="product-info">
                                <label class="text-muted h6">Weight:</label>
                                <div>{{ $product->weight }} g</div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-header py-0">
                            <div>Website info</div>
                        </div>
                        <div class="card-body">
                            <div class="website-info">
                                <label class="text-muted h6">Meta title:</label>
                                <div>{{ $product->meta_title }}</div>
                            </div>
                            <hr>
                            <div class="website-info">
                                <label class="text-muted h6">Meta description:</label>
                                <div>{{ $product->meta_description }}</div>
                            </div>
                            <hr>
                            <div class="website-info">
                                <label class="text-muted h6">Meta keywords:</label>
                                <div>{{ $product->meta_keywords }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <div class="card-header">Product attributes</div>
                        <div class="card-body">
                            <div class="attr-section">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h6 class="border d-inline-block font-weight-bold">Small</h6>
                                    <button class="btn btn-outline-info" id="small_attr">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Price :</div>
                                    <div>price</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Stock :</div>
                                    <div>100</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>SKU :</div>
                                    <div>sku</div>
                                </div>
                            </div>
                            <hr>
                            <div class="attr-section">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h6 class="border d-inline-block font-weight-bold">Medium</h6>
                                    <button class="btn btn-outline-info" id="medium_attr">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Price :</div>
                                    <div>price</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Stock :</div>
                                    <div>100</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>SKU :</div>
                                    <div>sku</div>
                                </div>
                            </div>
                            <hr>
                            <div class="attr-section">
                                <div class="mb-3 d-flex justify-content-between align-items-center">
                                    <h6 class="border d-inline-block font-weight-bold">Large</h6>
                                    <button class="btn btn-outline-info" id="large_attr">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Price :</div>
                                    <div>price</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>Stock :</div>
                                    <div>100</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>SKU :</div>
                                    <div>sku</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end product info -->

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            let id_num = 1;
            // $(document).on('click', '.add_product_attr_div', function(e) {
            //     e.preventDefault();
            //     let html = `
            //     <div class="col-12 form-list">
            //         <div class="row">
            //             <div class="col-3">
            //                 <label for="sku">SKU</label>
            //                 <input type="text" name="sku[]" class="form-control" required>
            //             </div>
            //             <div class="col-3">
            //                 <label>Size</label>
            //                 <div>
            //                     <input class="size_radio_btn" type="radio" name="size${id_num}" id="small_size_${id_num}"
            //                         data-id="small_size" value="small" required>
            //                     <label id="small_size_label_${id_num}" class="py-1 px-2 border rounded"
            //                         for="small_size">S</label>
            //                     <input class="size_radio_btn" type="radio" name="size${id_num}" id="medium_size_${id_num}"
            //                         data-id="medium_size" value="medium" required>
            //                     <label id="medium_size_label_${id_num}" class="py-1 px-2 border rounded"
            //                         for="medium_size">M</label>
            //                     <input class="size_radio_btn" type="radio" name="size${id_num}" id="large_size_${id_num}"
            //                         data-id="large_size" value="large" required>
            //                     <label id="large_size_label_${id_num}" class="py-1 px-2 border rounded"
            //                         for="large_size">L</label>
            //                 </div>
            //             </div>
            //             <div class="col-3">
            //                 <label for="price">Price</label>
            //                 <input type="text" name="price[]" class="form-control" required>
            //             </div>
            //             <div class="col-3">
            //                 <label for="stock">Stock</label>
            //                 <input type="text" name="stock[]" class="form-control" required>
            //             </div>
            //         </div>
            //     </div>
            //     `;
            //     $('#product_attr_div').append(html);
            //     id_num++
            // })
            $(document).on('click', '#product_attr_btn', function(e) {
                e.preventDefault();
                $('#product_attr_form').trigger('submit');
            })
        })
    </script>
@endsection
