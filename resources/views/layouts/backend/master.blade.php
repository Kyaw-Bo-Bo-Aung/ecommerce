<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    {{-- custom css --}}
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    {{-- select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.backend.navbar')
        <div class="app-main">
            @include('layouts.backend.sidebar')

            @yield('content')

        </div>
    </div>

    @include('layouts.backend.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- data table --}}
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    {{-- js form validation --}}
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {{-- custom --}}
    <script type="text/javascript" src="{{ asset('backend/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/custom.js') }}"></script>
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2600,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            @if (session('status'))
                Toast.fire({
                icon: 'success',
                title: "{{ session('status') }}"
                });
            @endif

        })
    </script>
    @yield('scripts')
</body>
<!-- Modal -->
{{-- <div class="modal fade" id="product_attr_modal_div" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="product_attr_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product_attr_modal">Stock info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-10">
                        <form id="product_attr_form" action="{{ route('admin.products.post-attributes') }}"
                            method="POST">
                            @csrf
                            <div class="row" id="product_attr_div">
                                <div class="col-12 form-list">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="sku">SKU</label>
                                            <input type="text" name="sku[]" class="form-control" required>
                                        </div>
                                        <div class="col-3">
                                            <label>Size</label>
                                            <div>
                                                <input class="size_radio_btn" type="radio" name="size0" id="small_size"
                                                    data-id="small_size" value="small" required>
                                                <label id="small_size_label" class="py-1 px-2 border rounded"
                                                    for="small_size">S</label>
                                                <input class="size_radio_btn" type="radio" name="size0"
                                                    id="medium_size" data-id="medium_size" value="medium" required>
                                                <label id="medium_size_label" class="py-1 px-2 border rounded"
                                                    for="medium_size">M</label>
                                                <input class="size_radio_btn" type="radio" name="size0" id="large_size"
                                                    data-id="large_size" value="large" required>
                                                <label id="large_size_label" class="py-1 px-2 border rounded"
                                                    for="large_size">L</label>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price[]" class="form-control" required>
                                        </div>
                                        <div class="col-3">
                                            <label for="stock">Stock</label>
                                            <input type="text" name="stock[]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-2 align-self-end">
                        <button class="btn btn-outline-info my-1 add_product_attr_div">
                            <i class="fa fa-plus"></i>
                        </button>
                        <button class="btn btn-outline-danger my-1">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>


                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="product_attr_btn" type="button" class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div> --}}

</html>
