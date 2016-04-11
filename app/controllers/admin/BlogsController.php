<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Post;
use Category;
use CategoryPost;
use Media;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;
use Config;

class BlogsController extends AdminController {

	/**
	 * Show a list of all the blog posts.
	 *
	 * @return View
	 */
	public function getIndex()
	{
		// Grab all the blog posts
		$posts = Post::orderBy('created_at', 'DESC')->paginate(10);

		// Show the page
		return View::make('backend/blogs/index', compact('posts'));
	}

	/**
	 * Blog post create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
        //get categories list
        $categories = Category::orderBy('showon_menu', 'ASC')->get();
		// Show the page
		return View::make('backend/blogs/create', compact('categories'));
	}

	/**
	 * Blog post create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
            'excerpt' => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new blog post
		$post = new Post;

		// Update the blog post data
		$post->title            = e(Input::get('title'));
        $post->excerpt          = Input::get('excerpt');
		$post->slug             = e(Str::slug(Input::get('title')));
		$post->content          = Input::get('content');
        $post->is_featured      = e(Input::get('is_featured', 0));
		$post->is_popular       = e(Input::get('is_popular', 0));
		$post->showon_homepage	= e(Input::get('showon_homepage', 0));
        $post->media_id     	= e(Input::get('media_id'));
		$post->meta_title       = e(Input::get('meta-title'));
		$post->meta_description = e(Input::get('meta-description'));
		$post->meta_keywords    = e(Input::get('meta-keywords'));
		$post->user_id          = Sentry::getId();
        $post->status          	= e(Input::get('status'));

		// Was the blog post created?
		if($post->save())
		{
            // Update reference tags
			$tagIds = e(Input::get('tags'));
			if($tagIds) {
	  			$post->insertTags($tagIds);
			}
            
            // Update reference categories
            if(Input::get('categories'))
            {
                foreach(Input::get('categories') as $cateId)
                {
                    $catepost = new CategoryPost;
                    $catepost->category_id = $cateId;
                    $catepost->post_id = $post->id;
                    $catepost->save();
                    $post->category_id = $cateId;
                }
                $post->save();
            }
			// Redirect to the new blog post page
			return Redirect::to("admin/blogs/$post->id/edit")->with('success', Lang::get('admin/blogs/message.create.success'));
		}

		// Redirect to the blog post create page
		return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/message.create.error'));
	}

	/**
	 * Blog post update.
	 *
	 * @param  int  $postId
	 * @return View
	 */
	public function getEdit($postId = null)
	{
		// Check if the blog post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/message.does_not_exist'));
		}
        //get categories list
        $categories = Category::orderBy('showon_menu', 'ASC')->get();
        //get categories post
        $post_categories = $post->categoryposts()->get();

        $catIds = array();
        foreach ($post_categories as $cat) {
            $catIds[] = $cat->category_id;
        }
        
        //get media in post
        $media = null;
		if($post->media_id) {
			$media = Media::find($post->media_id);
		}
        
        //get tags in post
        $tags = $post->tags;
		$tagIds = array();
        if ($tags != '')
        {
            foreach ($tags as $t) {
                $tagIds[] = $t->id;
            }
        }

		// Show the page
		return View::make('backend/blogs/edit', compact('post','categories','post_categories','catIds','media','tagIds','tags'));
	}

	/**
	 * Blog Post update form processing page.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function postEdit($postId = null)
	{
		// Check if the blog post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'title'   => 'required|min:3',
            'excerpt' => 'required|min:3',
			'content' => 'required|min:3',
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}
        
        //main category
        if(Input::get('categories'))
        {
            foreach(Input::get('categories') as $mainCateId)
            {
                $post->category_id = $mainCateId;
            }
        }

		// Update the blog post data
        
		$post->title            = e(Input::get('title'));
        $post->excerpt          = Input::get('excerpt');
		$post->slug             = e(Str::slug(Input::get('title')));
		$post->content          = Input::get('content');
        $post->is_featured      = e(Input::get('is_featured', 0));
		$post->is_popular       = e(Input::get('is_popular', 0));
		$post->showon_homepage	= e(Input::get('showon_homepage', 0));
        $post->media_id     	= e(Input::get('media_id'));
		$post->meta_title       = e(Input::get('meta-title'));
		$post->meta_description = e(Input::get('meta-description'));
		$post->meta_keywords    = e(Input::get('meta-keywords'));
        $post->status          	= e(Input::get('status'));

		// Was the blog post updated?
		if($post->save())
		{
            // Update reference tags
            $tagIds = e(Input::get('tags'));
            if($tagIds) {
	  			$post->removeTag();
	  			$post->insertTags($tagIds);
			}
            
            // Update reference categories
            if(Input::get('categories'))
            {
                $post->removeCate();
                foreach(Input::get('categories') as $cateId)
                {
                    $catepost = new CategoryPost;
                    $catepost->category_id = $cateId;
                    $catepost->post_id = $post->id;
                    if(!$post->category_id)
                        $post->category_id = $cateId;
                    $catepost->save();
                }
                if(!$post->category_id)
                    $post->save();
            }
			// Redirect to the new blog post page
			return Redirect::to("admin/blogs/$postId/edit")->with('success', Lang::get('admin/blogs/message.update.success'));
		}

		// Redirect to the blogs post management page
		return Redirect::to("admin/blogs/$postId/edit")->with('error', Lang::get('admin/blogs/message.update.error'));
	}

	/**
	 * Delete the given blog post.
	 *
	 * @param  int  $postId
	 * @return Redirect
	 */
	public function getDelete($postId)
	{
		// Check if the blog post exists
		if (is_null($post = Post::find($postId)))
		{
			// Redirect to the blogs management page
			return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/message.not_found'));
		}

		// Delete the blog post
		$post->delete();

		// Redirect to the blog posts management page
		return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/message.delete.success'));
	}
    
    /**
	 * Set cover image.
	 *
	 * @param  int  $postId
	 * @param  int  $mediaId
	 * @return Redirect
	 */
	public function postSetCover()
    {
        $rules = array(
            'media_id' => 'required'
        );
        $validation = Validator::make(Input::all(), $rules);
        if ($validation->fails())
        {
            Messages::add('error','An error has occured!');
        }else{
        	$media = Media::find(e(Input::get('media_id')));
        	$media->featuredSize = Config::get('image.featuredsize');
        	if (!is_null($post = Post::find(e(Input::get('post_id')))) && !is_null($media))
			{
				$post->media_id = $media->id;
				$post->save();
				return $media->toJson();
			} else if($media) {
				return $media->toJson();
			}
        }
	}

}
