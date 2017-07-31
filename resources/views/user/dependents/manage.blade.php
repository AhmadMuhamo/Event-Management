@extends('layouts.app')
{{-- @include('layouts.left_side_bar') --}}
@section('content')
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('dependent.edit') !!}</div>
    <div class="container">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('dependent.store.edited') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label class="col-md-3 col-xs-12 control-label">Name</label>

                                <div class="col-md-3 col-xs-6">
                                    <input id="first_name" type="text" placeholder="First" class="form-control" name="first_name" value="{{ $dependent->first_name }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-3 col-xs-6">
                                    <input id="last_name" type="text" placeholder="Last" class="form-control" name="last_name" value="{{ $dependent->last_name }}" required autofocus>

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
                                    <input id="email" type="email" class="form-control" name="email" value="{{ $dependent->email }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group" style="display: none;">
                                <div class="col-md-4">
                                    <input id="id" type="text" class="form-control" name="id" value="{{ $id }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone_number" class="col-md-3 control-label">Phone Number</label>

                                <div class="col-md-4">
                                    <input id="phone_number" type="text" class="form-control" name="phone_number" placeholder="" value="{{$dependent->phone_number}}" required autofocus>
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
                                            <option value="Unspecified" <?php if($dependent->gender=='Unspecified') echo 'selected' ?>></option>
                                            <option value="Female" <?php if($dependent->gender=='Female') echo 'selected' ?>>Female</option>
                                            <option value="Male" <?php if($dependent->gender=='Male') echo 'selected' ?>>Male</option>
                                        </select>
                                    </div>
                                </div>
                                <label for="relation" class="col-md-1 col-xs-12 control-label">Relation</label>
                                <div class="col-md-3 col-xs-6">
                                    <select id="relation" class="form-control" name="relation">
                                        <option value="Unspecified" <?php if($dependent->relation=='Unspecified') echo 'selected' ?>></option>
                                        <option value="Son" <?php if($dependent->relation=='Son') echo 'selected' ?>>Son</option>
                                        <option value="Brother" <?php if($dependent->relation=='Brother') echo 'selected' ?>>Brother</option>
                                        <option value="Other" <?php if($dependent->relation=='Other') echo 'selected' ?>>Other</option>
                                    </select>
                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                    <a href="{{route('dependent.delete',$id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
