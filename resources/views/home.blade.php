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
        min-height: 32%;
        color: #493030;
    }
</style>
@section('content')
<div style="width:100%; text-align: center; ">{!! Breadcrumbs::render('home') !!}</div>
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
        @if(!Auth::user()->admin)
        @if($count > 0)
                @if($events)
        <fieldset>
            <legend style="text-align: center; border-bottom: outset; width: auto; color: #F5F5F5;">My Events</legend>
                    @for($i=0;$i<$count;$i++)
                    <div class="col-md-4 col-xs-12">
                    <a href="{{route('event.view',$events[$i]->id)}}" style="text-decoration: none;">
                        <div @if($events[$i]->fees=='No') class="panel panel-success" @else class="panel panel-danger" @endif>
                              <div class="panel-heading">{{$events[$i]->event_name}}</div>
                            <div class="panel-body">
                                <p><i class="glyphicon glyphicon-pencil"></i>@if (strlen($events[$i]->description) > 75){{substr($events[$i]->description,0,75)}}... @elseif($events[$i]->description) {{$events[$i]->description}} @endif</p>

                                <p><i class="glyphicon glyphicon-map-marker"></i>@if (strlen($events[$i]->location) > 65){{substr($events[$i]->location,0,65)}}... @elseif($events[$i]->location) {{$events[$i]->location}} @endif</p> 

                                <p><i class="glyphicon glyphicon-calendar"></i>{{date('M d, Y',strtotime($events[$i]->start_date))}} @if($events[$i]->end_date) - {{date('M d, Y',strtotime($events[$i]->end_date))}} @else  @endif</p>

                                
                                @if($events[$i]->start_time)
                                <p><i class="glyphicon glyphicon-time"></i>@if($events[$i]->start_time) {{date('g:i a',strtotime($events[$i]->start_time))}} @else  @endif - @if($events[$i]->end_time) {{date('g:i a',strtotime($events[$i]->end_time))}} @else  @endif</p>
                                @endif
                            </div>
                        </div>
                         </a>
                    </div>
                    
                    @endfor
                    </fieldset>
                        <hr>
                @endif
            @endif
        @endif
       @if($recent)
        <fieldset>
                    <legend style="text-align: center; border-bottom: outset; width: auto; color: #F5F5F5;">Recent Events</legend>

                    @for($i=0;$i<count($recent);$i++)
                        <div class="col-md-4 col-xs-12">
                        <a href="{{route('event.view',$recent[$i]->id)}}" style="text-decoration: none;">
                        <div @if($recent[$i]->fees=='No') class="panel panel-success" @else class="panel panel-danger" @endif>
                              <div class="panel-heading"> {{$recent[$i]->event_name}}</div>

                            <div class="panel-body">
                                <p><i class="glyphicon glyphicon-pencil"></i>@if (strlen($recent[$i]->description) > 75){{substr($recent[$i]->description,0,75)}}... @elseif($recent[$i]->description) {{$recent[$i]->description}} @endif</p>

                                <p><i class="glyphicon glyphicon-map-marker"></i>@if (strlen($recent[$i]->location) > 75){{substr($recent[$i]->location,0,75)}}... @elseif($recent[$i]->location) {{$recent[$i]->location}} @endif</p> 

                                <p><i class="glyphicon glyphicon-calendar"></i>{{date('M d, Y',strtotime($recent[$i]->start_date))}} @if($recent[$i]->end_date) - {{date('M d, Y',strtotime($recent[$i]->end_date))}} @else  @endif</p>

                                
                                @if($recent[$i]->start_time)
                                <p><i class="glyphicon glyphicon-time"></i>@if($recent[$i]->start_time) {{date('g:i a',strtotime($recent[$i]->start_time))}} @else  @endif - @if($recent[$i]->end_time) {{date('g:i a',strtotime($recent[$i]->end_time))}} @else  @endif</p>
                                @endif
                            </div>
                        </div>
                        </a>
                    </div>
                    @if($i>4)
                    <div style="text-align:center">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('events.sort')}}">
                        {{ csrf_field() }}
                            <input type="hidden" name="sortEvents" value="new_to_old">
                            <button type="submit" class="btn btn-default btn-lg">View More</button>
                        </form>
                    </div>
                    @endif
                    @endfor
        </fieldset>
        @endif
</div>
@endsection