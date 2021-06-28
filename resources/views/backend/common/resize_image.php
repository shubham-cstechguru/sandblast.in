<?php
class ResizeImage {
	public function resize_image($file, $w, $h, $output, $crop=FALSE) {
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    $top = $left = 0;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth 	= $h * $r;
	            $newheight 	= $h;

	            $left 		= ($w - $newwidth) / 2;
	        } else {
	            $newheight = $w/$r;
	            $newwidth  = $w;

	            $top 		= ($h - $newheight) / 2;
	        }
	    }
	    $src = imagecreatefromstring( file_get_contents($file) );
	    $dst = imagecreatetruecolor($w, $h);
	    $whiteBackground = imagecolorallocate($dst, 255, 255, 255); 
		imagefill($dst,0,0,$whiteBackground); // fill the background with white
	    imagecopyresampled($dst, $src, $left, $top, 0, 0, $newwidth, $newheight, $width, $height);

	    imagejpeg($dst, $output);
	}

	public function imagecreatefromfile( $filename ) {
	    if (!file_exists($filename)) {
	        throw new InvalidArgumentException('File "'.$filename.'" not found.');
	    }
	    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
	        case 'jpeg':
	        case 'jpg':
	            return imagecreatefromjpeg($filename);
	        break;

	        case 'png':
	            return imagecreatefrompng($filename);
	        break;

	        case 'gif':
	            return imagecreatefromgif($filename);
	        break;

	        default:
	            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
	        break;
	    }
	}
}