<div class="modal fade" id="kt_modal_view_news" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">View News</h2>
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
                            <td class="text-gray">
                                <h4>Title</h4>
                            </td>

                            <td class="text-gray">
                                <h4 id='view-news-title'></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray">
                                <h4>Description</h4>
                            </td>
                            <td class="text-gray">
                                <h4 id='view-news-description'></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray">
                                <h4>Summary</h4>
                            </td>
                            <td class="text-gray">
                                <h4 id='view-news-summary'></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray">
                                <h4>Youtube URL</h4>
                            </td>
                            <td class="text-gray">
                                <h4 id='view-news-youtube-url'></h4>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray">
                                <h4>Image</h4>
                            </td>
                            <td class="text-dark">
                                <img alt="news-view-image" id='view-news-image'
                                     src={{ asset('assets/metronic/assets/media/avatars/blank.png') }} />
                            </td>
                        </tr>
                        <tr>
                            <td class="text-gray">
                                <h4>Status</h4>
                            </td>
                            <td class="text-gray">
                                <h4 id='view-news-status'></h4>
                            </td>
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
