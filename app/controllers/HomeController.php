<?php

class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showIndex() {
        //$this->data['categories'] = Category::where('showon_menu', '>', 0)->orderBy('showon_menu', 'ASC')->get();
        //gioi thieu
        $this->data['aboutus'] = Post::select('posts.*', 'medias.mpath', 'medias.mname')
			->join('medias', 'medias.id', '=', 'posts.media_id')
			->where('post_type', 'post')
			->where('status', 'published')
			->where('category_id', 25) //new category id
			->orderBy('created_at', 'DESC')->take(4)->get();
        //var_dump('<pre>',$this->data['aboutus']);exit;
        
        //dich vu
        $service_category = Category::where('id', 26)->first();
        //var_dump('<pre>',$service_category);exit;
//        $this->data['services'] = Post::select('posts.*', 'medias.mpath', 'medias.mname')
//			->join('medias', 'medias.id', '=', 'posts.media_id')
//			->where('post_type', 'post')
//			->where('status', 'published')
//			->where('category_id', 26) //new category id
//			->orderBy('created_at', 'DESC')->take(6)->get();
        $this->data['services'] = $service_category->rposts()->select('posts.*', 'medias.mpath', 'medias.mname')
			->leftJoin('medias', 'medias.id', '=', 'posts.media_id')
			->where('status', 'published')
			->where('post_type', 'post')
			->orderBy('created_at', 'DESC')->take(6)->get();
        
        //var_dump('<pre>',$this->data['services']);exit;
        
        //tu van - hoi dap
        $this->data['consulting'] = Post::select('posts.*', 'medias.mpath', 'medias.mname')
			->join('medias', 'medias.id', '=', 'posts.media_id')
			->where('post_type', 'post')
			->where('status', 'published')
			->where('category_id', 27) //new category id
			->orderBy('created_at', 'DESC')->take(6)->get();
        
        //news for homepage
        $block_news = Post::select('posts.*', 'medias.mpath', 'medias.mname')
			->join('medias', 'medias.id', '=', 'posts.media_id')
			->where('post_type', 'post')
			->where('status', 'published')
			->where('category_id', 29) //new category id
			->orderBy('created_at', 'DESC')->take(9)->get();
        $this->data['block_news'] = json_decode($block_news);

        //newest post
        $this->data['new_update'] = Post::select('posts.*')
            ->where('post_type', 'post')
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')->take(1)->get();
        return View::make('frontend/home', $this->data);
    }

    public function showWelcome() {
        return View::make('hello');
    }

}
