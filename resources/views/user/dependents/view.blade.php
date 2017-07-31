@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center; padding-top: 50px;">{!! Breadcrumbs::render('dependents') !!}</div>
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
        <div style="font-weight: bold; background-color: #F5F8FA;">
                @if ($count>0)
                @for($i=0;$i<$count;$i++)
                <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading" style="text-align: center">{{$dependents[$i]->first_name}}&nbsp;{{$dependents[$i]->last_name}}</div>
                        <div class="panel-body" style="font-weight: bold; text-align: center;">
                            <p>{{$dependents[$i]->email}}</p>
                            <p>{{$dependents[$i]->phone_number}}</p>
                            <p>{{$dependents[$i]->gender}}<span>&nbsp;|&nbsp;</span>{{$dependents[$i]->relation}}</p>
                            <a href="{{route('dependent.edit',$dependents[$i]->id)}}" class="btn btn-primary ">Edit</a>
                            <a href="{{route('dependent.delete',$dependents[$i]->id)}}" class="btn btn-danger" onclick="return confirm('{{ $dependents[$i]->first_name . " " . $dependents[$i]->last_name}} will be deleted, Are you sure?')">Delete</a>
                        </div>
                    </div>
                </div>
                @endfor
                @endif
                <div class="col-md-4" style="padding: 80px 80px 80px 80px; text-align: center;">
                    <a href="{{route('dependent.add')}}" class="btn btn-success btn-lg">Add</a>
                </div>
        </div>

</div>