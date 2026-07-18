@extends('layouts.admin.layouts.main')
@section('title')
    CLP | Upazila
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Upazila</li>
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
				<input type="text" data-kt-user-table-filter="search" id="upazilaSearchInput" class="form-control form-control-solid w-250px ps-13 datatable-search" placeholder="Search upazila" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
				<!--begin::Add user-->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_upazila">
				<i class="ki-duotone ki-plus fs-2"></i>Add Upazila</button>
				<!--end::Add user-->
			</div>
			<!--end::Toolbar-->
			<!--begin::Group actions-->
			<div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
				<div class="fw-bold me-5">
				<span class="me-2" data-kt-user-table-select="selected_count"></span>Selected</div>
				<button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete Selected</button>
			</div>
            <!--start::Modal - Add task-->
            @include('admin.pages.upazila.modals.add-upazila')
            {{-- @include('admin.modals.view-upazila') --}}
            @include('admin.pages.upazila.modals.edit-upazila')
			<!--end::Modal - Add task-->
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4">
		<!--begin::Table-->
		<table class="table align-middle table-row-dashed datatable fw-bold text-gray-800 fs-6 gy-5" id="clp_table_upazila">
			<thead>
				<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 text-gray-800 text-gray-800">
					<th class="w-10px pe-2">
						<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
							<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#clp_table_upazila .form-check-input" value="1" />
						</div>
					</th>
					<th class="min-w-200px text-center">Name</th>
					<th class="min-w-200px text-center">District Name</th>
					<th class="text-end min-w-150px">Actions</th>
				</tr>
			</thead>
			<tbody class="text-gray-600 fw-semibold">
            @foreach ($upazilas as $key => $upazila)
                <tr>
					<td>
						<div class="form-check form-check-sm form-check-custom form-check-solid">
							<input class="form-check-input" type="checkbox" value={{ $key + 1 }} />
						</div>
					</td>
					<td class="text-center" >{{ $upazila->name }}</td>
					<td class="text-center" >{{ $upazila->district->state_name ?? '' }}</td>
					<td class="text-end">
						<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" onclick="populateModalEditData('{{ $upazila->id }}')">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="showConfirmationDialog('status', function() { handleDelete('{{ $upazila->id }}'); })">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a>
						<form id="deleteUpazila"  action="" method="post" class="d-none">
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
    $(document).ready(function() {
		// Call districts
		$.ajax({
			url: '/admin/districts',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				var select = $('#add-upazila-district');
				select.empty();
				select.append('<option value="">Select an option</option>');
				$.each(data.districts, function (index, district) {
					select.append('<option value="' + district.id + '">' + district.state_name + '</option>');
				});

				//
				var editDistrictSelect = $('#edit-upazila-district');
				editDistrictSelect.empty();
				editDistrictSelect.append('<option value="">Select an option</option>');
				$.each(data.districts, function (index, district) {
					editDistrictSelect.append('<option value="' + district.id + '">' + district.state_name + '</option>');
				});
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error('Error fetching countries: ' + textStatus);
			}
		});
    });
</script>
<script>
	let upazilas = {!! json_encode($upazilas) !!};

	function populateModalEditData(upazilaId){
		const upazila = upazilas.find(upazila => upazila.id == upazilaId);
		if(upazila){
			$('#edit-upazila-id').val(upazila.id);
			$('#edit-upazila-name').val(upazila.name);
			if(upazila.district){
				$('#edit-upazila-district').val(upazila.district.id).trigger('change');
			}

			$('#kt_modal_edit_upazila_form').attr('action', 'upazilas/' + upazila.id);
			$('#kt_modal_edit_upazila').modal('show');
		}
	}
</script>

<script>
	function handleDelete(newsId) {
		$('#deleteUpazila').attr('action', 'upazilas/' + newsId);
		var deleteForm = $('#deleteUpazila');

		// Submit the form
		deleteForm.submit();
    }
</script>
		
@endsection