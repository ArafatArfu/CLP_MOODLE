<div class="modal fade" id="kt_modal_view_school_info" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">View School Info</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-2 my-7">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle ">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="border-0">
                                <th class="p-0 min-w-150px"></th>
                                <th class="p-0 min-w-150px"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <tr>
                                <td class="text-dark">
                                    <h4>Name of the Institution</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-school-name'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Center Type</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-center'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Start Date</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-start-date'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Support Condition</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-support-condition'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Mailing Addrese</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-mailing-address'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>History of the Center</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-history-center'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Contact Person with Phone & Email</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-contact'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Sponsor Name</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-sponsor-name'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Accomplishment</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-accomplishment'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Number of Visit</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-number-visit'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Flow up over phone</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-flow'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Number Of CLC Graduate Students Or SCR Benefited Students</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-clc-graduate'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Hardware Status</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-hardware'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Status</h4>
                                </td>
                                <td class="text-dark">
                                    <p id='view-school-info-status'></p>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-dark">
                                    <h4>Plague</h4>
                                </td>
                                <td class="text-dark">
                                    <img style="width: auto; max-height: 120px" id='view-school-info-plague' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                    <img style="width: auto; max-height: 120px" id='view-school-info-plague1' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                    <img style="width: auto; max-height: 120px" id='view-school-info-plague2' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                </td>
                                <tr>
                                    <td class="text-dark">
                                        <h4>Photo</h4>
                                    </td>
                                    <td class="text-dark">
                                        <img style="width: auto; max-height: 120px" id='view-school-info-photo' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                        <img style="width: auto; max-height: 120px" id='view-school-info-photo1' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                        <img style="width: auto; max-height: 120px" id='view-school-info-photo2' src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} alt="school-info-view-image" />
                                    </td>
                                </tr>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                </div>
                <div class="text-center pt-10">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
