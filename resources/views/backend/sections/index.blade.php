@extends('layouts.backend.master')
@section('title', 'Section')
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
                        Sections</div>
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
                <h5 class="card-title">Manage your sections</h5>

                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @php
                            $section_no = 1;
                        @endphp
                        @foreach ($sections as $section)
                            <tr>
                                <td> {{ $section_no++ }}</td>
                                <td> {{ $section->name }}</td>
                                <td>
                                    @if ($section->status === 1)
                                        <div id="status_label_{{ $section->id }}" class="custom-control custom-switch">
                                            <input type="checkbox" status="{{ $section->status }}"
                                                class="update_status_toggler custom-control-input"
                                                id="customSwitch{{ $section->id }}" checked
                                                section_id="{{ $section->id }}">
                                            <label class="custom-control-label" id="section_{{$section->id}}"
                                                for="customSwitch{{ $section->id }}">Active</label>
                                        </div>
                                    @else
                                        <div id="status_label_{{ $section->id }}" class="custom-control custom-switch">
                                            <input type="checkbox" status="{{ $section->status }}"
                                                class="update_status_toggler custom-control-input"
                                                id="customSwitch{{ $section->id }}" section_id="{{ $section->id }}">
                                            <label class="custom-control-label" id="section_{{$section->id}}"
                                                for="customSwitch{{ $section->id }}">Inactive</label>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tfoot>
                </table>
            </div>
        </div>
    </div> <!-- end setting form -->
</div>
@endsection
@section('scripts')
<script>
    $(function() {
        $('.update_status_toggler').on('change', function(e) {
            e.preventDefault();
            let status = $(this).attr('status');
            let section_id = $(this).attr('section_id');
            //    alert(section_id);
            $.ajax({
                url: '/admin/sections/update-status',
                type: 'POST',
                data: {
                    status: status,
                    section_id: section_id
                },
                success: function(res) {
                       let section_id = res.section_id;
                       let status = res.status;
                       console.log(status);
                       if(status == 1) {
                        $('#section_'+section_id).text('Active');
                        $('#customSwitch'+section_id).attr('status', status);
                       }else if(status == 0){
                        $('#section_'+section_id).text('Inactive');
                        $('#customSwitch'+section_id).attr('status', status);
                       }    
                }
            })
        })
    })
</script>
@endsection
