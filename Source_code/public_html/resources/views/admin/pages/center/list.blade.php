@extends('layouts.admin.layouts.main')
@section('title')
    CLP | Center
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">Center</li>
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
				<input type="text" data-kt-user-table-filter="search" id="centerSearchInput" class="form-control form-control-solid w-250px ps-13 datatable-search" placeholder="Search center" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
				<!--begin::Add user-->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_center">
				<i class="ki-duotone ki-plus fs-2"></i>Add Center</button>
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
            @include('admin.pages.center.modals.add-center')
            {{-- @include('admin.modals.view-center') --}}
            @include('admin.pages.center.modals.edit-center')
			<!--end::Modal - Add task-->
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4">
		<!--begin::Table-->
		<table class="table align-middle table-row-dashed datatable fw-bold text-gray-800 fs-6 gy-5" id="clp_table_center">
			<thead>
				<tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0 text-gray-800 text-gray-800">
					<th class="w-10px pe-2">
						<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
							<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#clp_table_center .form-check-input" value="1" />
						</div>
					</th>
					<th class="min-w-200px text-center">Division Name</th>
					<th class="min-w-200px text-center">District Name</th>
					<th class="min-w-200px text-center">Upazila Name</th>
					<th class="min-w-200px text-center">School Name</th>
					<th class="text-end min-w-150px">Actions</th>
				</tr>
			</thead>
			<tbody class="text-gray-600 fw-semibold">
            @foreach ($centers as $key => $center)
                <tr>
					<td>
						<div class="form-check form-check-sm form-check-custom form-check-solid">
							<input class="form-check-input" type="checkbox" value={{ $key + 1 }} />
						</div>
					</td>
					<td class="text-center" >{{ $center->division->name ?? ''}}</td>
					<td class="text-center" >{{ $center->district->state_name ?? '' }}</td>
					<td class="text-center" >{{ $center->upazila->name ?? '' }}</td>
					<td class="text-center" >{{ $center->school->school_name ?? '' }}</td>
					<td class="text-end">
						<a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-bs-toggle="modal" onclick="populateModalEditData('{{ $center->id }}')">
                            <i class="ki-duotone ki-pencil fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </a>
                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="showConfirmationDialog('status', function() { handleDelete('{{ $center->id }}'); })">
                            <i class="ki-duotone ki-trash fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </a>
						<form id="deletecenter"  action="" method="post" class="d-none">
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
		// Call divisions
		$.ajax({
			url: '/admin/divisions',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				var select = $('#add-center-division');
				select.empty();
				select.append('<option value="">Select an option</option>');
				$.each(data.divisions, function (index, division) {
					select.append('<option value="' + division.id + '">' + division.name + '</option>');
				});

				//
				var editDivisionSelect = $('#edit-center-division');
				editDivisionSelect.empty();
				editDivisionSelect.append('<option value="">Select an option</option>');
				$.each(data.divisions, function (index, division) {
					editDivisionSelect.append('<option value="' + division.id + '">' + division.name + '</option>');
				});
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error('Error fetching countries: ' + textStatus);
			}
		});
    });
</script>
<script>
    $(document).ready(function() {
		// Call district
		$.ajax({
			url: '/admin/districts',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				var select = $('#add-center-district');
				select.empty();
				select.append('<option value="">Select an option</option>');
				$.each(data.districts, function (index, district) {
					select.append('<option value="' + district.id + '">' + district.state_name + '</option>');
				});

				//
				var editDistrictSelect = $('#edit-center-district');
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
    $(document).ready(function() {
		// Call upazilas
		$.ajax({
			url: '/admin/upazilas',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				var select = $('#add-center-upazila');
				select.empty();
				select.append('<option value="">Select an option</option>');
				$.each(data.upazilas, function (index, upazila) {
					select.append('<option value="' + upazila.id + '">' + upazila.name + '</option>');
				});

				//
				var editUpazilaSelect = $('#edit-center-upazila');
				editUpazilaSelect.empty();
				editUpazilaSelect.append('<option value="">Select an option</option>');
				$.each(data.upazilas, function (index, upazila) {
					editUpazilaSelect.append('<option value="' + upazila.id + '">' + upazila.name + '</option>');
				});
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error('Error fetching countries: ' + textStatus);
			}
		});
    });
</script>
<script>
    $(document).ready(function() {
		// Call schools
		$.ajax({
			url: '/admin/schools',
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				var select = $('#add-center-school');
				select.empty();
				select.append('<option value="">Select an option</option>');
				$.each(data.schools, function (index, school) {
					select.append('<option value="' + school.id + '">' + school.school_name + '</option>');
				});

				//
				var editSchoolSelect = $('#edit-center-school');
				editSchoolSelect.empty();
				editSchoolSelect.append('<option value="">Select an option</option>');
				$.each(data.schools, function (index, school) {
					editSchoolSelect.append('<option value="' + school.id + '">' + school.school_name + '</option>');
				});
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error('Error fetching countries: ' + textStatus);
			}
		});
    });
</script>
<script>
	let centers = {!! json_encode($centers) !!};

	function populateModalEditData(centerId){
		const center = centers.find(center => center.id == centerId);
		if(center){
			$('#edit-center-id').val(center.id);
			if(center.division){
				$('#edit-center-division').val(center.division.id).trigger('change');
			}
			if(center.district){
				$('#edit-center-district').val(center.district.id).trigger('change');
			}
			if(center.upazila){
				$('#edit-center-upazila').val(center.upazila.id).trigger('change');
			}
			if(center.school){
				$('#edit-center-school').val(center.school.id).trigger('change');
			}

			$('#kt_modal_edit_center_form').attr('action', 'centers/' + center.id);
			$('#kt_modal_edit_center').modal('show');
		}
	}
</script>

<script>
	function handleDelete(centerId) {
		$('#deletecenter').attr('action', 'centers/' + centerId);
		var deleteForm = $('#deletecenter');

		// Submit the form
		deleteForm.submit();
    }
</script>
		
@endsection