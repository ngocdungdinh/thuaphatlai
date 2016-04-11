@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Update Category ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Update Category
            <a href="{{ route('create/category') }}" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Create</a>
            <a href="{{ route('categories') }}" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<form method="post" action="" autocomplete="off" class="form-horizontal" role="form">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        <label class="col-lg-2 control-label" for="name">Name</label>
        <div class="col-lg-5">
            <input class="form-control" type="text" name="name" id="name" value="{{ $category->name }}" />
            {{ $errors->first('name', '<span class="help-block">:message</span>') }}
        </div>
    </div>

    <div class="form-group">
        <label for="parent_id" class="col-lg-2 control-label">Parent Category</label>
        <div class="col-lg-4">
            <select name="parent_id" id="parent_id" class="form-control">
                <option value="0">- Root</option>
                @foreach($categories as $cat)
                <option {{ $cat->id == $category->parent_id ? 'selected="selected"' : '' }} value="{{ $cat->id }}">- - {{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('showon_menu') ? 'has-error' : '' }}">
        <label class="col-lg-2 control-label" for="showon_menu">Menu Position</label>
        <div class="col-lg-1">
            <input class="form-control" type="text" name="showon_menu" id="showon_menu" value="{{ $category->showon_menu }}" />
        </div>
        {{ $errors->first('showon_menu', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group {{ $errors->has('showon_homepage') ? 'has-error' : '' }}">
        <label class="col-lg-2 control-label" for="showon_homepage">Homepage Position</label>
        <div class="col-lg-1">
            <input class="form-control" type="text" name="showon_homepage" id="showon_homepage" value="{{ $category->showon_homepage }}" />
        </div>
        {{ $errors->first('showon_homepage', '<span class="help-block">:message</span>') }}
    </div>

    <div class="form-group">
        <label for="status" class="col-lg-2 control-label">Status</label>
        <div class="col-lg-2">
            <select name="status" class="form-control">
                <option value="on" {{ $category->status=='on' ? 'selected="selected"' : '' }}>Active</option>
                <option value="off" {{ $category->status=='off' ? 'selected="selected"' : '' }}>InActive</option>
            </select>
        </div>
    </div>
    <hr />
    <label for="inputEmail1" class="col-lg-2 control-label"></label>
    
    <!-- Form actions -->
	<div class="form-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('categories') }}">Cancel</a>

			<button type="reset" class="btn btn-default btn-sm">Reset</button>

			<button type="submit" class="btn btn-primary btn-sm">Save</button>
		</div>
	</div>
</form>
@stop
