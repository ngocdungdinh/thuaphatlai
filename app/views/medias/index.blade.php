@extends('backend/layouts/medias')

{{-- Page title --}}
@section('title')
Thư viện của tôi ::
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="row" style="padding-left: 25px;">
    @foreach ($images as $image)
      @include('medias/item')
    @endforeach
</div>
{{ $images->appends(array('env'=>$env))->links() }}
@stop
