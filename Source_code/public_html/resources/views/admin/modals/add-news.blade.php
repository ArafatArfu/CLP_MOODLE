<div class="modal fade" id="kt_modal_add_news" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-850px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bold">Add News</h2>
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
				<form id="kt_modal_add_news_form" class="form form-validate" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
					@csrf
					<!--begin::Scroll-->
					<div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_news_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required required form-label fw-semibold fs-6 mb-2">Title</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" id="add-news-title" required name="title" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="News title" />
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">Slug</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-news-slug" type="text" required name="slug" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="News slug" />
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Description</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-news-editor" type="textarea" name="description" class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="News description"></textarea>
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fw-semibold fs-6 mb-2">Summary</label>
							<!--end::Label-->
							<!--begin::Input-->
							<textarea id="add-news-summary" type="textarea" name="summary" required class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="News summary"></textarea>
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fw-semibold fs-6 mb-2">Youtube Embedded URL</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input id="add-news-youtube-url" type="url" name="youtube_url" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="News youtube embedded url" />
							<!--end::Input-->
						</div>
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required form-label">Date</label>
							<!--end::Label-->
							<!--begin::Editor-->
							<input id="add-news-date" name="date" placeholder="Select a date" required class="form-control form-control-solid mb-3 mb-lg-0 flatpickr" value="" />
							<!--end::Editor-->
						</div>
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="d-block fw-semibold fs-6 mb-5">Image</label>
							<!--end::Label-->
							<!--begin::Image placeholder-->
							<style>.image-input-placeholder { background-image: url('assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('assets/media/svg/files/blank-image-dark.svg'); }</style>
							<!--end::Image placeholder-->
							<!--begin::Image input-->
							<div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
								<!--begin::Preview existing avatar-->
								<div id="news-edit-image" class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('root/metro/assets/media/avatars/blank.png')}}');"></div>
								<!--end::Preview existing avatar-->
								<!--begin::Label-->
								<label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
									<i class="ki-duotone ki-pencil fs-7">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
									<!--begin::Inputs-->
									<input id="add-news-image" type="file" name="image" accept=".png, .jpg, .jpeg" />
									<input type="hidden" name="image_remove" />
									<!--end::Inputs-->
								</label>
								<!--end::Label-->
								<!--begin::Cancel-->
								<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
									<i class="ki-duotone ki-cross fs-2">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<!--end::Cancel-->
								<!--begin::Remove-->
								<span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
									<i class="ki-duotone ki-cross fs-2">
										<span class="path1"></span>
										<span class="path2"></span>
									</i>
								</span>
								<!--end::Remove-->
							</div>
							<!--end::Image input-->
							<!--begin::Hint-->
							<div class="form-text">Allowed file types: png, jpg, jpeg.</div>
							<!--end::Hint-->
						</div>
						<!--end::Input group-->
						<!--end::Input group-->
					</div>
					<!--end::Scroll-->
					<!--begin::Actions-->
					<div class="text-center pt-10">
						<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
						<button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
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
