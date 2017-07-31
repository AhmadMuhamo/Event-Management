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
<div style="width:100%; text-align: center;">{!! Breadcrumbs::render('manage_accounts') !!}</div>
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
            		<div class="panel panel-primary">
            			<div class="panel-body">
            				<table class="table table-striped table-hover">
                        	<tr>
                        		<th>User ID</th>
                        		<th>Email</th>
                        		<th>Dependents</th>
                        		<th>Admin?</th>
                        		<th>Joining date</th>
                        	</tr>
                    			@for($i=0;$i<count($users);$i++)
	                    			<tr onclick="window.location='/admin/users/manage/userid={{$users[$i]->id}}';">
	                    				<td>{{$users[$i]->id}}</td>
	                    				<td>{{$users[$i]->email}}</td>
	                    				<td>{{$dependents[$i]}}</td>
	                    				<td>@if($users[$i]->admin == 1) Yes @else No @endif</td>
	                    				<td>{{date('M d, Y',strtotime($users[$i]->created_at))}}</td>
	                    			</tr>
                            	@endfor
                        </table>
            			</div>
            		</div>

    </div>

@endsection