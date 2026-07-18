@extends('layouts.admin.layouts.main')
@section('title')
    CLP | News
@endsection
@section('styles')
    <style>
        img {
            width: auto;
            max-height: 120px
        }
    </style>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">
        <a href="{{route('news.index')}}" class="text-muted text-hover-primary">News</a>
    </li>
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-muted">Edit news</li>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title text-center">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <h2>Edit News</h2>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Form-->
            <form id="kt_modal_edit_news_form" class="form" method="POST" action='{{ route("news.update", $news->id) }}' enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="news_id" id="edit-news-id" value="" /> <!-- Hidden field for news ID -->
                <!--begin::Scroll-->
                <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_news_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Title</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" required name="title" class="form-control form-control-solid mb-3 mb-lg-0" id="edit-news-title" value="{{ $news->title }}" placeholder="News title" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Slug</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" required name="slug" class="form-control form-control-solid mb-3 mb-lg-0" id="edit-news-slug" value="{{ $news->slug }}" placeholder="News slug" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Description</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea type="textarea" id="edit-news-description" name="description" class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="News description">{{ $news->description }}</textarea>
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Summary</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea id="edit-news-summary" type="textarea" name="summary" class="form-control form-control-solid mb-3 mb-lg-0 textarea-ck" placeholder="News summary">{{ $news->summary }}</textarea>
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Youtube Embedded URL</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="url" id="edit-news-youtube-url" name="youtube_url" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $news->youtube_url }}" placeholder="News youtube URL" />
                        <!--end::Input-->
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required form-label">Date</label>
                        <!--end::Label-->
                        <!--begin::Editor-->
                        <input id="edit-news-date" name="date" placeholder="Select a date" required class="form-control form-control-solid mb-3 mb-lg-0 flatpickr" value="{{ $news->date }}" />
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
                            {{-- <div id="news-edit-image" class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ asset('root/metro/assets/media/avatars/blank.png')}}')"></div> --}}
                            <div id="news-edit-image" class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $news->image_url ? asset($news->image_url) : asset('root/metro/assets/media/avatars/blank.png') }}')"></div>

                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                <i class="ki-duotone ki-pencil fs-7">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" src="{{ $news->image_url }}" />
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
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->

    <script>
        // jQuery to handle title input change
        $(document).ready(function () {
            $('#edit-news-title').on('input', function () {
                const title = $(this).val();
                const slug = generateSlug(title);
                $('#edit-news-slug').val(slug);
            });
        });
    </script>

@endsection
