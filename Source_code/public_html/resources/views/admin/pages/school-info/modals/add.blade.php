<div class="modal fade" id="kt_modal_add_school_info" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-850px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Add Center Information</h2>
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
			<div class="modal-body px-5 my-7">
				<!--begin::Form-->
				<form id="kt_modal_add_school_info_form" class="form form-validate" method="POST" action="{{ route('school-infos.store') }}" enctype="multipart/form-data">
					@csrf
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_shchool_info_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">School</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select id="add-school-info-name" class="form-select form-select-solid" name="schools_id" data-control="select2" data-placeholder="Select an option" data-allow-clear="true"></select>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">Center Type</label>
							<!--end::Label-->
							<!--begin::Input-->
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox" id="add-school-info-clc" value="clc" name="clc[]" checked>
                                    <span></span>
                                    CLC
                                </label>
                                <label class="checkbox" >
                                    <input type="checkbox" id="add-school-info-clc-scr" value="scr" name="clc[]">
                                    <span></span>
                                    SCR
                                </label>
                            </div>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-start-date" class="required fw-semibold fs-6 mb-2">Start Date</label>
							<!--end::Label-->
							<!--begin::Input-->
                            <input id="add-school-info-start-date" type="text" name="start_date" class="form-control form-control-solid mb-3 mb-lg-0 flatpickr" placeholder="Start Date" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-support-condition" class="required fw-semibold fs-6 mb-2">Support Status</label>
							<!--end::Label-->
							<!--begin::Input-->
							<select required id="add-school-info-support-condition" class="form-select form-select-solid" name="support" data-control="select2" data-placeholder="Select an option" data-allow-clear="true">
                                <option value="">Select an option</option>
                                <option selected value="{{config('constants.CENTER_STATUS_SUPPORTED')}}">Supported</option>
                                <option value="{{config('constants.CENTER_STATUS_REACTIVATED')}}">Reactivated</option>
                                <option value="{{config('constants.CENTER_STATUS_NOT_SUPPORTED')}}">Not Supported</option>
                            </select>
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Mailing Address</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-mail" type="text" name="mail" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Mailing address" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-history" class="required fw-semibold fs-6 mb-2">History of the Center</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-school-info-history" type="textarea" name="history" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="Center history"></textarea>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-contact" class="required fw-semibold fs-6 mb-2">Contact person with Phone & Email</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-school-info-contact" type="textarea" name="contact_phone" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="Contact phone & email"></textarea>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-sponsor" class="required fw-semibold fs-6 mb-2">Sponsor Info</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-school-info-sponsor" type="textarea" name="sponsor_name" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="Sponsor info"></textarea>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-accomplish" class="required fw-semibold fs-6 mb-2">Accomplishment</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-school-info-accomplish" type="textarea" name="accomplish" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="Your message"></textarea>
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Number of Visit</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-scr" type="text" name="scr" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Number of visit" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Flow up over phone</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-ds" type="text" name="ds" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Flow up over phone" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Number Of CLC Graduate Students Or SCR Benefited Students</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-csaw" type="text" name="csaw" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="Number Of CLC Graduate Students Or SCR Benefited Students" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label for="add-school-info-hardware" class="required fw-semibold fs-6 mb-2">Hardware Status</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-school-info-hardware" type="textarea" name="hardware" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="Hardware status"></textarea>
							<!--end::Input-->
						</div>
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Plaque</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-plaque" type="file" name="plaquefile" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Plaque1</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-plaque1" type="file" name="plaquefile1" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Plaque2</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-plaque1" type="file" name="plaquefile2" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Photo</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-photo" type="file" name="photofile" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Photo1</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-plaque1" type="file" name="photofile1" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
                        <div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Photo2</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-school-info-plaque1" type="file" name="photofile2" class="form-control form-control-solid mb-3 mb-lg-0" />
							<!--end::Input-->
						</div>
						<!--end::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label for="add-school-info-status"  class="required fw-semibold fs-6 mb-2">Status</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select required id="add-school-info-status" class="form-select form-select-solid" name="status" data-control="select2" data-placeholder="Select an option" data-allow-clear="true">
                                <option selected value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <!--end::Input-->
                        </div>
						<!--end::Input group-->
					</div>
					<!--end::Scroll-->
					<!--begin::Actions-->
					<div class="text-center pt-10">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
						<button type="submit" class="btn btn-primary">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">Please wait...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
