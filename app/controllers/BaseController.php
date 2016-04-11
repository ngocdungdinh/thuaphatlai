<?php

class BaseController extends Controller {

	/**
	 * Message bag.
	 *
	 * @var Illuminate\Support\MessageBag
	 */
	protected $messageBag = null;

	/**
	 * Initializer.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// CSRF Protection
		$this->beforeFilter('csrf', array('on' => 'post'));
        //calculate last week
        $curr_time = new Datetime;
		$last_week = $curr_time->modify('-'.Config::get('app.backdays').' day');
        
        //categories for menu
        $this->data['categories'] = Category::where('showon_menu', '>', 0)->orderBy('showon_menu', 'ASC')->get();
        
        //right block featured posts
        $this->data['featured_posts'] = Post::select('posts.*', 'medias.mpath', 'medias.mname')
			->join('medias', 'medias.id', '=', 'posts.media_id')
			->where('post_type', 'post')
			->where('status', 'published')
			->where('is_featured', 1)
			->orderBy('created_at', 'DESC')->take(5)->get();
        
        //right block most view posts
        $this->data['hot_posts'] = Post::select('posts.*', 'medias.mpath', 'medias.mname')
			->join('medias', 'medias.id', '=', 'posts.media_id')
			->where('post_type', 'post')
			->where('status', 'published')
            //->where('created_at', '>', $last_week)
			->orderBy('view_count', 'DESC')->take(5)->get();
    
        //var_dump('<pre>',$this->data['hot_posts']);exit;

		//
		$this->messageBag = new Illuminate\Support\MessageBag;
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout, $this->data);
		}
	}

}
