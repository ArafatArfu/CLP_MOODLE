@extends('layouts.admin.layouts.main')
@section('title')
    CLP | School Info
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">School Info</li>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-user-table-filter="search" id="schoolInfoSearchInput"
                           class="form-control form-control-solid w-250px ps-13 datatable-search"
                           placeholder="Search school info"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add School info-->
                    <a href="{{ route('school-infos.create') }}" class="btn btn-primary" >
                        <i class="ki-duotone ki-plus fs-2"></i>Add School Info
                    </a>
                    <!--end::Add user-->
                </div>
                <!--end::Toolbar-->
                <!--begin::Group actions-->
                <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                        Selected
                    </button>
                </div>
                <!--start::Modal - Add task-->
                @include('admin.pages.school-info.modals.add')
                @include('admin.pages.school-info.modals.view')
                @include('admin.pages.school-info.modals.edit')
                <!--end::Modal - Add task-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed datatable fw-bold text-gray-800 fs-6 gy-5"
                   id="clp_table_school_info">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 text-gray-800 text-gray-800">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#clp_table_school_info .form-check-input" value="1"/>
                        </div>
                    </th>
                    <th class="min-w-100px text-center">School</th>
                    {{-- <th class="min-w-100px text-center">District</th> --}}
                    <th class="min-w-100px text-center">Center Types</th>
                    {{-- <th class="min-w-100px text-center">Start Date</th> --}}
                    {{-- <th class="min-w-100px text-center">Support Condition</th> --}}
                    <th class="min-w-100px text-center">Sponsor</th>
                    <th class="min-w-100px text-center">Contact</th>
                    <th class="min-w-100px text-center">Support</th>
                    <th class="text-end min-w-150px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                @foreach ($schoolInfos as $key => $info)
                    @php
                        $centers = [];
                        if($info->clc){
                         $centers = explode(', ', $info->clc);
                        }
                    @endphp
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value={{ $key + 1 }} />
                            </div>
                        </td>
                        <td class="text-justify">{{ $info->school->school_name ?? ''}}</td>
                        {{-- <td class="text-center" >{{ $info->district}}</td> --}}
                        <td class="text-center">
                                @foreach($centers as $center)
                                    <span class="badge badge-{{$center === 'clc' ? 'info' : 'primary'}} text-uppercase">{{$center}}</span>
                                @endforeach
                        </td>
                        {{-- <td class="text-center" >{{ $info->start_date}}</td> --}}
                        {{-- <td class="text-center" >{{ $info->support}}</td> --}}
                        <td class="text-center">{!! $info->sponsor_name !!}</td>
                        <td class="text-center">{!! $info->contact_phone !!} </td>
                        <td class="text-center">
                            @if ($info->support == config('constants.CENTER_STATUS_SUPPORTED'))
                                <div class="badge badge-success fw-bold">SUPPORTED</div>
                            @elseif ($info->support == config('constants.CENTER_STATUS_REACTIVATED'))
                                <div class="badge badge-info fw-bold">REACTIVATED</div>
                            @else
                                <div class="badge badge-warning fw-bold">NOT SUPPORTED</div>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                               onclick="populateModalData('{{ $info->id }}')">
                                <i class="ki-duotone ki-switch fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="{{ route('school-infos.edit', $info->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                               onclick="showConfirmationDialog('status', function() { handleDelete('{{ $info->id }}'); })">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </a>
                            <form id="deleteSchool" action="" method="post" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <script>
        let schoolInfos = {!! json_encode($schoolInfos) !!};

        function populateModalData(infoId) {
            const schoolInfo = schoolInfos.find(info => info.id == infoId);
            if (schoolInfo) {
                $('#view-school-info-school-name').text(schoolInfo.school.school_name);
                $('#view-school-info-center').html(schoolInfo.clc);
                $('#view-school-info-start-date').html(schoolInfo.start_date);
                $('#view-school-info-support-condition').html(schoolInfo.support);
                $('#view-school-info-mailing-address').html(schoolInfo.mail);
                $('#view-school-info-history-center').html(schoolInfo.history);
                $('#view-school-info-contact').html(schoolInfo.contact_phone);
                $('#view-school-info-sponsor-name').html(schoolInfo.sponsor_name);
                $('#view-school-info-accomplishment').html(schoolInfo.accomplish);
                $('#view-school-info-number-visit').html(schoolInfo.scr);
                $('#view-school-info-flow').html(schoolInfo.ds);
                $('#view-school-info-clc-graduate').html(schoolInfo.csaw);
                $('#view-school-info-hardware').html(schoolInfo.hardware);

                let statusElement = document.getElementById('view-school-info-status');
                if (schoolInfo.status === 1) {
                    statusElement.innerHTML = '<div class="badge badge-Success fw-bold">Active</div>';
                } else {
                    statusElement.innerHTML = '<div class="badge badge-danger fw-bold">Inactive</div>';
                }

                $('#view-school-info-plague, #view-school-info-plague1, #view-school-info-plague2, #view-school-info-photo, #view-school-info-photo1, #view-school-info-photo2').removeAttr('src');
                if (schoolInfo.plaquefile) {
                    let image = removePublicSegment(schoolInfo.plaquefile);
                    $('#view-school-info-plague').attr('src', image);
                }
                if (schoolInfo.plaquefile1 && schoolInfo.plaquefile1 !== "no image") {
                    let image = removePublicSegment(schoolInfo.plaquefile1);
                    $('#view-school-info-plague1').attr('src', image);
                }
                if (schoolInfo.plaquefile2 && schoolInfo.plaquefile2 !== "no image") {
                    let image = removePublicSegment(schoolInfo.plaquefile2);
                    $('#view-school-info-plague2').attr('src', image);
                }
                if (schoolInfo.photofile) {
                    let image = removePublicSegment(schoolInfo.photofile);
                    $('#view-school-info-photo').attr('src', image);
                }
                if (schoolInfo.photofile1 && schoolInfo.photofile1 !== "no image") {
                    let image = removePublicSegment(schoolInfo.photofile1);
                    $('#view-school-info-photo1').attr('src', image);
                }
                if (schoolInfo.photofile2 && schoolInfo.photofile2 !== "no image") {
                    let image = removePublicSegment(schoolInfo.photofile2);
                    $('#view-school-info-photo2').attr('src', image);
                }

                $('#kt_modal_view_school_info').modal('show');
            }
        }
    </script>

    <script>
        function handleDelete(infoId) {
            $('#deleteSchool').attr('action', 'school-infos/' + infoId);
            var deleteForm = $('#deleteSchool');

            // Submit the form
            deleteForm.submit();
        }
    </script>

@endsection
