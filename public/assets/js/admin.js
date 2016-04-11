$(document).ready(function () {
	$("#searchTags").bind("click", function(){ ajaxSearchTags(); })

    $('#tagName').keypress(function(event) {
        if (event.keyCode == 13) {
            addTagtoPost('tag', '', '');
            return false;
        }
    });
	
	$('.media-modal').click(function (event) {
		event.preventDefault()
		var url = $(this).data('url');
		//console.log(url);
		if (url.length > 0) {
			$("#mediaContent").html('<iframe frameborder="0" hspace="0" src="' + url + '" id="TB_iframeContent" name="TB_iframeContent131" style="height: 440px; width: 100%">This feature requires inline frames. You have iframes disabled or your browser does not support them.</iframe>');
			$("#modal_updateMedia").modal("show");
		} else {
			alert('Can not complete this action!');
		}
	});
});

function image_send_to_editor(photo_url, e) {
	var htmlContent = '<p align="center"><img src="/' + photo_url + '" style="padding: 10px 0; width: 500px; text-align: center" /></p>';
	CKEDITOR.instances.content.insertHtml(htmlContent);
	// $('#modal_updateMedia').modal('hide');
	$(e).addClass('disabled');
}

function setCover(mpath, mname, featuredSize, mid) {
	$("#media-cover-id", window.parent.document).val(mid);
	$("#cover-image", window.parent.document).html('<img src="/' + mpath + '/' + featuredSize + '/' + mname + '" width="100%" /><a class="label label-default" href="javascript:void(0)" onclick="removeNewsCover()" >remove</a>');
	$('#modal_updateMedia').modal('hide');
}

function setNewsCover(pid, mid) {
	$.ajax({
		type: 'POST',
		url: "/admin/blogs/setcover",
		data: {post_id: pid, media_id: mid},
		dataType: 'json',
		ifModify: false,
		success: function (data) {
			$("#media-cover-id", window.parent.document).val(data.id);
			$("#cover-image", window.parent.document).html('<img src="/' + data.mpath + '/' + data.featuredSize + '/' + data.mname + '" width="100%" /><a class="label label-default" href="javascript:void(0)" onclick="removeNewsCover()" >remove</a>');
		}
	});
}

function removeNewsCover() {
	$("#media-cover-id").val("");
	//$("#cover-image").html("Choose from library.");
	$("#cover-image").html('<a class="btn btn-info btn-xs media-modal" data-url="' + base_url + '/medias/upload?env=post"><i class="glyphicon glyphicon-cloud-upload"></i> Set featured image</a>');

}

function removeMedia(media_id) {
	if (confirm("Delete cannot be undone! Are you sure you want to do this?")) {
		$.ajax({
			type: 'POST',
			url: "/medias/" + media_id + "/delete",
			dataType: 'json',
			ifModify: false,
			success: function (data) {
				if (data.status == 1)
					$("#media_" + media_id).fadeOut();
				else
					alert('An error has occured!');
			}
		});
	}
}

function ajaxSearchTags() {
	var order = $("#orderByDate").val();
	var keyword = $("#keyword").val();
	$.ajax({
		type: 'GET',
		url: "/admin/tags/listpopup",
		data: {keyword: keyword, order: order},
		ifModify: false,
		success: function (data) {
			$("#modal_taglist").html(data);
		}
	});
}

function addTagtoPost(type, tid, name) {
	if (type == "tag") {
		var tagName = $("#tagName").val();
		if (tagName != "" && tagName.length > 2) {
			// console.log(tagName);
			$.ajax({
				type: 'POST',
				url: "/admin/tags/ajaxcreate",
				data: {name: tagName},
				dataType: 'json',
				ifModify: false,
				success: function (data) {
					tagAppend(type, data.id, data.name);
					$('#tagName').val('').focus();
				}
			});
		}
	} else {
		tagAppend(type, tid, name);
	}
}

function tagAppend(type, tid, name) {
	var ids = $("#" + type + "Ids").val();
	var idArr = ids != "" ? ids.split(',') : [];
	// push id to array
	idArr.push(tid);
	$("#" + type + "Ids").val(idArr.join(','));
	$("#" + type + "List").append('<p><a href="javascript:void(0)" onclick="removeTaginPost(\'topic\', ' + tid + ', this)" class="btn btn-default btn-xs">X</a> ' + name + '</p>');
}

function removeTaginPost(type, tid, e) {
	var ids = $("#" + type + "Ids").val();
	var idArr = ids.split(',');
	idArr.splice($.inArray(tid, idArr), 1);
	$("#" + type + "Ids").val(idArr.join(','));
	$(e).parent().remove();
}