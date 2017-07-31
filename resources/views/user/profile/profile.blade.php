@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
<style type="text/css">
    .link {
        font-size:140%;
        font-weight: bold;
    }
    .link:hover {
        font-size:150%;
    }
</style>
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('profile') !!}</div>
<div class="container">
    {{--Dependents--}}
    @if(!Auth::user()->admin)
        @if($count!=0)
        <div class="col-md-offset-7 col-md-2 col-xs-4" style="position: absolute">
            <div class="panel panel-default" style="width: 125%;">
            <div class="panel-head" style="text-align: center;"><a href="{{route('dependents')}}" class="link" style="text-decoration: none; color: black;">My Dependents</a></div>
                <div class="panel-body" style="font-weight: bold; background-color: #F5F8FA; text-align:center;">
                    @if ($count<3)
                    @for($i=0;$i<$count;$i++)
                    
                    <div class="panel panel-success">
                        <div class="panel-body" style="font-weight: bold; text-align: center; ">
                            <a href="{{route('dependent.edit',$dependents[$i]->id)}}" class="link"style=" text-decoration: none;">{{$dependents[$i]->first_name}}&nbsp;{{$dependents[$i]->last_name}}
                            </a>
                            <a href="{{route('dependent.delete',$dependents[$i]->id)}}" class="link" style="padding-left: 5%" onclick="return confirm('Are you sure?')"><i style="color: red;" class="glyphicon glyphicon-remove"></i></a>
                            
                        </div>
                    </div>
                    
                    @endfor
                    @else
                        @for($i=0;$i<3;$i++)
                        <div class="panel panel-success">
                            <div class="panel-body" style="font-weight: bold; text-align: center; ">
                            <a href="{{route('dependent.edit',$dependents[$i]->id)}}" class="link" style=" text-decoration: none;">{{$dependents[$i]->first_name}}&nbsp;{{$dependents[$i]->last_name}}
                            </a>
                            <a href="{{route('dependent.delete',$dependents[$i]->id)}}" class="link" style="padding-left: 5%" onclick="return confirm('Are you sure?')"><i style="color: red;" class="glyphicon glyphicon-remove"></i></a>
                        </div>
                        </div>
                        @endfor
                    @endif
                    <div style="text-align: center">
                        @if($count>3)
                            <a href="{{route('dependents')}}" class="btn btn-primary">View More  <i class="glyphicon glyphicon-th"></i></a>
                        @else
                        <a href="{{route('dependent.add')}}" class="btn btn-success">Add <i class="glyphicon glyphicon-plus"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    @endif
    {{--End Dependents--}}

    <div class="row">
        <div class="col-md-8 col-xs-12 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
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
                    <form class="form-horizontal" role="form" method="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-3 col-xs-5 control-label">Name</label>
                            <div class="col-md-3 col-xs-8">
                                <p class="form-control-static"> {{ $user_det->first_name }} {{ $user_det->last_name }}</p>
                            </div>
                        </div>

                        <div class="form-group" style="background-color: #F5F8FA;">
                            <label for="email" class="col-md-3 col-xs-5 control-label">Email</label>
                            <div class="col-md-4 col-xs-8">
                                <p class="form-control-static"> {{ $user->email }}</p>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-3 col-xs-5 control-label">Gender</label>

                            <div class="col-md-6 col-xs-12">
                                <p class="form-control-static">{{$user_det->gender}}</p>
                            </div>
                        </div>

                        <div class="form-group" style="background-color: #F5F8FA;">
                            <label class="col-md-3 col-xs-5 control-label">Birthday</label>

                            <div class="col-md-4 col-xs-8">
                                <p class="form-control-static">{{date('d/m/Y',strtotime($user_det->birth_date))}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="primary_phone" class="col-md-3 col-xs-5 control-label">Primary Phone</label>

                            <div class="col-md-4 col-xs-8">
                                <p class="form-control-static">{{$user_det->primary_phone}}</p>
                            </div>
                        </div>
                        @if($user_det->other_phone)
                        <div class="form-group" style="background-color: #F5F8FA;">
                            <label for="other_phone" class="col-md-3 col-xs-5 control-label">Other Phone</label>

                            <div class="col-md-4 col-xs-8">
                                <p class="form-control-static">{{$user_det->other_phone}}</p>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="country" class="col-md-3 col-xs-5 control-label">Country</label>
                            <div class="col-md-4 col-xs-8">
                                <p class="form-control-static">{{$user_det->country}}</p>
                            </div>
                        </div>

                        <div class="form-group" style="background-color: #F5F8FA;">
                            <label for="city" class="col-md-3 col-xs-6 control-label">City</label>
                            <div class="col-md-2 col-xs-8">
                                <p class="form-control-static">{{$user_det->city}}</p>
                            </div>

                            <label for="postal_code" class="col-md-2 col-xs-6 control-label">Postal Code</label>

                            <div class="col-md-2 col-xs-8">
                                <p class="form-control-static">{{$user_det->postal_code}}</p>
                            </div>
                        </div>
                        @if($user_det->address)
                        <div class="form-group">
                            <label for="address" class="col-md-3 col-xs-5 control-label">Address Line 1</label>

                            <div class="col-md-6 col-xs-12">
                                <p class="form-control-static">{{$user_det->address}}</p>
                            </div>
                        </div>
                        @endif
                        @if($user_det->address_line2)
                        <div class="form-group">
                            <label for="address_line2" class="col-md-3 col-xs-5 control-label">Address Line 2</label>
                            <div class="col-md-6 col-xs-12">
                                <p class="form-control-static"> {{$user_det->address_line2}}</p>
                            </div>
                        </div>
                        @endif
                        @if($user_det->billing_address)
                        <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="billing_address" class="col-md-3 col-xs-12 control-label">Billing Address Line 1</label>

                                <div class="col-md-6 col-xs-12">
                                    <p class="form-control-static"> {{$user_det->billing_address}}</p>
                                </div>
                            @endif
                            @if($user_det->billing_address_line2)
                                <label for="billing_address_line2" class="col-md-3 col-xs-12 control-label">Billing Address Line 2</label>
                                <div class="col-md-6 col-xs-12">
                                    <p class="form-control-static"> {{$user_det->billing_address_line2}}</p>
                                </div>
                            @endif
                        <div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <a href="{{ route('profile.update') }}" class="btn btn-primary btn-lg">
                                    Edit <i class="glyphicon glyphicon-edit"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
