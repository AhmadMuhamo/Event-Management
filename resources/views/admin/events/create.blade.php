@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('create_event') !!}</div>
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('event.store') }}">
                            {{ csrf_field() }}
                            <div id="notes" style="color: darkred; border: inset; font-weight: bold;">
                                <u style="text-align: center;"><p>Notes</p></u>
                                <ul>
                                    <li>
                                    Flat Discount Type is Applied on All Subscribers.
                                    </li>
                                    <li>
                                    Structured Discount Type is Applied on Subscribers Starting from The Second One And Multiplies Depending on Applicants Number
                                    </li>
                                </ul>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Event Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="event_name" class="form-control" name="event_name" value="{{old('event_name')}}" required>
                                </div>
                                @if ($errors->has('event_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-10">
                                    <textarea style="resize: none;" maxlength="191" rows="3" id="event_description" class="form-control" name="event_description" required>{{old('event_description')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Start Date</label>
                                <div class="col-md-4">
                                    <input type="date" id="start_date" class="form-control" name="start_date" value="{{old('start_date')}}" required>
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label">End Date</label>
                                <div class="col-md-4">
                                    <input type="date" id="end_date" class="form-control" name="end_date" value="{{old('end_date')}}">
                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Start Time</label>
                                <div class="col-md-4">
                                    <input type="time" id="start_time" class="form-control" name="start_time" value="{{old('start_time')}}">
                                    @if ($errors->has('start_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label">End Time</label>
                                <div class="col-md-4">
                                    <input type="time" id="end_time" class="form-control" name="end_time" value="{{old('end_time')}}">
                                    @if ($errors->has('end_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Location</label>
                                <div class="col-md-4">
                                    <input type="text" id="location" class="form-control" name="location" value="{{old('location')}}" required>
                                </div>
                                @if ($errors->has('location'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                @endif

                                <label class="col-md-2 control-label">Fees?</label>
                                <div class="col-md-2">
                                    <select onchange="showFees()" id="fees" class="form-control" name="fees">
                                        <option value="No">No</option>
                                        <option value="Yes">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="event_fees" style="display: none; background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Type</label>
                                <div class="col-md-3">
                                    <select onchange="feesType()"  id="type" class="form-control" name="type">
                                        <option value="Flat" selected>Flat</option>
                                        <option value="Structured">Structured</option>
                                    </select>
                                </div>
                            </div>
                            <div id="flat" style="display: none;">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fee</label>
                                    <div class="col-md-2">
                                        <input type="number" min="0" id="fee" class="form-control" name="fee">
                                    </div>
                                    <label class="col-md-2 control-label">Currency</label>
                                    <div class="col-md-4">
                                        <select  id="currency" class="form-control" name="currency" onchange="setCurrency()">
                                            <option value="AUD">Australian Dollar</option>
                                            <option value="BRL">Brazilian Real </option>
                                            <option value="CAD" selected>Canadian Dollar</option>
                                            <option value="CZK">Czech Koruna</option>
                                            <option value="DKK">Danish Krone</option>
                                            <option value="EUR">Euro</option>
                                            <option value="HKD">Hong Kong Dollar</option>
                                            <option value="HUF">Hungarian Forint </option>
                                            <option value="ILS">Israeli New Sheqel</option>
                                            <option value="JPY">Japanese Yen</option>
                                            <option value="MYR">Malaysian Ringgit</option>
                                            <option value="MXN">Mexican Peso</option>
                                            <option value="NOK">Norwegian Krone</option>
                                            <option value="NZD">New Zealand Dollar</option>
                                            <option value="PHP">Philippine Peso</option>
                                            <option value="PLN">Polish Zloty</option>
                                            <option value="GBP">Pound Sterling</option>
                                            <option value="SGD">Singapore Dollar</option>
                                            <option value="SEK">Swedish Krona</option>
                                            <option value="CHF">Swiss Franc</option>
                                            <option value="TWD">Taiwan New Dollar</option>
                                            <option value="THB">Thai Baht</option>
                                            <option value="TRY">Turkish Lira</option>
                                            <option value="USD">U.S. Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                    <div class="form-group" style="background-color: #F5F8FA;">
                                        <label class="col-md-2 control-label">Discount</label>
                                        <div class="col-md-2">
                                            <input type="number" min="0" id="discount" class="form-control" name="discount">
                                        </div>
                                        <p class="control-label col-md-1" id="curr">USD</p>
                                        <div  id="structured" style="display: none;">
                                        <label class="col-md-3 control-label">Applicants</label>
                                        <div class="col-md-2">
                                            <input type="number" min="0" id="applicants" class="form-control" name="applicants">
                                        </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" id="event_button" class="btn btn-primary">
                                        Create
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
<script type="application/javascript">
    function showFees() {
        if(document.getElementById('fees').value == 'Yes')
        {
            document.getElementById('flat').style.display='block';
            document.getElementById('event_fees').style.display='block';
            document.getElementById('fee').required = true;
        }
        else
        {
            document.getElementById('type').removeAttribute('required');
            document.getElementById('fee').removeAttribute('required');
            document.getElementById('discount').removeAttribute('required');
            document.getElementById('applicants').removeAttribute('required');
            document.getElementById('event_fees').style.display='none';
            document.getElementById('flat').style.display='none';
            document.getElementById('structured').style.display='none';
        }
    }

    function feesType() {
        if(document.getElementById('type').value == 'Flat')
        {
            document.getElementById('flat').style.display='block';
            document.getElementById('structured').style.display='none';
            document.getElementById('discount').removeAttribute('required');
            document.getElementById('applicants').removeAttribute('required');
        }
        else
        {
            document.getElementById('flat').style.display='block';
            document.getElementById('structured').style.display='block';
            document.getElementById('discount').required = true;
            document.getElementById('applicants').required = true;
        }
    }
    function setCurrency() {
        document.getElementById('curr').innerHTML=document.getElementById('currency').value;
    }
</script>

