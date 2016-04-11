@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a User ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Create a New User
            <a href="{{ route('users') }}" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">Permissions</a></li>
</ul>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<div class="row col-md-12">
        <div class="col-md-9">
            <!-- Tabs Content -->
            <div class="tab-content">
                <!-- General tab -->
                <div class="tab-pane fade in active" id="tab-general">
                    <!-- First Name -->
                    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label class="control-label" for="first_name">First Name</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
                            {{ $errors->first('first_name', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Last Name -->
                    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        <label class="control-label" for="last_name">Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
                            {{ $errors->first('last_name', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Email -->
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label" for="email">Email</label>
                            <input class="form-control" type="text" name="email" id="email" value="{{ Input::old('email') }}" />
                            {{ $errors->first('email', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Password -->
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="control-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" id="password" value="" />
                            {{ $errors->first('password', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Password Confirm -->
                    <div class="form-group {{ $errors->has('password_confirm') ? 'has-error' : '' }}">
                        <label class="control-label" for="password_confirm">Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirm" id="password_confirm" value="" />
                            {{ $errors->first('password_confirm', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Activation Status -->
                    <div class="form-group {{ $errors->has('activated') ? 'has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label" for="activated">User Activated</label>
                                <select class="form-control" name="activated" id="activated">
                                    <option value="1"{{ (Input::old('activated', 0) === 1 ? ' selected="selected"' : '') }}>@lang('general.yes')</option>
                                    <option value="0"{{ (Input::old('activated', 0) === 0 ? ' selected="selected"' : '') }}>@lang('general.no')</option>
                                </select>
                                {{ $errors->first('activated', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="form-group {{ $errors->has('groups') ? 'has-error' : '' }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label class="control-label" for="groups">Groups</label>
                                <select class="form-control" name="groups[]" id="groups[]" multiple="multiple">
                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <span class="help-block">
                            Select a group to assign to the user, remember that a user takes on the permissions of the group they are assigned.
                        </span>
                    </div>
                </div>

                <!-- Permissions tab -->
                <div class="tab-pane fade" id="tab-permissions">
                    <div class="form-group">
                        <div class="controls">

                            @foreach ($permissions as $area => $permissions)
                            <fieldset>
                                <legend>{{ $area }}</legend>

                                @foreach ($permissions as $permission)
                                <div class="row">
                                    <div class="col-md-3">{{ $permission['label'] }}</div>

                                    <div class="col-md-3">
                                        <label for="{{ $permission['permission'] }}_allow" onclick="">
                                            <input type="radio" value="1" id="{{ $permission['permission'] }}_allow" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === 1 ? ' checked="checked"' : '') }}>
                                            Allow
                                        </label>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="{{ $permission['permission'] }}_deny" onclick="">
                                            <input type="radio" value="-1" id="{{ $permission['permission'] }}_deny" name="permissions[{{ $permission['permission'] }}]"{{ (array_get($selectedPermissions, $permission['permission']) === -1 ? ' checked="checked"' : '') }}>
                                            Deny
                                        </label>
                                    </div>

                                    @if ($permission['can_inherit'])
                                    <div class="col-md-3">
                                        <label for="{{ $permission['permission'] }}_inherit" onclick="">
                                            <input type="radio" value="0" id="{{ $permission['permission'] }}_inherit" name="permissions[{{ $permission['permission'] }}]"{{ ( ! array_get($selectedPermissions, $permission['permission']) ? ' checked="checked"' : '') }}>
                                            Inherit
                                        </label>
                                    </div>
                                    @endif
                                </div>
                                @endforeach

                            </fieldset>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form actions -->
	<div class="form-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('users') }}">Cancel</a>

			<button type="reset" class="btn btn-default btn-sm">Reset</button>

			<button type="submit" class="btn btn-primary btn-sm">Create User</button>
		</div>
	</div>
</form>
@stop
