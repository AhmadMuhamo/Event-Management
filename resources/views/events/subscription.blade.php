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
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('subscription', $event) !!}</div>
    <div class="container">
            <div class="col-md-8 col-xs-12 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="font-weight:bold; font-size: 150%; text-align: center;">{{$event_name}}</div>

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
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('event.subscription',$event_id) }}">
                                {{ csrf_field() }}
                                <fieldset id="payer_info" style="text-align: center;">
                                    <legend style="text-align: center; width: auto;">Your Information</legend>

                                    <input id="user_id" type="hidden" class="form-control" name="user_id" value="{{ $user->id }}">
                                    <input id="event_id" type="hidden" class="form-control" name="event_id" value="{{ $event_id }}">

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Name</label>

                                        <div class="col-md-3 col-xs-12">
                                            <p class="form-control-static"> {{$user->first_name}} {{$user->last_name}}</p>
                                        </div>

                                        <div class="col-md-2 col-xs-12">
                                            <label class="form-control-static switch">
                                                <input type="checkbox" id="payer_dependent" onchange="show_st_payer()" checked>
                                                <div class="slider round"></div>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                                        <div class="col-md-3 col-xs-12">
                                            <p class="form-control-static">{{Auth::user()->email}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                        <div class="col-md-3 col-xs-12">
                                            <p class="form-control-static">{{$user->gender}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Birthday</label>

                                        <div class="col-md-3 col-xs-12">
                                            <p class="form-control-static">{{date('d/m/Y',strtotime($user->birth_date))}}</p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="primary_phone" class="col-md-3 col-xs-12 control-label">Primary Phone</label>

                                        <div class="col-md-3 col-xs-12">
                                            <p class="form-control-static">{{$user->primary_phone}}</p>
                                        </div>
                                    </div>

                                </fieldset>
                                <hr>
                                @if(count($dependent)>0)
                                    <fieldset style="text-align: center;">
                                        <legend style="text-align: center; width: auto;">dependents Information</legend>

                                        @for($i=0;$i<count($dependent);$i++)

                                            <input id="dependent_id_{{$i}}" type="hidden" class="form-control" name="dependent_id_{{$i}}" value="{{ $dependent[$i]->id }}">

                                            <div class="form-group">
                                                <label for="dependent_{{$i}}" class="col-md-3 col-xs-12 control-label">{{$dependent[$i]->first_name }} {{ $dependent[$i]->last_name }}</label>
                                                <div class="col-md-3 col-xs-12">
                                                    <label class="form-control-static switch">
                                                        <input type="checkbox" id="dependent_{{$i}}" onchange="show_select({{$i}})" checked>
                                                        <div class="slider round"></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="dependents_info_{{$i}}" style="display: block;">
                                                <div class="form-group">
                                                    <label for="email" class="col-md-3 col-xs-12 control-label">Email</label>
                                                    <div class="col-md-3 col-xs-12">
                                                        <p class="form-control-static">{{ $dependent[$i]->email }}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone_number" class="col-md-3 col-xs-12 control-label">Phone Number</label>
                                                    <div class="col-md-3 col-xs-12">
                                                        <p class="form-control-static">{{$dependent[$i]->phone_number}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                                    <div class="col-md-3 col-xs-12">
                                                        <p class="form-control-static">{{$dependent[$i]->gender}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="relation" class="col-md-3 col-xs-12 control-label">Relation</label>
                                                    <div class="col-md-3 col-xs-12">
                                                        <p class="form-control-static">{{$dependent[$i]->relation}}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        @endfor
                                    </fieldset>
                                @endif
                                <br>
                                <div style="text-align: center">
                                    @if($fees =='Yes')
                                        <button type="submit" id="continue" class="btn btn-primary">Continue</button>
                                    @else
                                        <button type="submit" id="continue" class="btn btn-primary">Confirm</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script type="application/javascript">
    
    function show_select(i) {
        if(document.getElementById('dependent_'+i).checked)
        {
            document.getElementById('dependents_info_'+i).style.display='block';
            document.getElementById('dependent_id_' + i).name = 'dependent_id_'+ i;
        }

        else
        {
            document.getElementById('dependents_info_' + i).style.display = 'none';
            document.getElementById('dependent_id_' + i).name = 'empty';
        }
    }

    function show_st_payer() {
        if(document.getElementById('payer_dependent').checked)
        {
            document.getElementById('payer_dependent_select').style.display='block';
            document.getElementById('user_id').name = 'user_id';
        }
        else
        {
            document.getElementById('user_id').name = 'empty';
            document.getElementById('payer_dependent_select').style.display='none';
        }
    }

</script>