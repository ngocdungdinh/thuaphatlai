<?php namespace Controllers\Admin;

use AdminController;
use Input;
use Lang;
use Category;
use Redirect;
use Sentry;
use Str;
use Validator;
use View;

class CategoriesController extends AdminController
{
    /**
	 * Show a list of all the categories.
	 *
	 * @return View
	 */
    public function getIndex()
    {
        // Grab all the categories
		$categories = Category::where('parent_id', '=', 0)->orderBy('showon_menu', 'ASC')->get();

		// Show the page
		return View::make('backend/categories/index', compact('categories'));
    }
    
    /**
	 * News post create.
	 *
	 * @return View
	 */
	public function getCreate()
	{
		// Grab all the categories
		$categories = Category::where('parent_id', '=', 0)->orderBy('showon_menu', 'ASC')->get();
		// Show the page
		return View::make('backend/categories/create', compact('categories'));
	}
    
    /**
	 * News post create form processing.
	 *
	 * @return Redirect
	 */
	public function postCreate()
	{
		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required|min:3',
			'showon_menu' => 'required|integer',
			'showon_homepage' => 'required|integer',
			'status' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Create a new news category
		$category = new Category;

		// Update the news category data
		$category->name            	= Input::get('name');
		$category->slug             = e(Str::slug(Input::get('name')));
		$category->parent_id        = e(Input::get('parent_id'));
		$category->showon_menu      = e(Input::get('showon_menu'));
		$category->showon_homepage  = e(Input::get('showon_homepage'));
		$category->status           = e(Input::get('status'));
		$category->user_id          = Sentry::getId();

		// Was the news category created?
		if($category->save())
		{
			// Redirect to the new news category page
			return Redirect::to("admin/categories/$category->id/edit")->with('success', Lang::get('admin/categories/message.create.success'));
		}

		// Redirect to the news category create page
		return Redirect::to('admin/categories/create')->with('error', Lang::get('admin/categories/message.create.error'));
	}
    
    /**
	 * News category update.
	 *
	 * @param  int  $catId
	 * @return View
	 */
	public function getEdit($catId = null)
	{
		// Check if the news category exists
		if (is_null($category = Category::find($catId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/categories')->with('error', Lang::get('admin/categories/message.does_not_exist'));
		}
		// Grab all the categories
		$categories = Category::where('parent_id', '=', 0)->orderBy('showon_menu', 'ASC')->get();

		// Show the page
		return View::make('backend/categories/edit', compact('category', 'categories'));
	}
    
    /**
	 * News Category update form processing page.
	 *
	 * @param  int  $catId
	 * @return Redirect
	 */
	public function postEdit($catId = null)
	{
		// Check if the news category exists
		if (is_null($category = Category::find($catId)))
		{
			// Redirect to the news management page
			return Redirect::to('admin/categories')->with('error', Lang::get('admin/categories/message.does_not_exist'));
		}

		// Declare the rules for the form validation
		$rules = array(
			'name'   => 'required|min:3',
			'showon_menu' => 'required|integer',
			'showon_homepage' => 'required|integer',
			'status' => 'required'
		);

		// Create a new validator instance from our validation rules
		$validator = Validator::make(Input::all(), $rules);

		// If validation fails, we'll exit the operation now.
		if ($validator->fails())
		{
			// Ooops.. something went wrong
			return Redirect::back()->withInput()->withErrors($validator);
		}

		// Update the news post data
		$category->name            	= Input::get('name');
		$category->slug             = e(Str::slug(Input::get('name')));
		$category->parent_id        = e(Input::get('parent_id'));
		$category->showon_menu      = e(Input::get('showon_menu'));
		$category->showon_homepage  = e(Input::get('showon_homepage'));
		$category->status           = e(Input::get('status'));

		// Was the news post updated?
		if($category->save())
		{
			// Redirect to the new news category page
			return Redirect::to("admin/categories/$catId/edit")->with('success', Lang::get('admin/categories/message.update.success'));
		}

		// Redirect to the categories category management page
		return Redirect::to("admin/categories/$catId/edit")->with('error', Lang::get('admin/categories/message.update.error'));
	}
}

