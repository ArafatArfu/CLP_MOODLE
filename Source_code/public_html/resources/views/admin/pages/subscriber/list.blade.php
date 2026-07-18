@extends('layouts.admin.layouts.main')
@section('title')
    CLP | Subscriber
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Subscriber</li>
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
				<input type="text" data-kt-user-table-filter="search" id="subscriberSearchInput" class="form-control form-control-solid w-250px ps-13 datatable-search" placeholder="Search subscriber" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			{{-- <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
				<!--begin::Add user-->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_subscriber">
				<i class="ki-duotone ki-plus fs-2"></i>Add Subscriber</button>
				<!--end::Add user-->
			</div> --}}
			<!--end::Toolbar-->
			<!--begin::Group actions-->
			<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
				<div class="fw-bold me-5">
				<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
				<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
			</div>
            <!--start::Modal - Add task-->
            {{-- @include('admin.pages.subscriber.modals.add-subscriber') --}}
            {{-- @include('admin.modals.view-subscriber') --}}
            {{-- @include('admin.pages.subscriber.modals.edit-subscriber') --}}
			<!--end::Modal - Add task-->
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4">
		<!--begin::Table-->
		<table class="table align-middle table-row-dashed datatable fw-bold text-gray-800 fs-6 gy-5" id="clp_table_subscriber">
			<thead>
				<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 text-gray-800 text-gray-800">
					<th class="w-10px pe-2">
						<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
							<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#clp_table_subscriber .form-check-input" value="1" />
						</div>
					</th>
					<th class="min-w-150px text-center">Firstname</th>
					<th class="min-w-150px text-center">Lastname</th>
					<th class="min-w-200px text-center">Email</th>
					<th class="min-w-150px text-center">Phone</th>
					<th class="min-w-100px text-center">Zip</th>
					<th class="text-end min-w-15a0px">Actions</th>
				</tr>
			</thead>
			<tbody class="text-gray-600 fw-semibold">
            @foreach ($subscribers as $key => $subscriber)
                <tr>
					<td>
						<div class="form-check form-check-sm form-check-custom form-check-solid">
							<input class="form-check-input" type="checkbox" value={{ $key + 1 }} />
						</div>
					</td>
					<td class="text-center" >{{ $subscriber->first_name }}</td>
					<td class="text-center" >{{ $subscriber->last_name }}</td>
					<td class="text-center" >{{ $subscriber->email }}</td>
					<td class="text-center" >{{ $subscriber->phone }}</td>
					<td class="text-center" >{{ $subscriber->zip }}</td>
					<td class="text-end">
						{{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" onclick="populateModalEditData('{{ $subscriber->id }}')">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a> --}}
                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="showConfirmationDialog('status', function() { handleDelete('{{ $subscriber->id }}'); })">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a>
						<form id="deletesubscriber"  action="" method="post" class="d-none">
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
	function handleDelete(subscriberId) {
		$('#deletesubscriber').attr('action', 'subscribers/' + subscriberId);
		var deleteForm = $('#deletesubscriber');

		// Submit the form
		deleteForm.submit();
    }
</script>
		
@endsection