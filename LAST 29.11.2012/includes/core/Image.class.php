<?php

class Image
{
    /**
     * Upload image to server
     * 
     */
    public static function uploadImage($image, $options)
    {
    	/* Set default options */
    	$options = array_merge(array
    	(
    		'dir' => SYS_PIC_PATH,
    		'extensions' => array(),
    		'fileSize' => '500',
    		'resize' => array(),
    		'errors' => array
    		(
    			'cant_upload' => __('cant_upload'),
    			'invalid_file' => __('invalid_file'),
    			'file_too_big' => __('file_too_big'),
    			'cannot_create_thumbnail' => __('cannot_create_thumbnail')
    		)
    	), $options);

    	/* Set default error var */
    	$error = null;

		while (true)
		{
			/* Check if file was uploaded */
			if (!@is_uploaded_file($image['tmp_name'])) {
				$error = $options['errors']['cant_upload'];
				break;
			}

			/* Get picture's extention and it's length */
			$fExt = self::getExtension($image['name']);

			/* Check file format */
			if (self::invalidExtension($fExt, $options['extensions'])) {
				$error = $options['errors']['invalid_file'];
				break;
			}
	
			/* Check file size */
			if ($options['fileSize'] > 0 && $image['size'] >= ($options['fileSize'] * 1024)) {
				$error = sprintf($options['errors']['file_too_big'], $options['fileSize']);
				break;
			}

			/* Generate unique filename */
			list($fName, $_fName) = self::generateName($options['dir'], $fExt);

			/* Move the picture to member's folder */
			if (!@move_uploaded_file($image['tmp_name'], $options['dir'] . $fName)) {
				$error = $options['errors']['cant_upload'];
				break;
			}
			@chmod($options['dir'] . $fName, 0644);

			/* Resize photo */
			if (count($options['resize']) > 0 && extension_loaded('gd') && !self::invalidExtension($fExt))
			{
				/* Parse each resize option */
				foreach ($options['resize'] AS $data)
				{
					/* Resize each image */
					if (!self::resize($options['dir'], $_fName, $fExt, $data['width'], $data['height'], (empty($data['dir']) ? $options['dir'] : $data['dir']), $data['prefix'], (empty($data['cutoff']) ? 0 : 1)))
					{
						/* Set error message */
						$error = $options['errors']['cannot_create_thumbnail'];
						break;
					}
				}

				/* Check if exist error */
				if (false === empty($error)) {
					/* Remove uploaded image */
					@unlink($options['dir'] . $fName);
					break;
				}
			}

			break;
		}

		return array(empty($error) ? $fName : null, $error);
    }

	/**
	 * Resize image file
	 * 
	 * @param $fname
	 * @param $ext
	 * @param $width
	 * @param $height
	 * @param $_x
	 * @param $_y
	 */
	public static function resize($dir, $fname, $ext, $width, $height, $_dir, $prefix, $cutoff = 0, $cropX = '', $cropY = '')
	{
		/* Set new width and new height for resize */
		$newWidth = $width;
		$newHeight = $height;

		/* Check if exist file */
		if (!@is_file($dir . $fname .'.'. $ext)) {
			return false;
		}

		/* image type is GIF and no support */
		if (@imagetypes() & !IMG_GIF && $ext == 'gif') {
			return false;
		}
		/* image type is PNG and no support */
		elseif (@imagetypes() & !IMG_PNG && $ext == 'png') {
			return false;
		}
		/* image type is JPG and no support */
		elseif (@imagetypes() & !IMG_JPEG && ($ext == 'jpg' || $ext == 'jpeg')) {
			return false;
		}

		/* Ger original width and height */
		list($_width, $_height) = @getimagesize($dir . $fname .'.'. $ext);

		/* Check if no crop image */
		if (false !== empty($cropX) && false !== empty($cropY))
		{
			/* Check new width and height is smaller than original */
			if ($width < $_width || $height < $_height)
			{
				/* Set default var */
				$cropLeft = 0;
				$cropTop = 0;

				/* Check if need to change height */
				if ($_width > ($_height * (2 - ($height / $width))))
				{
					/* Set new Height */
					$cutoff ? $newWidth = (($height / $_height) * $_width) : $newHeight = $height = (($width / $_width) * $_height);

					/* Check if need to crop image and set CropTop */
					$cutoff ? $cropLeft = 0 - (($newWidth - $width) / 2) : false;
				}
				/* Check if need to change width */
				else
				{
					/* Set new Width */
					$cutoff ? $newHeight = (($width / $_width) * $_height) : $newWidth = $width = (($height / $_height) * $_width);

					/* Check if need to crop image and set CropLeft */
					$cutoff ? $cropTop = 0 - (($newHeight - $height) / 2) : false;
				}

				/* Set resized variable */
				$resized = true;

				/* Set new resized fondal image */
				if (!$_image = @imagecreatetruecolor($width, $height)) {
					return false;
				}
			}
			else
			{
				/* Set new fondal image */
				if (!$_image = @imagecreatetruecolor($_width, $_height)) {
					return false;
				}
			}
		}
		else {
			/* Set new fondal image */
			if (!$_image = @imagecreatetruecolor($newWidth, $newHeight)) {
				return false;
			}
		}

		/* Check extension and format image fron sourse */
		switch ($ext)
		{
			case 'gif':
				if (!$image = @imagecreatefromgif($dir . $fname . '.' . $ext)) {
					return false;
				}
			break;

			case 'png':
				if (!$image = @imagecreatefrompng($dir . $fname . '.' . $ext)) {
					return false;
				}
			break;

			case 'jpg':
			case 'jpeg':
				if (!$image = @imagecreatefromjpeg($dir . $fname . '.' . $ext)) {
					return false;
				}
			break;
		}

		/* Check if need to crop image, and crop it */
		if (false === empty($cropX) || false === empty($cropY))
		{
			if (!@imagecopyresampled($_image, $image, 0, 0, $cropX, $cropY, $newWidth, $newHeight, $_width, $_height)) {
				return false;
			}
		}
		/* Copy sample image with resized */
		elseif (false === empty($resized))
		{
			if (!@imagecopyresampled($_image, $image, $cropLeft, $cropTop, 0, 0, $newWidth, $newHeight, $_width, $_height)) {
				return false;
			}
		}
		/* Copy sample image from original image */
		else
		{
			if (!@imagecopyresampled($_image, $image, 0, 0, 0, 0, $_width, $_height, $_width, $_height)) {
				return false;
			}
		}

		/* Check extension for save image */
		switch ($ext)
		{
			/* Save new GIF image */
			case 'gif':
				if (!@imagegif($_image, $_dir . $prefix . $fname .'.'. $ext)) {
					return false;
				}
			break;
			
			/* Save new PNG image */
			case 'png':
				if (!@imagepng($_image, $_dir . $prefix . $fname .'.'. $ext)) {
					return false;
				}
			break;
			
			/* Save new JPG | JPEG image */
			case 'jpg':
			case 'jpeg':
				if (!@imagejpeg($_image, $_dir . $prefix . $fname . '.'. $ext)) {
					return false;
				}
			break;
		}

		return true;
	}


	/**
	 * Get image extension
	 * 
	 * @param string $image
	 */
	public static function getExtension($image) {
		return strtolower(end(explode('.', $image)));
	}


	/**
	 * Check if is valid extension
	 * 
	 * @param string $ext
	 * @param array $extensions
	 */
	public static function invalidExtension($ext, $extensions = array()) {
		return in_array($ext, count($extensions) > 0 ? $extensions : array('gif', 'png', 'jpg', 'jpeg')) ? false : true; 
	}

	/**
	 * Generate new image name
	 * 
	 * @param string $path
	 * @param string $ext
	 */
	public static function generateName($path, $ext)
	{
		do {
			$fileName = randomString(32, 0);
		}
		while(@is_file($path . $fileName .'.'. $ext));

		return array($fileName .'.'. $ext, $fileName);
	}
}