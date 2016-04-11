<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="your, awesome, keywords, here"/>
    <meta name="author" content="dungdn"/>
    <meta name="description"
          content="Lorem ipsum dolor sit amet, nihil fabulas et sea, nam posse menandri scripserit no, mei."/>

    <title>
        @section('title')
        Administration
        @show
    </title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('assets/css/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('assets/css/plugins/timeline.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{ asset('assets/css/plugins/morris.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script>
        var base_url = "{{ URL::to('/') }}";
    </script>

</head>

<body>

<div id="wrapper">
<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <!-- Header -->
    @include('backend/inc/header')

    <!-- Nav -->
    @include('backend/inc/nav')

</nav>

<div id="page-wrapper">

    <!-- Notifications -->
    @include('frontend/notifications')
    <!-- Content -->
    @yield('content')

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Upload image -->
<div class="modal fade" id="modal_updateMedia" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Library</h4>
            </div>
            <div class="modal-body">
                <div id="mediaContent"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Media Upload</h4>
            </div>
            <div class="modal-body">
            <div class="row">
                <form class="form-horizontal" autocomplete="off" action="" enctype="multipart/form-data" method="post">
                    <input type="hidden" value="mOF91eeJqWfl8HhspuoifFZ2JHldbS1pueL90PqF" name="_token">
                    <div class="form-group">
                        <label class="col-lg-1 control-label"></label>
                        <label for="first_name" class="col-lg-3 control-label">
                            <img width="100%" src="" class="thumbnail">
                        </label>
                        <div class="col-lg-7">
                            <p>Upload image from your computer</p>
                            <input type="file" value="" id="picture" name="picture" class="form-control">
                            <p><small>Định dạng: jpg, jpeg, png. Dung lượng: nhỏ hơn 3M</small></p>
                            <div><button class="btn" type="submit">Upload</button></div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery Version 1.11.0 -->
<script src="{{ asset('assets/js/jquery-1.11.0.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="{{ asset('assets/js/plugins/metisMenu/metisMenu.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('assets/js/plugins/morris/raphael.min.js') }}"></script>

<script src="{{ asset('assets/js/typeahead.min.js') }}"></script>


<!-- Custom Theme JavaScript -->
<script src="{{ asset('assets/js/sb-admin-2.js') }}"></script>
<script src="{{ asset('assets/js/admin.js') }}"></script>
<!-- Intergrate CKEditor-->
<script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>

<script type="text/javascript">			
    $(document).ready(function(){
        jQuery('input#tagName').typeahead({
            name: 'tagname',
            local: ['dungdn', 'l4cms'],
            valueKey: 'name',
            remote: {
                url: '/admin/tags/ajaxlist?keyword=%QUERY',
            }
        });
        
        CKEDITOR.replace('content',{ toolbar:'CusToolbar', height: '500px'} );
    });
</script>
</body>

</html>
