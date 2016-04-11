<div rel="{{ $image->id }}" id="media_{{ $image->id }}" style="width: 110px; float: left; margin: 5px 12px; ">
  <div class="thumbnail">
    <div style="height:100px;">
      <img src="{{ asset($image->mpath .'/100x100_crop/'. $image->mname ) }}" width="100" />
    </div>
    <div class="caption">
      <div class="action_buttons">
        @if($env == 'product-images')
          <a class="btn btn-info btn-xs" rel="{{ $image->id }}" onclick="parent.addProductImage('{{ $image->id }}', this);" data-toggle="tooltip" data-placement="bottom" title="Thêm ảnh sản phẩm"><span class="glyphicon glyphicon-plus-sign"></span></a>
        @elseif($env == 'attributes')
          <a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="setCover('{{ $image->mpath }}', '{{ $image->mname }}', '{{ Config::get("image.featuredsize") }}', '{{ $image->id }}')" data-toggle="tooltip" data-placement="bottom" title="Chọn làm ảnh đại diện"><span class="glyphicon glyphicon-picture"></span></a>
        @else
          <a class="btn btn-info btn-xs" rel="{{ $image->id }}" onclick="parent.image_send_to_editor('{{ $image->mpath.'/'.Config::get('image.bodysize').'/'.$image->mname }}', this);" data-toggle="tooltip" data-placement="bottom" title="Thêm ảnh vào nội dung bài"><span class="glyphicon glyphicon-save"></span></a>
          <a class="btn btn-warning btn-xs" href="javascript:void(0);" onclick="setNewsCover('', '{{ $image->id }}')" data-toggle="tooltip" data-placement="bottom" title="Chọn làm ảnh đại diện"><span class="glyphicon glyphicon-picture"></span></a>
        @endif
        <a class="btn btn-danger btn-xs" onclick="removeMedia('{{ $image->id }}');" rel="{{ $image->id }}" data-toggle="tooltip" data-placement="bottom" title="Xóa ảnh"><span class="glyphicon glyphicon-remove"></span></a>
      </div>
    </div>
  </div>
</div>