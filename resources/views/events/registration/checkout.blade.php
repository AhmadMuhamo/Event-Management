@extends('layouts.app')
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('checkout', $event) !!}</div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-success">
                    <div class="panel-heading" style="font-weight:bold; font-size: 150%; text-align: center;">Payment Summary</div>

                    <div class="panel-body" >
                        <div id="payment_summary">
                            <table class="table table-striped">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Fee</th>
                                    <th>discount</th>
                                </tr>
                                @for($i=0;$i<count($batch);$i++)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{$batch[$i]}}</td>
                                    <td>{{$fee[$i]}}.00 {{$currency}}</td>
                                    <td>{{$fee[$i]-$discount[$i]}}.00 {{$currency}}</td>
                                </tr>
                                @endfor
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <th>{{array_sum($fee)}}.00 {{$currency}}</th>
                                    <th>{{$total_discount}}.00 {{$currency}}</th>
                                </tr>
                            </table>
                        </div>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('registration.event.checkout',$event->id) }}">
                            {{ csrf_field() }}

                            <div class="form-group" style="font-size: 150%">
                                <div id="data">
                                    <input type="hidden" id="id" class="form-control" name="id" value="{{$event->id}}" readonly>
                                    <input type="hidden" id="amount" class="form-control" name="amount" value="{{$amount}}" readonly>
                                    <input type="hidden" id="currency" class="form-control" name="currency" value="{{$currency}}" readonly>
                                </div>
                                <label class="col-md-6 control-label" >Total Amount</label>
                                <div class="col-md-4">
                                    <p class="form-control-static" style="font-weight: bold; color: darkred;">{{$amount}}.00 {{$currency}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-lg">Checkout</button>
                                </div>
                            </div>
                            <div style="text-align: center;">
                                <p style="color: red;">You will be redirected to PayPal to complete your payment</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection