@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Create a New Blog Post ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Create Post
            <a href="{{ route('blogs') }}" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Back</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
	<li><a href="#tab-meta-data" data-toggle="tab">Meta Data</a></li>
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
                    <!-- Post Title -->
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Post Title</label>
                        <input class="form-control" type="text" name="title" id="title" value="{{ Input::old('title') }}" />
                        {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                    </div>
                    
                    <!-- Post Excerpt -->
                    <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                        <label class="control-label" for="excerpt">Post Excerpt</label>
                        <textarea class="form-control" name="excerpt" id="excerpt" value="excerpt" rows="3">{{ Input::old('excerpt') }}</textarea>
                        {{ $errors->first('excerpt', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Post Slug -->
                    <div class="form-group">
                        <label class="control-label" for="slug">Slug</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ str_finish(URL::to('/'), '/') }}
                            </span>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{ Input::old('slug') }}">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group {{ $errors->has('content') ? 'error' : '' }}">
                        <label class="control-label" for="content">Content</label>
                        <span class="pull-right"><a class="btn btn-info btn-xs media-modal" data-url="{{ URL::to('medias/upload?env=post') }}"><i class="glyphicon glyphicon-cloud-upload"></i> Media Library</a></span>
                            <textarea class="form-control" name="content" id="content" value="content" rows="10">{{ Input::old('content') }}</textarea>
                            {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Meta Data tab -->
                <div class="tab-pane fade" id="tab-meta-data">
                    <!-- Meta Title -->
                    <div class="form-group {{ $errors->has('meta-title') ? 'error' : '' }}">
                        <label class="control-label" for="meta-title">Meta Title</label>
                        <input class="form-control" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title') }}" />
                        {{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Meta Description -->
                    <div class="form-group {{ $errors->has('meta-description') ? 'error' : '' }}">
                        <label class="control-label" for="meta-description">Meta Description</label>
                        <input class="form-control" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description') }}" />
                        {{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group {{ $errors->has('meta-keywords') ? 'error' : '' }}">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
                        <input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords') }}" />
                        {{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Status</div>
                <div class="panel-body">
                    <div class="pull-left">
                        <select name="status" class="form-control">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="controls pull-right">
                        <button type="submit" class="btn btn-primary">Publish</button>
                    </div>
                </div>
                <div class="panel-footer">
                    
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a class="btn btn-link" href="{{ route('blogs') }}">Cancel</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    @foreach($categories as $category)
                        @if($category->parent_id == 0)
                            <div class="checkbox">
                              <label>
                                <input name="categories[]" type="checkbox" value="{{ $category->id}}"> {{ $category->name}}
                              </label>
                            </div>
                            @foreach ($category->subscategories as $subcate)
                                <div class="checkbox">
                                  <label>
                                    <input name="categories[]" type="checkbox" value="{{ $subcate->id}}">  - {{ $subcate->name}}
                                  </label>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Featured Image</div>
                <div class="panel-body">
                    <p class="help-block" id="cover-image">
                        <a class="btn btn-info btn-xs media-modal" data-url="{{ URL::to('medias/upload?env=post') }}">
                            <i class="glyphicon glyphicon-cloud-upload"></i> Set featured image
                        </a>
                    </p>
                    <input type="hidden" name="media_id" value="" id="media-cover-id" />
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>
                <div class="panel-body">
                    <div style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: 1px solid #eeeeee">
                        <input type="text" name="tagname" id="tagName" class="form-control" value="" />
                    </div>
                    <div id="tagList">
                        <input type="hidden" name="tags" id="tagIds" value="" />
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
					<div class="panel-heading">Optionals</div>
					<div class="panel-body">
						<div class="checkbox">
							<label><input type="checkbox" name="is_featured" value="1"> Featured News</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="is_popular" value="1"> Flash News</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" name="showon_homepage" value="1"> Show on Homepage</label>
						</div>
					</div>
				</div>
        </div>
    </div>

	<!-- Form actions -->
	<div class="form-group">
		{{--<div class="controls">--}}
			{{--<a class="btn btn-link" href="{{ route('blogs') }}">Cancel</a>--}}

			{{--<button type="reset" class="btn btn-default btn-sm">Reset</button>--}}

			{{--<button type="submit" class="btn btn-primary btn-sm">Publish</button>--}}
		{{--</div>--}}
	</div>
</form>
@stop
