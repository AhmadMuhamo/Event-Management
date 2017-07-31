@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
<style>
    i {
        padding-right: 5%;
        color: black;
    }
    .panel {
        text-align: center;
    }
    a:hover {
        text-decoration: none;
        font-weight: bold;
    }
    .panel-heading {
        font-weight: bold;
    }
    .panel-body {
        min-height: 40%;
        color: #493030;
    }
</style>
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('events') !!}</div>
    <div class="container">
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

            <form class="form-horizontal" role="form" id="sort_form" method="POST" action="{{route('events.sort')}}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                            <div class="col-md-3 col-xs-8 col-xs-offset-4 col-md-offset-9">
                                <select class="form-control" id="sortEvents" name="sortEvents" style="-webkit-appearance: none; -moz-appearance: none; text-indent: 1px; text-overflow: '';" onchange="$('#sort_form').submit();">
                                    <option value="old_to_new" @if($sortEvent=='old_to_new') echo selected @endif>Date (Oldest to Newest)</option>
                                    <option value="new_to_old" @if($sortEvent=='new_to_old') echo selected @endif>Date (Newest to Oldest)</option>
                                    <option value="alpha_a_z" @if($sortEvent=='alpha_a_z') echo selected @endif >Alphabetically (A-Z)</option>
                                    <option value="alpha_z_a" @if($sortEvent=='alpha_z_a') echo selected @endif>Alphabetically (Z-A)</option>
                                    <option value="free" @if($sortEvent=='free') echo selected @endif>Fees (Free First)</option>
                                    <option value="paid" @if($sortEvent=='paid') echo selected @endif>Fees (Paid First)</option>
                                    
                                </select>
                                <i class="glyphicon glyphicon-sort form-control-feedback" aria-hidden="true"></i>
                            </div>
                    </div>
            </form>

                @if($count!=0)
                    @for($i=0;$i<$count;$i++)
                        <div class="col-md-4 col-xs-12">
                        <a href="{{route('event.view',$events[$i]["id"])}}" style="text-decoration:none;">
                            <div @if($events[$i]["fees"]=='No') class="panel panel-success" @else class="panel panel-danger" @endif>
                                <div class="panel-heading" style="font-weight: bold;">{{$events[$i]["event_name"]}}</div>
                                <div class="panel-body">

                                              <p><i class="glyphicon glyphicon-pencil"></i>@if (strlen($events[$i]["description"]) > 75){{substr($events[$i]["description"],0,75)}}... @elseif($events[$i]["description"]) {{$events[$i]["description"]}} @else - @endif</p>

                                              <p><i class="glyphicon glyphicon-map-marker"></i>@if (strlen($events[$i]["location"]) > 65){{substr($events[$i]["location"],0,65)}}... @elseif($events[$i]["location"]) {{$events[$i]["location"]}} @endif</p> 
                                            @if ($events[$i]["fees"]=='Yes')
                                                <p><i class="glyphicon glyphicon-usd"></i>Paid</p>
                                            @else
                                                <p><i class="glyphicon glyphicon-usd"></i>Free</p>
                                            @endif

                                              <p><i class="glyphicon glyphicon-calendar"></i>{{date('M d, Y',strtotime($events[$i]["start_date"]))}} @if(
                                                $events[$i]["end_date"]) - {{date('M d, Y',strtotime($events[$i]["end_date"]))}} @endif </p>

                                                @if($events[$i]["start_time"])
                                                <p><i class="glyphicon glyphicon-time"></i>@if($events[$i]["start_time"]) {{date('g:i a',strtotime($events[$i]["start_time"]))}} @else  @endif - @if($events[$i]["end_time"]) {{date('g:i a',strtotime($events[$i]["end_time"]))}} @else  @endif</p>
                                                @endif
                                </div>
                            </div>
                            </a>
                        </div>
                    @endfor
                {{--@else--}}
                    {{--<div class="alert alert-warning" style="text-align: center; font-weight: bold;">--}}
                        {{--{{$warning}}--}}
                    {{--</div>--}}
                @endif
    </div>

@endsection