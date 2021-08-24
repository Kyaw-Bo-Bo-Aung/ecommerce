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
                </div>
            </div>
            {{-- setting form --}}
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Manage your sections</h5>

                    <table id="section_table" class="table table-hover">
                        <thead class="bg-light">
                            <th>Name</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td> {{ $section->name }}</td>
                                    <td>
                                        @if ($section->status === 1)
                                            <div id="status_label_{{ $section->id }}"
                                                class="custom-control custom-switch">
                                                <input type="checkbox" status="{{ $section->status }}"
                                                    class="update_status_toggler custom-control-input"
                                                    id="customSwitch{{ $section->id }}" checked
                                                    section_id="{{ $section->id }}">
                                                <label class="custom-control-label" id="section_{{ $section->id }}"
                                                    for="customSwitch{{ $section->id }}">Active</label>
                                            </div>
                                        @else
                                            <div id="status_label_{{ $section->id }}"
                                                class="custom-control custom-switch">
                                                <input type="checkbox" status="{{ $section->status }}"
                                                    class="update_status_toggler custom-control-input"
                                                    id="customSwitch{{ $section->id }}"
                                                    section_id="{{ $section->id }}">
                                                <label class="custom-control-label" id="section_{{ $section->id }}"
                                                    for="customSwitch{{ $section->id }}">Inactive</label>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-light">
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
            $('#section_table').dataTable();
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
                        if (status == 1) {
                            $('#section_' + section_id).text('Active');
                            $('#customSwitch' + section_id).attr('status', status);
                        } else if (status == 0) {
                            $('#section_' + section_id).text('Inactive');
                            $('#customSwitch' + section_id).attr('status', status);
                        }
                    }
                })
            })
        })
    </script>
@endsection
