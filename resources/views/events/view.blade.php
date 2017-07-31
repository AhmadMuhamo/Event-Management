@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('event', $event) !!}</div>
    <div class="container">
            <div class="col-md-8 col-xs-12 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading"
                         style="font-weight:bold; font-size: 150%; text-align: center;">{{$event->event_name}}</div>
                    <div class="panel-body" style="text-align: center;">
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
                        <form class="form-horizontal" role="form" method="POST"
                              action="{{ route('event.subscribe',$id) }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-4 col-xs-12 control-label">Description <i class="glyphicon glyphicon-pencil"></i></label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{$event->description}}</p>
                                </div>
                            </div>

                            <div style="display:none;">
                                <input type="hidden" id="event_id" class="form-control" name="event_id" value="{{$id}}"
                                       readonly>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-4 col-xs-12 control-label">Date <i class="glyphicon glyphicon-calendar"></i></label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{date('M d, Y',strtotime($event->start_date))}}
                                        <span> | </span>@if($event->end_date) {{date('M d, Y',strtotime($event->end_date))}} @else Not
                                        specified @endif </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 col-xs-12 control-label">Time <i class="glyphicon glyphicon-time"></i></label>
                                <div class="col-md-6">
                                    <p class="form-control-static">@if($event->start_time) {{date('g:i a',strtotime($event->start_time))}} @else
                                            Not specified @endif
                                        <span> | </span> @if($event->end_time) {{date('g:i a',strtotime($event->end_time))}} @else Not
                                        specified @endif</p>
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-4 col-xs-12 control-label">Location <i class="glyphicon glyphicon-map-marker"></i></label>
                                <div class="col-md-6">
                                    <p class="form-control-static">{{$event->location}}</p>
                                </div>
                            </div>


                            @if($event->fees =="Yes")
                                <div class="form-group">
                                    <label class="col-md-4 col-xs-12 control-label">Fees <i class="glyphicon glyphicon-usd"></i></label>
                                    <div class="col-md-6 col-xs-12">
                                        <p class="form-control-static">{{$fee->fee." ".$fee->currency}}</p>
                                    </div>
                                </div>
                                @if($fee->discount)
                                    <div class="form-group" style="background-color: #F5F8FA;">
                                        <label class="col-md-4 col-xs-12 control-label">Discount <i class="glyphicon glyphicon-minus"></i></label>
                                        <div class="col-md-6">
                                            <p class="form-control-static">{{$fee->discount." ".$fee->currency}}</p>
                                        </div>

                                        {{--<label class="col-md-2 control-label">Applicants</label>--}}
                                        {{--<div class="col-md-2">--}}
                                        {{--<p class="form-control-static">{{$applicants}}</p>--}}
                                        {{--</div>--}}
                                    </div>
                                @endif
                            @endif


                            <div class="form-group">
                                <div style="text-align: center;">
                                    @if(Auth::user()->admin)
                                        <a href="{{route('event.edit',$id)}}" class="btn btn-primary">Edit Event</a>
                                    @else
                                        @if($event->event_type =="Registration")
                                            <a href="{{route('registation.event.register',$id)}}"
                                               class="btn btn-primary" @if($registered) onclick="return confirm('You have registerd to this event before, do you want to contine?')" @endif>Register</a>
                                        @else
                                            @if($event->fees =="No")
                                                @if(!$subscribed)
                                                    <input type="submit" value="Subscribe" name="free"
                                                           class="btn btn-primary">
                                                @else
                                                    <a href="{{route('event.unsubscribe',$id)}}" class="btn btn-danger" >Unsubscribe</a>
                                                @endif
                                            @else
                                                @if(!$subscribed)
                                                    <input type="submit" value="Subscribe" name="paid"
                                                           class="btn btn-primary">
                                                @else
                                                    <a href="{{route('event.unsubscribe',$id)}}" class="btn btn-danger" >Unsubscribe</a>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection