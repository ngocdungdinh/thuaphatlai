<?php

class MediasController extends AuthorizedController {

	public function postUpload() {
        $rules = array(
            'picture' => 'image|max:2500|mimes:jpg,jpeg,png'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $env = Input::get('env', '');

    	$upload = Image::upload(Input::file('picture'), 'medias', true);

        if($upload){

            // save to database
            $media = new Media;
            $media->mpath = $upload['folder'];
            $media->mname = $upload['name'];
            $media->user_id = Sentry::getId();
            if ($env) {
		        $media->type = $env;
	        }
            $media->save();
            echo $upload['folder'].'/'.Config::get('image.featuredsize').'/'.$upload['name'];
        } else {
			echo "Tải ảnh không thành công!";
		}
	}

	public function getUpload() {
        $env = Input::get('env', '');
		return View::make('medias/upload', compact('env'));
	}

    public function postDelete($mediaId) {

        // Check if the news post exists
        if (is_null($media = Media::find($mediaId)))
        {
            return json_encode(array('status'=>0));
        }

        // Delete the news post
        if($media->delete()) {
            return json_encode(array('status'=>1));
        } else {
            return json_encode(array('status'=>0));
        }
    }

    public function getIndex() {
        $env = Input::get('env', 'post');
        $images = array();
        // Get all the news posts
        $images = Media::orderBy('created_at', 'DESC')->paginate(8);

        return View::make('medias/index', compact('images', 'env'));
    }

	public function getMy() {
        $env = Input::get('env', '');
		$images = array();
		// Get all the news posts
		$images = Media::where("user_id", Sentry::getId())
            ->where('type',$env)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

		return View::make('medias/index', compact('images', 'env'));
	}
}