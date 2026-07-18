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
    <li class="breadcrumb-item text-muted">News</li>
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
                    <input type="text" data-kt-user-table-filter="search" id="userSearchInput"
                           class="form-control form-control-solid w-250px ps-13 datatable-search"
                           placeholder="Search news"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <!--begin::Add user-->
                    <a href="{{ route('news.create') }}" class="btn btn-primary" >
                        <i class="ki-duotone ki-plus fs-2"></i>Add News
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
                @include('admin.modals.add-news')
                @include('admin.modals.view-news')
                @include('admin.modals.edit-news')
                <!--end::Modal - Add task-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed datatable fs-6 gy-5" id="clp_table_news">
                <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 text-gray-800">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#clp_table_news .form-check-input" value="1"/>
                        </div>
                    </th>
                    <th class="min-w-125px">Title</th>
                    <th class="min-w-125px">Summary</th>
                    <th class="min-w-125px">Date</th>
                    <th class="min-w-50px">Status</th>
                    <th class="text-end min-w-150px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-semibold">
                @foreach ($newses as $key => $news)
                    <tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value={{ $key + 1 }} />
                            </div>
                        </td>
                        <td>{{ $news->title ? substr($news->title, 0, 100) : '' }}</td>
                        <td>{{ $news->summary ? substr($news->summary, 0, 200) : '' }}</td>
                        <td>{{ $news->date ? $news->date : '' }}</td>
                        <td>
                            <span style="cursor: pointer"
                                  onclick="showConfirmationDialog('status', function() { handleStatus('{{ $news->id }}'); })">
                                <div
                                    class="badge {{ $news->status === 'published' ? 'badge-success' : 'badge-warning' }} fw-bold">{{ strtoupper($news->status) }}</div>
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                               onclick="populateModalData('{{ $news->id }}')">
                                <i class="ki-duotone ki-switch fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>

                            <a href="{{ route('news.edit', $news->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                               onclick="showConfirmationDialog('status', function() { handleDelete('{{ $news->id }}'); })">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </a>
                            <form id="deleteNews" action="" method="post" class="d-none">
                                @csrf
                                @method('delete')
                            </form>
                            <form id="changeNewsStatus" action="" method="post" class="d-none">
                                @csrf
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
        let newses = {!! json_encode($newses) !!};

        function populateModalData(newsId) {
            const news = newses.find(news => news.id == newsId);
            if (news) {
                $('#view-news-title').text(news.title);
                $('#view-news-description').html(news.description);
                $('#view-news-summary').html(news.summary);
                $('#view-news-youtube-url').text(news.youtube_url);
                $('#view-news-status').text(news.status);

                if (news.image_url) {
                    $('#view-news-image').attr('src', news.image_url);
                }

                $('#kt_modal_view_news').modal('show');
            }
        }
    </script>

    <script>
        function handleStatus(newsId) {
            $('#changeNewsStatus').attr('action', '/admin/news/change-status/' + newsId);
            const statusForm = $('#changeNewsStatus');

            // Submit the form
            statusForm.submit();
        }

        function handleDelete(newsId) {
            $('#deleteNews').attr('action', '/admin/news/' + newsId);
            var deleteForm = $('#deleteNews');

            // Submit the form
            deleteForm.submit();
        }
    </script>

@endsection
