<?php namespace App\Services;

use Config, File, Log;
 
class Image {
 
    /**
     * Instance of the Imagine package
     * @var Imagine\Gd\Imagine
     */
    protected $imagine;
 
    /**
     * Type of library used by the service
     * @var string
     */
    protected $library;
 
    /**
     * Initialize the image service
     * @return void
     */
    public function __construct()
    {
        if ( ! $this->imagine)
        {
            $this->library = Config::get('image.library', 'gd');
 
            // Now create the instance
            if     ($this->library == 'imagick') $this->imagine = new \Imagine\Imagick\Imagine();
            elseif ($this->library == 'gmagick') $this->imagine = new \Imagine\Gmagick\Imagine();
            elseif ($this->library == 'gd')      $this->imagine = new \Imagine\Gd\Imagine();
            else                                 $this->imagine = new \Imagine\Gd\Imagine();
        }
    }

	 /**
	 * Resize an image
	 * @param  string  $url
	 * @param  integer $width
	 * @param  integer $height
	 * @param  boolean $crop
	 * @return string
	 */
	public function resize($url, $width = 100, $height = null, $crop = false, $quality = null, $watermark = false)
	{
	    if ($url)
	    {
	        // URL info
	        $info = pathinfo($url);
	 
	        // The size
	        if ( ! $height) $height = $width;
	 
	        // Quality
	        $quality = Config::get('image.quality', 100);
	 
	        // Directories and file names
	        $fileName       = $info['basename'];
	        $sourceDirPath  = public_path() . '/' . $info['dirname'];
	        $sourceFilePath = $sourceDirPath . '/' . $fileName;
	        $targetDirName  = $width . 'x' . $height . ($crop ? '_crop' : '');
	        $targetDirPath  = $sourceDirPath . '/' . $targetDirName . '/';
	        $targetFilePath = $targetDirPath . $fileName;
	        $targetUrl      = asset($info['dirname'] . '/' . $targetDirName . '/' . $fileName);
	 		// echo $targetDirPath; die();
	        // Create directory if missing
	        try
	        {
	            // Create dir if missing
	            if ( ! File::isDirectory($targetDirPath) and $targetDirPath) @File::makeDirectory($targetDirPath);
	 
	            // Set the size
	            $size = new \Imagine\Image\Box($width, $height);
	 
	            // Now the mode
	            $mode = $crop ? \Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND : \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
	 
	            if ( ! File::exists($targetFilePath) or (File::lastModified($targetFilePath) < File::lastModified($sourceFilePath)))
	            {
	                $this->imagine->open($sourceFilePath)
	                              ->thumbnail($size, $mode)
	                              ->save($targetFilePath, array('quality' => $quality));

	            	if($watermark)
	            	{
		            	$image = $this->imagine->open($targetFilePath);
	            		$mark = $this->imagine->open(public_path().'/assets/img/watermark.png');
						$size      = $image->getSize();
						// print_r($size); die();
						$wSize     = $mark->getSize();
						$bottomRight = new \Imagine\Image\Point($size->getWidth() - ($wSize->getWidth() + 30), $size->getHeight() - ($wSize->getHeight()+30));

						$image->paste($mark, $bottomRight)->save($targetFilePath);
	            	}
	            }
	        }
	        catch (\Exception $e)
	        {
	            Log::error('[IMAGE SERVICE] Failed to resize image "' . $url . '" [' . $e->getMessage() . ']');
	        }
	 
	        return $targetUrl;
	    }
	}

	/**
	* Helper for creating thumbs
	* @param string $url
	* @param integer $width
	* @param integer $height
	* @return string
	*/
	public function thumb($url, $width, $height = null)
	{
	    return $this->resize($url, $width, $height, true);
	}

	public function uploadCover($file)
	{
	    if ($file)
	    {
	    	$dir_name = date('Y') . "/" . date('m');
	        $dir = 'covers/' . $dir_name;

	        // Get file info and try to move
	        $destination = Config::get('image.upload_path') . $dir;
	        $filename    = $file->getClientOriginalName();
	        $extension    = $file->getClientOriginalExtension();

	        $filename_string = "db_".time();
	        $filename 		= date('d').".".date('m').".".date('Y')."_".$filename_string.'.'.$extension;
	        $path        = Config::get('image.upload_dir') . '/' . $dir . '/' . $filename;
	        $folder		= Config::get('image.upload_dir') . '/' . $dir;
	        $uploaded    = $file->move($destination, $filename);

	        if ($uploaded)
	        {
	        	$fileInfo['folder'] = $folder;
	        	$fileInfo['name'] = $filename;

	       	 	$img = $this->resize($path, 1600, 330, true, 100);
	            return $fileInfo;
	        } else {
	        	return false;
	        }
	    } else {
	    	return false;
	    }
	}
	/**
	 * Upload an image to the public storage
	 * @param  File $file
	 * @return string
	 */
	public function upload($file, $dir = null, $createDimensions = true, $avatar = false, $watermark = false)
	{
	    if ($file)
	    {
	    	$dir_name = $avatar ? '' : date('Y') . "/" . date('m') . "/" . date('d');
	        // Generate random dir
	        if ( ! $dir)
	        	$dir = $dir_name;
	 		else
				$dir = $dir . '/' . $dir_name;

	        // Get file info and try to move
	        $destination = Config::get('image.upload_path') . $dir;
	        $filename    = $file->getClientOriginalName();
	        $extension    = $file->getClientOriginalExtension();

	        $filename_string = "db_".time();
	        $filename 		= date('d').".".date('m').".".date('Y')."_".$filename_string.'.'.$extension;
	        $path        = Config::get('image.upload_dir') . '/' . $dir . '/' . $filename;
	        $folder		= Config::get('image.upload_dir') . '/' . $dir;
	        $uploaded    = $file->move($destination, $filename);

	        if ($uploaded)
	        {
	        	$fileInfo['folder'] = $folder;
	        	$fileInfo['name'] = $filename;
	            if ($createDimensions) $this->createDimensions($path, $avatar, $watermark);	 
	            
            	if($watermark)
            	{
	            	$image = $this->imagine->open($path);
            		$mark = $this->imagine->open(public_path().'/assets/img/watermark.png');
					$size      = $image->getSize();
					// print_r($size); die();
					$wSize     = $mark->getSize();
					$bottomRight = new \Imagine\Image\Point($size->getWidth() - ($wSize->getWidth() + 30), $size->getHeight() - ($wSize->getHeight()+30));

					$image->paste($mark, $bottomRight)->save($path);
            	}
	            return $fileInfo;
	        } else {
	        	return false;
	        }
	    } else {
	    	return false;
	    }
	}


	/**
	 * Upload an image to the public storage
	 * @param  File $file
	 * @return string
	 */
	public function uploadUrl($fileUrl, $dir = null, $createDimensions = true, $avatar = false)
	{
	    if ($fileUrl)
	    {

	    	$dir_name = $avatar ? '' : date('Y') . "/" . date('m') . "/" . date('d');
	        // Generate random dir
	        if ( ! $dir)
	        	$dir = $dir_name;
	 		else
				$dir = $dir . '/' . $dir_name;

			$fileContent = file_get_contents($fileUrl);
	        // Get file info and try to move
	        $destination = Config::get('image.upload_path') . $dir;
	        // $filename    = $file->getClientOriginalName();
	        // $extension    = $file->getClientOriginalExtension();
	        $extension    = 'jpg';

	        $filename_string = "db_".time();
	        $filename 		= date('d').".".date('m').".".date('Y')."_".$filename_string.'.'.$extension;
	        $path        = Config::get('image.upload_dir') . '/' . $dir . '/' . $filename;
	        $folder		= Config::get('image.upload_dir') . '/' . $dir;
	        $uploaded    = File::put($path, $fileContent);

	        if ($uploaded)
	        {
	        	$fileInfo['folder'] = $folder;
	        	$fileInfo['name'] = $filename;
	            if ($createDimensions) $this->createDimensions($path, $avatar);	 
	            return $fileInfo;
	        } else {
	        	return false;
	        }
	    } else {
	    	return false;
	    }
	}

	/**
	 * Creates image dimensions based on a configuration
	 * @param  string $url
	 * @param  array  $dimensions
	 * @return void
	 */
	public function createDimensions($url, $avatar = false, $wmark = false)
	{
	    // Get default dimensions
	    $dimensions = $avatar ? Config::get('image.avatar_dimensions') : Config::get('image.dimensions');
	 
	    foreach ($dimensions as $dimension)
	    {
	        // Get dimmensions and quality
	        $width   = (int) $dimension[0];
	        $height  = isset($dimension[1]) ?  (int) $dimension[1] : $width;
	        $crop    = isset($dimension[2]) ? (bool) $dimension[2] : false;
	        $quality = isset($dimension[3]) ?  (int) $dimension[3] : Config::get('image.quality');
	        $watermark    = isset($dimension[4]) && $wmark ? (bool) $dimension[4] : false;

	        // Run resizer
	        $img = $this->resize($url, $width, $height, $crop, $quality, $watermark);
	    }
	}
}