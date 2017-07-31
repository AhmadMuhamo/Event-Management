@extends('layouts.app')
<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('subscription', $event) !!}</div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="font-weight:bold; font-size: 150%; text-align: center;">{{$event->event_name}}</div>

                    <div class="panel-body">
                        <div class="row">
                            @if (session('status'))
                                <div class="alert alert-success" style="text-align: center; font-weight: bold;">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning" style="text-align: center; font-weight: bold;">
                                    {{ session('warning') }}
                                </div>
                            @endif
                        </div>
                    
                        <div id="form">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('registration.event.payment',$event->id) }}">
                            {{ csrf_field() }}
                            <fieldset id="payer_info">
                                <legend style="text-align: center; width: auto;">Your Information</legend>

                                <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                                <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event->id }}">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Name</label>

                                    <div class="col-md-3">
                                        <p class="form-control-static"> {{$user->first_name}} {{$user->last_name}}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="student" class="form-control-static">Register as a student</label>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-control-static switch">
                                            <input type="checkbox" id="payer_student" onchange="show_st_payer()">
                                            <div class="slider round"></div>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-3">
                                        <p class="form-control-static">{{Auth::user()->email}}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="col-md-3 control-label">Gender</label>

                                    <div class="col-md-3">
                                        <p class="form-control-static">{{$user->gender}}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Birthday</label>

                                    <div class="col-md-3">
                                        <p class="form-control-static">{{date('d/m/Y',strtotime($user->birth_date))}}</p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="primary_phone" class="col-md-3 control-label">Primary Phone</label>

                                    <div class="col-md-3">
                                        <p class="form-control-static">{{$user->primary_phone}}</p>
                                    </div>
                                </div>

                                <div id="payer_student_select" style="display: none">
                                    <div class="form-group">
                                        <label for="location" class="col-md-3 control-label">Study Location</label>
                                        <div class="col-md-7">
                                            <select name="location_user" id="location_user" class="form-control">
                                                <option value=""></option>
                                                @for($i=0;$i<count($data);$i++)
                                                    @if($data[$i]->location)
                                                <option value="{{$data[$i]->location}}">{{$data[$i]->location}}
                                                </option>
                                                    @endif
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="country" class="col-md-3 control-label">Batch</label>
                                        <div class="col-md-7">
                                            <select name="batch_user" id="batch_user" class="form-control">
                                                <option value=""></option>
                                                @for($i=0;$i<count($data);$i++)
                                                <option value="{{$data[$i]->course}}">{{$data[$i]->course}} | {{$data[$i]->fees}} {{$data[$i]->currency}}
                                                </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <hr>
                            @if(count($dependent)>0)
                            <fieldset>
                                <legend style="text-align: center; width: auto;">Students Information</legend>

                                    @for($i=0;$i<count($dependent);$i++)

                                        <input id="dependent_id_{{$i}}" type="hidden" class="form-control" name="dependent_id_{{$i}}" value="{{ $dependent[$i]->id }}">

                                        <div class="form-group">
                                            <label for="student_{{$i}}" class="col-md-3 control-label">{{$dependent[$i]->first_name }} {{ $dependent[$i]->last_name }}</label>
                                            <div class="col-md-3">
                                                <label class="form-control-static switch">
                                                    <input type="checkbox" id="student_{{$i}}" onchange="show_select({{$i}})">
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                        </div>
                                    <div id="students_info_{{$i}}" style="display: none;">
                                        <div class="form-group">
                                            <label for="email" class="col-md-3 control-label">Email</label>
                                            <div class="col-md-3">
                                                <p class="form-control-static">{{ $dependent[$i]->email }}</p>
                                            </div>
                                    </div>

                                        <div class="form-group">
                                            <label for="phone_number" class="col-md-3 control-label">Phone Number</label>
                                            <div class="col-md-3">
                                                <p class="form-control-static">{{$dependent[$i]->phone_number}}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender" class="col-md-3 control-label">Gender</label>

                                            <div class="col-md-3">
                                                <p class="form-control-static">{{$dependent[$i]->gender}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="relation" class="col-md-3 control-label">Relation</label>
                                            <div class="col-md-3">
                                                <p class="form-control-static">{{$dependent[$i]->relation}}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="location" class="col-md-3 control-label">Study Location</label>
                                            <div class="col-md-7">
                                                <select name="location_student{{$i}}" id="location_student{{$i}}" class="form-control">
                                                    <option value=""></option>
                                                    @for($j=0;$j<count($data);$j++)
                                                        @if($data[$j]->location)
                                                    <option value="{{$data[$j]->location}}">{{$data[$j]->location}}
                                                    </option>
                                                        @endif
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="country" class="col-md-3 control-label">Batch</label>
                                            <div class="col-md-7">
                                                <select name="batch_student{{$i}}" id="batch_student{{$i}}" class="form-control">
                                                    <option value=""></option>
                                                    @for($j=0;$j<count($data);$j++)
                                                    <option value="{{$data[$j]->course}}">{{$data[$j]->course}} | {{$data[$j]->fees}} {{$data[$j]->currency}}
                                                    </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        </div>
                                    @endfor
                            </fieldset>
                                @endif
                            <br>
                            <div style="text-align: center">
                                <button type="submit" id="continue" class="btn btn-primary">Continue</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="application/javascript">

    function fadeOut() {
        var notes = document.getElementById('notes');
        var op = 1;  // initial opacity
        var timer = setInterval(function () {
            if (op <= 0.1){
                clearInterval(timer);
                notes.style.display = 'none';
            }
            notes.style.opacity = op;
            notes.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op -= op * 0.4;
        }, 50);
    }

    function fadeIn() {
        var form = document.getElementById('form');
        var op = 0.1;  // initial opacity
        form.style.display = 'block';
        var timer = setInterval(function () {
            if (op >= 1){
                clearInterval(timer);
            }
            form.style.opacity = op;
            form.style.filter = 'alpha(opacity=' + op * 100 + ")";
            op += op * 0.4;
        }, 10);
    }
    function show_select(i) {
        if(document.getElementById('student_'+i).checked)
            {
                document.getElementById('students_info_'+i).style.display='block';
                document.getElementById('location_student'+i).required = true;
                document.getElementById('batch_student'+i).required = true;
            }

        else
            {
                document.getElementById('students_info_' + i).style.display = 'none';
                document.getElementById('location_student' + i).required = false;
                document.getElementById('batch_student' + i).required = false;
                document.getElementById('location_student' + i).value = "";
                document.getElementById('batch_student' + i).value = "";
            }
    }

    function show_st_payer() {
        if(document.getElementById('payer_student').checked)
            {
                document.getElementById('payer_student_select').style.display='block';
                document.getElementById('location_user').required = true;
                document.getElementById('batch_user').required = true;
            }
        else
            {
                document.getElementById('payer_student_select').style.display='none';
                document.getElementById('location_user').required = false;
                document.getElementById('batch_user').required = false;
                document.getElementById('location_user').value = "";
                document.getElementById('batch_user').value = "";
            }

    }


</script>