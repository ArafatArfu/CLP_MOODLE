<div class="modal fade" id="kt_modal_add_school" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-450px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header" id="kt_modal_add_school_header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Add School</h2>
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
				<form id="kt_modal_add_school_form" class="form form-validate" method="POST" action="{{ route('schools.store') }}" enctype="multipart/form-data">
					@csrf

					<!--begin::Scroll-->
					<div
						class="d-flex flex-column scroll-y px-5 px-lg-10"
						id="kt_modal_add_school_scroll"
						data-kt-scroll="true"
						data-kt-scroll-activate="true"
						data-kt-scroll-max-height="auto"
						data-kt-scroll-dependencies="#kt_modal_add_school_header"
						data-kt-scroll-wrappers="#kt_modal_add_school_scroll"
						data-kt-scroll-offset="300px"
					>
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required form-label fw-semibold fs-6 mb-2">School Name</label>
							<!--end::Label-->

							<!--begin::Input-->
							<input
								type="text"
								id="add-school-name"
								required
								name="school_name"
								class="form-control form-control-solid mb-3 mb-lg-0"
								placeholder="School name"
							/>
							<!--end::Input-->
						</div>

						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">Upazila</label>
							<!--end::Label-->

							<!--begin::Input-->
							<select
								required
								id="add-school-upazila"
								class="form-select form-select-solid"
								name="cities_id"
							>
								<option value=""></option>
								{{-- Example options --}}
								{{-- <option value="1">Dhaka</option>
								<option value="2">Gazipur</option>
								<option value="3">Manikগঞ্জ</option> --}}
							</select>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Scroll-->

					<!--begin::Actions-->
					<div class="text-center pt-10">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>

						<button type="submit" class="btn btn-primary" data-kt-school-modal-action="submit">
							<span class="indicator-label">Submit</span>
							<span class="indicator-progress">
								Please wait...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
							</span>
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

<script>
	$(document).ready(function () {
		function initUpazilaSelect() {
			let $select = $('#add-school-upazila');

			if ($select.hasClass('select2-hidden-accessible')) {
				$select.select2('destroy');
			}

			$select.select2({
				dropdownParent: $('#kt_modal_add_school'),
				placeholder: 'Select an option',
				allowClear: true,
				width: '100%'
			});
		}

		// Initialize when modal is shown
		$('#kt_modal_add_school').on('shown.bs.modal', function () {
			initUpazilaSelect();

			// focus on select2 search field automatically
			setTimeout(function () {
				$('.select2-container--open .select2-search__field').focus();
			}, 100);
		});

		// Optional: initialize once on page load if needed
		initUpazilaSelect();
	});
</script>