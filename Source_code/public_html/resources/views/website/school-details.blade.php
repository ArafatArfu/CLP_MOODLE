@extends('layouts.website')
@section('title', 'CLP | School Details')
@section('content')
    <div class="container" style="margin-top: 30px; margin-bottom: 150px;">
        <div style="margin: 10px;" class="panel panel-default">
            <div class="panel-body">
                <div class="card">
                    <div class="card-body">
                        <!--@isset($schoolInfo->school_youtube)-->
                        <!--        {!! $schoolInfo->school_youtube !!}-->
                        <!--@endisset-->
                        <h4 class="card-title"><strong>Name of Institution:</strong></h4>
                        <p class="card-text work_para2">{!! $schoolInfo->school->school_name!!}</p>
                        
                        <h4 class="card-title"><strong>Center Type:</strong></h4>
                        <p class="card-text work_para2">
                            @if(strtolower($schoolInfo->clc) == "clc")
                                Computer Literacy Center
                            @else(strtolower($schoolInfo->clc) == "scr")
                                Smart Classroom
                            @endif
                        </p>
                        <h4 class="card-title"><strong>Mailing Address:</strong></h4>
                        <p class="card-text work_para2">{!! $schoolInfo->mail !!}</p>
                        <h4 class="card-title"><strong>History of the Center:</strong></h4>
                        <p class="card-text work_para2">{!! nl2br($schoolInfo->history) !!}</p>
                        <h4 class="card-title"><strong>Description of the Center:</strong></h4>
                        <p class="card-text work_para2">
                            @isset($schoolInfo->school_des)
                                {{ $schoolInfo->school_des }}
                            @endisset
                        </p>
                        <h4 class="card-title"><strong>Contact Person with Phone & email:</strong></h4>
                        <p class="card-text work_para2">{!! nl2br($schoolInfo->contact_phone) !!}</p>
                        <h4 class="card-title"><strong>Sponsor name:</strong></h4>
                        <p class="card-text work_para2">{!! nl2br($schoolInfo->sponsor_name) !!}</p>
                        <h4 class="card-title"><strong>Accomplishment:</strong></h4>
                        <p class="card-text work_para2">{!! nl2br($schoolInfo->accomplish) !!}</p>
                        <h4 class="card-title"><strong>Number Of Visit:</strong></h4>
                        <p class="card-text work_para2">{!! $schoolInfo->scr !!}</p>
                        <h4 class="card-title"><strong>Flow Up Over Phone:</strong></h4>
                        <p class="card-text work_para2">{!! $schoolInfo->ds !!}</p>
                        <h4 class="card-title"><strong>Number Of CLC Graduate Students Or SCR Benefited
                                Students:</strong></h4>
                        <p class="card-text work_para2">{!! $schoolInfo->csaw !!}</p>
                        <h4 class="card-title"><strong>Hardware Status:</strong></h4>
                        <p class="card-text work_para2">{!! nl2br($schoolInfo->hardware) !!}</p>
                        @if(optional($school->schoolInfo)->plaquefile != null && $schoolInfo->plaquefile !="no image")
                            <h4 class="card-title"><strong>Plaque:</strong></h4>
                        @endif
                        <!-- Plaque Photo Section -->
                        <div class="row">
                            @if($schoolInfo->plaquefile != null && $schoolInfo->plaquefile !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img style=" width: 100%; height: 300px; object-fit: cover;"
                                             src="{{ asset($schoolInfo->plaquefile) }}"
                                             alt="Plaque 1">
                                    </div>
                                </div>
                            @endif
                            @if($schoolInfo->plaquefile1 != null && $schoolInfo->plaquefile1 !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ asset($schoolInfo->plaquefile1) }}"
                                             alt="Plaque 1"
                                             style=" width: 100%; height: 300px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            @if($schoolInfo->plaquefile2 != null && $schoolInfo->plaquefile2 !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ url($schoolInfo->plaquefile2) }}" alt="Plaque 1"
                                             style=" width: 100%; height: 300px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if($schoolInfo->photofile != null && $schoolInfo->photofile !="no image")
                            <h4 class="card-title"><strong>Photos:</strong></h4>
                        @endif
                        <!--  Photo File Section -->
                        <div class="row">
                            @if($schoolInfo->photofile != null && $schoolInfo->photofile !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ asset($schoolInfo->photofile) }}" alt="Photo 1"
                                             style=" width: 100%; height: 250px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            @if($schoolInfo->photofile1 != null && $schoolInfo->photofile1 !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ asset($schoolInfo->photofile1) }}" alt="Photo 2"
                                             style=" width: 100%; height: 250px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                            @if($schoolInfo->photofile2 != null && $schoolInfo->photofile2 !="no image")
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        <img src="{{ asset($schoolInfo->photofile2) }}" alt="Photo 3"
                                             style=" width: 100%; height: 250px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
