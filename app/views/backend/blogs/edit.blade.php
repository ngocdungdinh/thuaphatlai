@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Blog Post Update ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Update Post
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
    <input type="hidden" name="_token" value="{{ csrf_token() }}"/>

    <div class="row col-md-12">
        <div class="col-md-9">
            <!-- Tabs Content -->
            <div class="tab-content">
                <!-- General tab -->
                <div class="tab-pane fade in active" id="tab-general">
                    <!-- Post Title -->
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label class="control-label" for="title">Post Title</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ Input::old('title', $post->title) }}"/>
                        {{ $errors->first('title', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Post Excerpt -->
                    <div class="form-group {{ $errors->has('excerpt') ? 'has-error' : '' }}">
                        <label class="control-label" for="excerpt">Post Excerpt</label>
                        <textarea class="form-control" name="excerpt" id="excerpt" value="excerpt" rows="3">{{ Input::old('excerpt', $post->excerpt) }}</textarea>
                        {{ $errors->first('excerpt', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Post Slug -->
                    <div class="form-group">
                        <label class="control-label" for="slug">Slug</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                {{ str_finish(URL::to('/'), '/') }}
                            </span>
                            <input class="form-control" type="text" name="slug" id="slug"
                                   value="{{ Input::old('slug', $post->slug) }}">
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                        <label class="control-label" for="content">Content</label>
                        <span class="pull-right"><a class="btn btn-info btn-xs media-modal" data-url="{{ URL::to('medias/upload?env=post') }}"><i class="glyphicon glyphicon-cloud-upload"></i> Media Library</a></span>
                        <textarea class="form-control" name="content" value="content" rows="10">{{ Input::old('content',
                            $post->content) }}</textarea>
                        {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                    </div>
                </div>

                <!-- Meta Data tab -->
                <div class="tab-pane fade" id="tab-meta-data">
                    <!-- Meta Title -->
                    <div class="form-group {{ $errors->has('meta-title') ? 'has-error' : '' }}">
                        <label class="control-label" for="meta-title">Meta Title</label>
                        <input class="form-control" type="text" name="meta-title" id="meta-title" value="{{ Input::old('meta-title', $post->meta_title) }}"/>
                        {{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Meta Description -->
                    <div class="form-group {{ $errors->has('meta-description') ? 'has-error' : '' }}">
                        <label class="control-label" for="meta-description">Meta Description</label>
                        <input class="form-control" type="text" name="meta-description" id="meta-description" value="{{ Input::old('meta-description', $post->meta_description) }}"/>
                        {{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
                    </div>

                    <!-- Meta Keywords -->
                    <div class="form-group {{ $errors->has('meta-keywords') ? 'has-error' : '' }}">
                        <label class="control-label" for="meta-keywords">Meta Keywords</label>
                        <input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{ Input::old('meta-keywords', $post->meta_keywords) }}"/>
                        {{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">Publish</div>
                <div class="panel-body">
                    <div class="pull-left">
                        <select name="status" class="form-control">
                            <option value="published" {{ $post->status == 'published' ? 'selected="selected"' : '' }}>Published</option>
                            <option value="draft" {{ $post->status == 'draft' ? 'selected="selected"' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div class="controls pull-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                <div class="panel-footer">
                    <!-- Form Actions -->
                    
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a class="btn btn-link" href="{{ route('blogs') }}">Cancel</a>

                    

                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Categories</div>
                <div class="panel-body">
                    <div id="category-list">
                        @foreach($categories as $category)
                            @if($category->parent_id == 0)
                                <div class="checkbox">
                                  <label class="scat category-id-{{ $category->id }} {{ $category->id == $post->category_id ? 'active' : '' }}" id="category-id-{{ $category->id }}">
                                    <input name="categories[]" type="checkbox" value="{{ $category->id}}" {{ in_array($category->id, $catIds) ? 'checked="checked"' : ''}}> {{ $category->name}}
                                    @if($category->id == $post->category_id)
                                        <span class="glyphicon glyphicon-flag"></span>
                                    @endif
                                    <a href="javascript:void(0)" onclick="setPrimaryCat('{{ $post->id }}', '{{ $category->id }}')" style="display: none"><span class="glyphicon glyphicon-flag"></span></a>
                                  </label>
                                </div>
                                @foreach ($category->subscategories as $subcate)
                                    <div class="checkbox">
                                      <label class="scat {{ $subcate->id == $post->category_id ? 'active' : '' }}" id="category-id-{{ $subcate->id }}">
                                        <input name="categories[]" type="checkbox" value="{{ $subcate->id}}" {{ in_array($subcate->id, $catIds) ? 'checked="checked"' : ''}}> -- {{ $subcate->name}}
                                        @if($subcate->id == $post->category_id)
                                            <span class="glyphicon glyphicon-flag"></span>
                                        @else
                                            <a href="javascript:void(0)" onclick="setPrimaryCat('{{ $post->id }}', '{{ $subcate->id }}')" style="display: none"><span class="glyphicon glyphicon-flag"></span></a>
                                        @endif
                                      </label>!
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                        <i><span class="glyphicon glyphicon-flag"></span> - main category</i>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Featured Image</div>
                <div class="panel-body">
                    <p class="help-block" id="cover-image">
                        @if($media)
                            <img src="{{ asset($media->mpath . '/'.Config::get('image.featuredsize').'/' . $media->mname) }}" width="100%" />
                            <a class="label label-default" href="javascript:void(0)" onclick="removeNewsCover()" >remove</a>
                        @else
                            <a class="btn btn-info btn-xs media-modal" data-url="{{ URL::to('medias/upload?env=post') }}">
                                <i class="glyphicon glyphicon-cloud-upload"></i> Set featured image
                            </a>
                        @endif
                    </p>
                    <input type="hidden" name="media_id" value="{{ $post->media_id }}" id="media-cover-id" />
                    
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Tags</div>
                <div class="panel-body">
                    <div style="margin-bottom: 5px; padding-bottom: 5px; border-bottom: 1px solid #eeeeee">
                        <input type="text" name="tagname" id="tagName" class="form-control" value="" />
                        <div>type and press enter to add tag</div>
                    </div>
                    <div id="tagList">
                        @if ($tags != '')
                            @foreach($tags as $tag)
                            <p><a href="javascript:void(0)" onclick="removeTaginPost('tag', '{{ $tag->id }}', this)" class="btn btn-default btn-xs">X</a> {{ $tag->name}}</p>
                            @endforeach
                        @endif
                        <input type="hidden" name="tags" id="tagIds" value="{{ implode(',', $tagIds) }}" />
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">Optionals</div>
                <div class="panel-body">
                    <div class="checkbox">
                        <label><input type="checkbox" name="is_featured" value="1" {{ $post->is_featured ? 'checked="checked"' : ''}}> Feature news</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="is_popular" value="1" {{ $post->is_popular ? 'checked="checked"' : ''}}> Flash news</label>
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="showon_homepage" value="1" {{ $post->showon_homepage ? 'checked="checked"' : ''}}> Show on homepage</label>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="form-group"></div>

</form>
<div class="modal fade" id="modal_taglist" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="modalTagList" ></div>
@stop
