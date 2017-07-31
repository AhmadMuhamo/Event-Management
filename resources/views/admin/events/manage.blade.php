@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('edit_event', $event) !!}</div>
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">

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
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('event.save') }}">
                            {{ csrf_field() }}

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Event Name</label>
                                <div class="col-md-4">
                                    <input type="text" id="event_name" class="form-control" name="event_name" value="{{$event->event_name}}" required>
                                </div>
                                @if ($errors->has('event_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('event_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Description</label>
                                <div class="col-md-6">
                                    <textarea style="resize:none;" id="event_description" class="form-control" maxlength="191" name="event_description" required>{{$event->description}}</textarea>
                                </div>
                            </div>

                            <div style="display:none;">
                                <input  type="text" id="event_id" class="form-control" name="event_id" value="{{$id}}">
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Start Date</label>
                                <div class="col-md-4">
                                    <input  type="date" id="start_date" class="form-control" name="start_date" value="{{$event->start_date}}">
                                    @if ($errors->has('start_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label">End Date</label>
                                <div class="col-md-4">
                                    <input type="date" id="end_date" class="form-control" name="end_date" value="{{$event->end_date}}">
                                    @if ($errors->has('end_date'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Start Time</label>
                                <div class="col-md-4">
                                    <input type="time" id="start_time" class="form-control" name="start_time" value="{{$event->start_time}}">
                                    @if ($errors->has('start_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('start_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <label class="col-md-2 control-label">End Time</label>
                                <div class="col-md-4">
                                    <input type="time" id="end_time" class="form-control" name="end_time" value="{{$event->end_time}}">
                                    @if ($errors->has('end_time'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('end_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group" style="background-color: #F5F8FA;">
                                <label class="col-md-2 control-label">Location</label>
                                <div class="col-md-4">
                                    <input type="text" id="location" class="form-control" name="location" value="{{$event->location}}">
                                    @if ($errors->has('location'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('location') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if($event->fees =="Yes")
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Fees</label>
                                    <div class="col-md-2">
                                        <input type="text" id="amount" class="form-control" name="amount" value="{{$fee->fee}}">
                                    </div>
                                    <div class="col-md-4">
                                        <select  id="currency" class="form-control" name="currency" onchange="setCurrency()">
                                            <option value="AUD" <?php if ($fee->currency == 'AUD') echo 'selected'?>>Australian Dollar</option>
                                            <option value="BRL" <?php if ($fee->currency == 'BRL') echo 'selected'?>>Brazilian Real </option>
                                            <option value="CAD" <?php if ($fee->currency == 'CAD') echo 'selected'?>>Canadian Dollar</option>
                                            <option value="CZK" <?php if ($fee->currency == 'CZK') echo 'selected'?>>Czech Koruna</option>
                                            <option value="DKK" <?php if ($fee->currency == 'DKK') echo 'selected'?>>Danish Krone</option>
                                            <option value="EUR" <?php if ($fee->currency == 'EUR') echo 'selected'?>>Euro</option>
                                            <option value="HKD" <?php if ($fee->currency == 'HKD') echo 'selected'?>>Hong Kong Dollar</option>
                                            <option value="HUF" <?php if ($fee->currency == 'HUF') echo 'selected'?>>Hungarian Forint </option>
                                            <option value="ILS" <?php if ($fee->currency == 'ILS') echo 'selected'?>>Israeli New Sheqel</option>
                                            <option value="JPY" <?php if ($fee->currency == 'JPY') echo 'selected'?>>Japanese Yen</option>
                                            <option value="MYR" <?php if ($fee->currency == 'MYR') echo 'selected'?>>Malaysian Ringgit</option>
                                            <option value="MXN" <?php if ($fee->currency == 'MXN') echo 'selected'?>>Mexican Peso</option>
                                            <option value="NOK" <?php if ($fee->currency == 'NOK') echo 'selected'?>>Norwegian Krone</option>
                                            <option value="NZD" <?php if ($fee->currency == 'NZD') echo 'selected'?>>New Zealand Dollar</option>
                                            <option value="PHP" <?php if ($fee->currency == 'PHP') echo 'selected'?>>Philippine Peso</option>
                                            <option value="PLN" <?php if ($fee->currency == 'PLN') echo 'selected'?>>Polish Zloty</option>
                                            <option value="GBP" <?php if ($fee->currency == 'GBP') echo 'selected'?>>Pound Sterling</option>
                                            <option value="SGD" <?php if ($fee->currency == 'SGD') echo 'selected'?>>Singapore Dollar</option>
                                            <option value="SEK" <?php if ($fee->currency == 'SEK') echo 'selected'?>>Swedish Krona</option>
                                            <option value="CHF" <?php if ($fee->currency == 'CHF') echo 'selected'?>>Swiss Franc</option>
                                            <option value="TWD" <?php if ($fee->currency == 'TWD') echo 'selected'?>>Taiwan New Dollar</option>
                                            <option value="THB" <?php if ($fee->currency == 'THB') echo 'selected'?>>Thai Baht</option>
                                            <option value="TRY" <?php if ($fee->currency == 'TRY') echo 'selected'?>>Turkish Lira</option>
                                            <option value="USD" <?php if ($fee->currency == 'USD') echo 'selected'?>>U.S. Dollar</option>
                                        </select>
                                    </div>
                                </div>
                                @if($fee->discount)
                                    <div id="structured">
                                        <div class="form-group" style="background-color: #F5F8FA;">
                                            <label class="col-md-2 control-label">Discount</label>
                                            <div class="col-md-2">
                                                <input type="text" id="discount" class="form-control" name="discount" value="{{$fee->discount}}">
                                            </div>
                                            <p class="control-label col-md-1" id="curr">USD</p>
                                            @if($fee->applicants)
                                            <label class="col-md-3 control-label">Applicants</label>
                                            <div class="col-md-2">
                                                <input type="number" min="0" id="applicants" class="form-control" name="applicants" value="{{$fee->applicants}}">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="{{route('event.delete',$id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
<script type="application/javascript">
function setCurrency() {
document.getElementById('curr').innerHTML=document.getElementById('currency').value;
}
</script>