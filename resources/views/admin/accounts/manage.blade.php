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

    .panel-body {
        min-height: 40%;
        color: #493030;
    }
    tr {
    	cursor: pointer;
    }
    th {
    	cursor: default;
    }
</style>
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('manage_user',$user) !!}</div>
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
             <div class="col-md-8 col-md-offset-2">
            		<div class="panel panel-primary">
            			<div class="panel-body">
                       
            				<form class="form-horizontal" role="form" method="POST" action="#">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email" class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-5 col-xs-12">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" readonly>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="admin" class="col-md-3  control-label">Administrator?</label>
                                <div class="col-md-2">
                                <select id="admin" name="admin" class="form-control" disabled>
                                    <option value="0" @if($user->admin == 0) echo selected @endif >No</option>
                                    <option value="1" @if($user->admin == 1) echo selected @endif >Yes</option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>

                                <div class="col-md-3 col-xs-6">
                                    <input id="first_name" type="text" placeholder="First" class="form-control" name="first_name" value="{{ $user_det->first_name }}" readonly autofocus>
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <input id="last_name" type="text" placeholder="Last" class="form-control" name="last_name" value="{{ $user_det->last_name }}" readonly autofocus >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                <div class="col-md-2">
                                        <input type="text" class="form-control" name="gender" value="{{$user_det->gender}}" id="gender" readonly autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Birthday</label>

                                <div class="col-md-3 col-xs-12">
                                    <input id="birthday" type="text" class="form-control" name="birthday" placeholder="dd-mm-yyyy" @if($user_det->birth_date==NULL)value="" @else value="{{date('d-m-Y', strtotime($user_det->birth_date))}}" @endif readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="primary_phone" class="col-md-3 col-xs-12 control-label">Primary Phone</label>

                                <div class="col-md-3 col-xs-12">
                                    <input id="primary_phone" type="text" class="form-control" name="primary_phone" placeholder="" value="{{$user_det->primary_phone}}" readonly autofocus>
                                </div>
                            </div>
                            @if($user_det->other_phone)
                            <div class="form-group">
                                <label for="other_phone" class="col-md-3 col-xs-12 control-label">Other Phone</label>

                                <div class="col-md-4 col-xs-12">
                                    <input id="other_phone" type="text" class="form-control" name="other_phone" value="{{$user_det->other_phone}}" readonly>
                                </div>
                            </div>
                            @endif

                            <div class="form-group">
                                <label for="country" class="col-md-3 col-xs-12 control-label">Country</label>
                                <div class="col-md-2">
                                    <input id="country" type="text" class="form-control" name="country" value="{{$user_det->country}}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="city" class="col-md-3 col-xs-12 control-label">City</label>
                                <div class="col-md-2 col-xs-12">
                                    <input id="city" type="text" class="form-control" name="city" value="{{$user_det->city}}" readonly>
                                </div>

                                <label for="postal_code" class="col-md-2 control-label">Postal Code</label>

                                <div class="col-md-2 col-xs-12">
                                    <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{$user_det->postal_code}}" readonly>
                                </div>
                            </div>
                            @if($user_det->address)
                            <div class="form-group">
                                <label for="address" class="col-md-3 col-xs-12 control-label">Address</label>

                                <div class="col-md-6 col-xs-12">
                                    <input id="address" type="text" class="form-control" name="address" value="{{$user_det->address}}" placeholder=" Line 1" readonly>
                                </div>
                            </div>
                            @endif

                            @if($user_det->address_line2)
                            <div class="form-group">
                                <label for="address_line2" class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-6 col-xs-12">
                                    <input id="address_line2" type="text" class="form-control" name="address_line2" value="{{$user_det->address_line2}}" placeholder=" Line 2" readonly>
                                </div>
                            </div>
                            @endif
                            @if($user_det->billing_address)
                            <div class="form-group">
                                <label for="billing_address" class="col-md-3 col-xs-12 control-label">Billing Address</label>

                                <div class="col-md-6 col-xs-12">
                                    <input id="billing_address" type="text" class="form-control" name="billing_address" value="{{$user_det->billing_address}}" placeholder=" Line 1" readonly>
                                </div>
                            </div>
                            @endif

                            @if($user_det->billing_address_line2)
                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label for="billing_address_line2" class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-6 col-xs-12">
                                    <input id="billing_address_line2" type="text" class="form-control" name="billing_address_line2" value="{{$user_det->billing_address_line2}}" placeholder=" Line 2" readonly>
                                </div>
                            </div>
                            @endif

                            

                            @if($dependents)
                            <hr>
                            @for($i=0;$i<count($dependents);$i++)
                             <div style="text-align: center;">
                                 <p style="color: darkred; font-weight: bold;">Dependent id: {{$dependents[$i]->id}}</p>
                             </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>

                                <div class="col-md-3 col-xs-6">
                                    <input id="first_name" type="text" placeholder="First" class="form-control" name="first_name" value="{{ $dependents[$i]->first_name }}" readonly autofocus>
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <input id="last_name" type="text" placeholder="Last" class="form-control" name="last_name" value="{{ $dependents[$i]->last_name }}" readonly autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-4 col-xs-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $dependents[$i]->email }}" readonly autofocus>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="phone_number" class="col-md-3 control-label">Phone Number</label>

                                <div class="col-md-4 col-xs-12">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" placeholder="" value="{{$dependents[$i]->phone_number}}" readonly autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                <div class="col-md-3 col-xs-12">
                                    <input class="form-control" type="text" name="gender" value="{{$dependents[$i]->gender}}" id="gender" readonly autofocus>
                                </div>

                                <label for="relation" class="col-md-1 col-xs-12 control-label">Relation</label>
                                <div class="col-md-3 col-xs-12">
                                    <input class="form-control" type="text" name="relation" value="{{$dependents[$i]->relation}}" id="relation" readonly autofocus>
                                </div>
                            </div>
                            <hr align="center" width="50%">
                            @endfor
                            @endif

                            </form>
                            </div>
            			</div>
            		</div>

    </div>

@endsection