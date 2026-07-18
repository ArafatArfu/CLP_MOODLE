@extends('layouts.admin.layouts.main')
@section('title')
    CLP | General Updates
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item text-muted">General Updates</li>
@endsection
@section('content')
<!--begin::Card-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<h1>General Updates</h1>
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body py-4 m-4">
		<form method="POST" action={{ route('general-updates.update') }}>
			@csrf
			@method('put')
			<div class="row mb-8">
				<label for="gu_total_clc" class="col-sm-2 col-form-label">Total CLC</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_total_clc" value={{ $gUpdates->total_clc_count }} required name="total_clc_count" placeholder="Total CLC">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_total_scr" class="col-sm-2 col-form-label">Total SCR</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_total_scr" value={{ $gUpdates->total_scr_count }} required name="total_scr_count" placeholder="Total SCR">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_total_supported_center_count" class="col-sm-2 col-form-label">Total Supported Center</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_total_supported_center_count" value={{ $gUpdates->total_supportedcenter_count }} required name="total_supportedcenter_count" placeholder="Total Supported Center">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_clc_sponsorship_price" class="col-sm-2 col-form-label">Total CLC Sponsorship</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_clc_sponsorship_price" value={{ $gUpdates->clc_sponsorship_price }} required name="clc_sponsorship_price" placeholder="Total CLC Sponsorship Price">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_scr_sponsorship_price" class="col-sm-2 col-form-label">Total SCR Sponsorship Price</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_scr_sponsorship_price" value={{ $gUpdates->scr_sponsorship_price }} required name="scr_sponsorship_price" placeholder="Total SCR Sponsorship Price">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_tokai_sponsorship_price" class="col-sm-2 col-form-label">Total SCR Sponsorship Price</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_tokai_sponsorship_price" value={{ $gUpdates->tokai_sponsorship_price }} required name="tokai_sponsorship_price" placeholder="Total Tokai Sponsorship Price">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_num_of_trained_teachers" class="col-sm-2 col-form-label">Total GU Num of Trained Teacher</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_num_of_trained_teachers" value={{ $gUpdates->num_of_trained_teachers }} required name="num_of_trained_teachers" placeholder="Total GU Num of Trained Teachers">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_last_updated_time" class="col-sm-2 col-form-label">Last Updated Time</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_last_updated_time" value={{ $gUpdates->last_updated_time }} required name="last_updated_time" placeholder="Last Updated TIme">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_number_of_graduates" class="col-sm-2 col-form-label">Number of Graduates</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_number_of_graduates" value={{ $gUpdates->number_of_graduates }} required name="number_of_graduates" placeholder="Number of Graduates">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_female_percentage" class="col-sm-2 col-form-label">Female Percentage</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_female_percentage" value={{ $gUpdates->female_percentage }} required name="female_percentage" placeholder="Female Percentage">
				</div>
			</div>
			<div class="row mb-8">
				<label for="gu_map" class="col-sm-2 col-form-label">Map</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="gu_map" value={{ $gUpdates->map }} required name="map" placeholder="Map">
				</div>
			</div>
			<div class="row mb-8">
				<label for="districts" class="col-sm-2 col-form-label">Total Districts</label>
				<div class="col-sm-8">
					<input type="number" class="form-control" id="districts" value="{{ $gUpdates->districts }}" required name="districts" placeholder="Total districts">
				</div>
			</div>
			<div class="row text-center">
				<button type="submit" class="btn btn-primary" data-kt-division-modal-action="submit">
					<span class="indicator-label">Update</span>
				</button>
			</div>
		</form>
	</div>
	<!--end::Card body-->
</div>
<!--end::Card-->
@endsection