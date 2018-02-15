<?php
//$originalImagePath = "../images/blog/default.jpg";'
//$newImageName = "new.jpg";
//$newImagePath = "../images/";

//#################################################################
// CROP IMAGE ACCORDING TO ASPECT RATIO
//#################################################################
function resizeImageAspectRatio($originalImagePath, $newImageName, $newImagePath){
	$original_image = imagecreatefromjpeg($imagePath);
	
	$original_image_width  = imagesx($original_image);
	$original_image_height = imagesy($original_image);
	$new_image_max_width = 170;
	$new_image_max_height = 170;
	
	$original_image_aspect_ratio = $original_image_width / $original_image_height;
	
	$profile_aspect_ratio = $new_image_max_width / $new_image_max_height;
	
	if ($original_image_width <= $new_image_max_width && $original_image_height <= $new_image_max_height) {
		$profile_image_width = $original_image_width;
		$profile_image_height = $original_image_height;
		
	} elseif ($profile_aspect_ratio > $original_image_aspect_ratio) {
		$profile_image_width = (int) ($new_image_max_height * $original_image_aspect_ratio);
		$profile_image_height = $new_image_max_height;
		
	} else {
		$profile_image_width = $new_image_max_width;
		$profile_image_height = (int) ($new_image_max_width / $original_image_aspect_ratio);
	}
	
	$new_image = imagecreatetruecolor($profile_image_width, $profile_image_height);
	imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $profile_image_width, $profile_image_height, $original_image_width, $original_image_height);
	imagejpeg($new_image, $newImagePath.$newImageName);
	imagedestroy($new_image);
}
?>