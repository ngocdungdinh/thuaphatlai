@extends('backend/layouts/default')

{{-- Page title --}}
@section('title')
Blog Management ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog Management
            <a href="{{ route('create/blog') }}" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-plus"></i> Create</a>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>@lang('admin/blogs/table.title')</th>
                <th>@lang('admin/blogs/table.comments')</th>
                <th>@lang('admin/blogs/table.created_at')</th>
                <th>@lang('table.actions')</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td>{{ $post->comments()->count() }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('update/blog', $post->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit fa-fw"></i> @lang('button.edit')</a>
                    <a href="{{ route('delete/blog', $post->id) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> @lang('button.delete')</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
</div>
@stop