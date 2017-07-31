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
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('manage_event',$event) !!}</div>
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

            <div class="panel panel-info">
            <div class="pandel-body">
            <p style="text-align: center; font-weight: bold; font-size: 150%;">Total Number of Subscribers: <span style="color: darkred; font-size: 150%;">{{count($subscribers)}}</span></p>
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Subscriber ID</th>
                            <th>User?</th>
                        </tr>
                        
                        @for($i=0;$i<count($subscribers);$i++)
                        <tr>
                            <td>{{$i+1}}</td>
                            {{-- <td onclick="window.location='/admin/users/manage/userid={{$subscribers[$i]->user_id}}';" style="cursor: pointer;">@if($subscribers[$i]->dependent_id == NULL){{$subscribers[$i]->user_id}} @else {{$subscribers[$i]->dependent_id}} @endif</td> --}}
                            <td> <a href="/admin/users/manage/userid={{$subscribers[$i]->user_id}}" style="text-decoration: none;">@if($subscribers[$i]->dependent_id == NULL){{$subscribers[$i]->user_id}} @else {{$subscribers[$i]->dependent_id}} @endif </a> </td>
                            <td>@if($subscribers[$i]->dependent_id == NULL) Yes @else Dependent / user id = {{$subscribers[$i]->user_id}} @endif</td>
                        </tr>
                        @endfor
                    </table>
                </div>
            </div>
    </div>
@endsection