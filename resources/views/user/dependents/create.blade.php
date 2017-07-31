@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('dependent.add') !!}</div>
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('dependent.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>

                                <div class="col-md-3 col-xs-6">
                                    <input id="first_name" type="text" placeholder="First" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <input id="last_name" type="text" placeholder="Last" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-3 control-label">Email</label>
                                <div class="col-md-4">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="col-md-3 control-label">Phone Number</label>

                                <div class="col-md-4">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" placeholder="" value="{{old('phone_number')}}" required autofocus>
                                </div>
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="gender" class="col-md-3 col-xs-12 control-label">Gender</label>

                                <div class="col-md-3 col-xs-6">
                                    <div class="btn-group" role="group" aria-label="...">
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="Unspecified" <?php if(old('gender')=='Unspecified') echo 'selected' ?>></option>
                                            <option value="Female" <?php if(old('gender')=='Female') echo 'selected' ?>>Female</option>
                                            <option value="Male" <?php if(old('gender')=='Male') echo 'selected' ?>>Male</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="relation" class="col-md-1 col-xs-12 control-label">Relation</label>
                                <div class="col-md-3 col-xs-6">
                                    <select id="relation" class="form-control" name="relation">
                                        <option value="Unspecified" <?php if(old('relation')=='Unspecified') echo 'selected' ?>></option>
                                        <option value="Son" <?php if(old('relation')=='Son') echo 'selected' ?>>Son</option>
                                        <option value="Brother" <?php if(old('relation')=='Brother') echo 'selected' ?>>Brother</option>
                                        <option value="Other" <?php if(old('relation')=='Other') echo 'selected' ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
