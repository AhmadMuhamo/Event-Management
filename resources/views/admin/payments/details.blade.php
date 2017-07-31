@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('payment_details',$payment_id) !!}</div>
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">
                    <div class="panel-heading" style="font-weight:bold; font-size: 150%; text-align: center;">Payment details - "{{$event_name}}"</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="">
                            {{ csrf_field() }}
                            <div style="background-color: #F5F8FA;">
                                <p style="text-align: center; font-weight: bold;">Payment Details</p>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Payment ID</label>
                                    <div class="col-md-5">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payment_id}}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Method</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$method}}" readonly autofocus>
                                    </div>
                                    <label class="col-md-1 control-label">Status</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$status}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Creation Time</label>
                                    <div class="col-md-4">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$creation_time}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Amount</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$amount}}" readonly autofocus>
                                    </div>
                                    <label class="col-md-2 control-label">Trans. Fee</label>
                                    <div class="col-md-2">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$fee}}" readonly autofocus>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div >
                                <p style="text-align: center; font-weight: bold;">Payer Details</p>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ID</label>
                                    <div class="col-md-4">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_id}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Name</label>
                                    <div class="col-md-3 col-xs-6">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_first_name}}" readonly autofocus>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_last_name}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-5">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_email}}" readonly autofocus>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">Phone</label>
                                    <div class="col-md-4">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_phone}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$payer_country}}" readonly autofocus>
                                    </div>
                                </div>
                            </div>
                            <div style="background-color: #F5F8FA;">
                                <p style="text-align: center; font-weight: bold;">Shipping Details</p>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Recipient Name</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_name}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Shipping Address</label>
                                    <div class="col-md-7">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_address_line1}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">City</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_city}}" readonly autofocus>
                                    </div>
                                    <label class="col-md-2 control-label">State</label>
                                    <div class="col-md-2">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_state}}" readonly autofocus>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Country</label>
                                    <div class="col-md-3">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_country}}" readonly autofocus>
                                    </div>
                                    <label class="col-md-2 control-label">Postal Code</label>
                                    <div class="col-md-2">
                                        <input type="text" id="payment_id" class="form-control" name="payment_id" value="{{$shipping_postal_code}}" readonly autofocus>
                                    </div>
                                </div>
                                <hr>
                            </div>


                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-danger" disabled>Refund</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection