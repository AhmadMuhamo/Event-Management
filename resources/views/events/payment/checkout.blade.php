@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('checkout', $event) !!}</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12 col-md-offset-2">
            <div class="panel panel-primary">

                <div class="panel-body">
                    <div id="payment_summary">
                        <table class="table table-striped">
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Fee</th>
                                <th>discount</th>
                            </tr>
                            @for($i=0;$i<$count;$i++)
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$event_name}}</td>
                                <td>{{$fee}}.00 {{$currency}}</td>
                                <td>{{$fee-$final_fee[$i]}}.00 {{$currency}}</td>
                            </tr>
                            @endfor
                            <tr>
                                <td></td>
                                <td></td>
                                <th>{{count($final_fee)*$fee}}.00 {{$currency}}</th>
                                <th>{{count($final_fee)*$fee-array_sum($final_fee)}}.00 {{$currency}}</th>
                            </tr>
                        </table>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('event.checkout',$event_id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div id="data">
                                <input type="hidden" id="id" class="form-control" name="id" value="{{$event_id}}" readonly>
                                <input type="hidden" id="amount" class="form-control" name="amount" value="{{$amount}}" readonly>
                                <input type="hidden" id="currency" class="form-control" name="currency" value="{{$currency}}" readonly>
                            </div>
                            <div style="text-align: center;">
                                <p style="font-weight: bold;">Total Amount <span style=" color: darkred;">{{$amount}}.00 {{$currency}}</span></p>
                        </div>
                        <div class="form-group">
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Checkout</button>
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