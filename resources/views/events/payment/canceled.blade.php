@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center; ">{!! Breadcrumbs::render('payment_status',$event) !!}</div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">

                    <div class="panel-body">
                        <div class="alert alert-danger" style="text-align: center; font-weight: bold;">
                            {{ $status }}
                        </div>
                        <div style="text-align: center;">
                            <a href="{{route('event.view',$event->id)}}" class="btn btn-primary">
                                Back to Event
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection