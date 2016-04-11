<?php

class Post extends Eloquent {

    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    //protected $softDelete = true;

	/**
	 * Deletes a blog post and all the associated comments.
	 *
	 * @return bool
	 */
	public function delete()
	{
		// Delete the comments
		$this->comments()->delete();

		// Delete the blog post
		return parent::delete();
	}

	/**
	 * Returns a formatted post content entry, this ensures that
	 * line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Return the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo('User', 'user_id');
	}

	/**
	 * Return how many comments this post has.
	 *
	 * @return array
	 */
	public function comments()
	{
		return $this->hasMany('Comment');
	}

	/**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	/*
    public function url()
	{
		return URL::route('view-post', $this->slug);
	}
     * 
     */

    /**
	 * Return the URL to the post.
	 *
	 * @return string
	 */
	public function url()
	{
		if(isset($this->category->slug))
			return URL::route('view-post', array($this->category->slug, $this->slug));
		else
			return null;
	}
    
	/**
	 * Return the post thumbnail image url.
	 *
	 * @return string
	 */
	public function thumbnail()
	{
		# you should save the image url on the database
		# and return that url here.

		return 'http://lorempixel.com/130/90/business/';
	}
    
    public function category() {
		return $this->belongsTo('Category','category_id');
		// return $this->hasMany('CategoryPost','id');
	}

    /**
     * Return Category id
     *
     * @return int
     */
    public function categoryposts() {
        return $this->hasMany('CategoryPost');
    }

    public function removeCate() {
        $this->categoryposts()->delete();
    }
    
    public function tags() {
		return $this->belongsToMany('Tag','post_tag','post_id','tag_id')->where('type', 'tag');
		// return $this->hasMany('CategoryPost','id');
	}
    
    public function posttags() {
		return $this->hasMany('PostTag');
	}
    
    public function removeTag() {
		$this->posttags()->delete();
	}
    
    public function insertTags($tagIds) {
		$tags = explode(",", $tagIds);
		foreach ($tags as $tagId) {
			# code...
			$posttag = new PostTag;
			$posttag->post_id = $this->id;
			$posttag->tag_id = $tagId;
			$posttag->save();
		}
	}

}
