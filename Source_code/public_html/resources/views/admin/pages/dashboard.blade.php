@extends('layouts.admin.layouts.main')
@section('title', 'CLP | Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Dashboard</li>
@endsection
@section('content')
    <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 20-->
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-md-50 mb-5 mb-xl-10"
                 style="background-color: #0486b6;">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span class="fs-2hx fw-bold text-white me-2 lh-1 ls-n2">{{$schoolInfo ?? 0}}</span>
                        <!--end::Amount-->
                        <!--begin::Subtitle-->
                        <span class="text-white opacity-75 pt-1 fw-semibold fs-6">Total Schools</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex align-items-end pt-0">
                    <!--begin::Progress-->
                    <div class="d-flex align-items-center flex-column mt-3 w-100">
                        <div
                            class="d-flex justify-content-between fw-bold fs-6 text-white opacity-75 w-100 mt-auto mb-2">
                            <span>43 Pending</span>
                            <span>72%</span>
                        </div>
                        <div class="h-8px mx-3 w-100 bg-white bg-opacity-50 rounded">
                            <div class="bg-white rounded h-8px" role="progressbar" style="width: 72%;"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end::Progress-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 20-->
            <!--begin::Card widget 7-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Amount-->
                        <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$volunteers ?? 0}}</span>
                        <!--end::Amount-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Volunteers</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body d-flex flex-column justify-content-end pe-0">
                    <!--begin::Title-->
                    <span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Today’s Heroes</span>
                    <!--end::Title-->
                    <!--begin::Users group-->
                    <div class="symbol-group symbol-hover flex-nowrap">
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                            <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                            <img alt="Pic" src="{{asset('assets/img/news/img04.jpg')}}"/>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                            <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                            <img alt="Pic" src="{{asset('assets/img/news/img03.jpg')}}"/>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                            <span class="symbol-label bg-danger text-inverse-danger fw-bold">P</span>
                        </div>
                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                            <img alt="Pic" src="{{asset('assets/img/news/img02.jpg')}}"/>
                        </div>
                        <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_view_users">
                            <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                        </a>
                    </div>
                    <!--end::Users group-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 7-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            <!--begin::Card widget 17-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$upazilas}}</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-success fs-base">
															<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>2.2%</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Upazila</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70"
                             data-kt-line="11"></div>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 17-->
            <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header pt-5">
                    <!--begin::Title-->
                    <div class="card-title d-flex flex-column">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <!--begin::Amount-->
                            <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{$districts}}</span>
                            <!--end::Amount-->
                            <!--begin::Badge-->
                            <span class="badge badge-light-success fs-base">
															<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																<span class="path1"></span>
																<span class="path2"></span>
															</i>2.2%</span>
                            <!--end::Badge-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Subtitle-->
                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Total Districts</span>
                        <!--end::Subtitle-->
                    </div>
                    <!--end::Title-->
                </div>
                <!--end::Header-->
                <!--begin::Card body-->
                <div class="card-body pt-2 pb-4 d-flex flex-wrap align-items-center">
                    <!--begin::Chart-->
                    <div class="d-flex flex-center me-5 pt-2">
                        <div id="kt_card_widget_17_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70"
                             data-kt-line="11"></div>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Labels-->
                    <div class="d-flex flex-column content-justify-center flex-row-fluid">
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-success me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Leaf CRM</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$7,660</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center my-3">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 bg-primary me-3"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Mivy App</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$2,820</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fw-semibold align-items-center">
                            <!--begin::Bullet-->
                            <div class="bullet w-8px h-3px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                            <!--end::Bullet-->
                            <!--begin::Label-->
                            <div class="text-gray-500 flex-grow-1 me-4">Others</div>
                            <!--end::Label-->
                            <!--begin::Stats-->
                            <div class="fw-bolder text-gray-700 text-xxl-end">$45,257</div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card widget 17-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-6">
            <div class="card card-flush h-md-100">
                <!--begin::Header-->
                <div class="card-header pt-7">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-800">Projects Stats</span>
                        <span class="text-gray-400 mt-1 fw-semibold fs-6">Updated 37 minutes ago</span>
                    </h3>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-sm btn-light">History</a>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body pt-6">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 pb-3 min-w-175px text-start">ITEM</th>
                                <th class="p-0 pb-3 min-w-100px text-end">BUDGET</th>
                                <th class="p-0 pb-3 min-w-100px text-end">PROGRESS</th>
                                <th class="p-0 pb-3 min-w-175px text-end pe-12">STATUS</th>
                                <th class="p-0 pb-3 w-50px text-end">VIEW</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{asset('assets/img/news/img01.jpg')}}" class="" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Mivy
                                                App</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Jane Cooper</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$32,400</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
																		<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{asset('assets/img/news/img05.jpg')}}" class="" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Avionica</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Esther Howard</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$256,910</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-danger fs-base">
																		<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>0.4%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-warning">On Hold</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{asset('assets/img/news/img04.jpg')}}" class="" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Charto
                                                CRM</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Jenny Wilson</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$8,220</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
																		<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{asset('assets/img/news/img03.jpg')}}" class="" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">Tower
                                                Hill</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Cody Fisher</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$74,000</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
																		<i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>9.2%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-success">Complated</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <img src="{{asset('assets/img/news/img02.jpg')}}" class="" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="#" class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6">9
                                                Degree</a>
                                            <span class="text-gray-400 fw-semibold d-block fs-7">Savannah Nguyen</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="text-gray-600 fw-bold fs-6">$183,300</span>
                                </td>
                                <td class="text-end pe-0">
                                    <!--begin::Label-->
                                    <span class="badge badge-light-danger fs-base">
																		<i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
																			<span class="path1"></span>
																			<span class="path2"></span>
																		</i>0.4%</span>
                                    <!--end::Label-->
                                </td>
                                <td class="text-end pe-12">
                                    <span class="badge py-3 px-4 fs-7 badge-light-primary">In Process</span>
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                       class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                        <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end: Card Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>

@endsection
