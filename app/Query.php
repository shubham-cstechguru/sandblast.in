<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Query extends Model {
    public function create_slug($title = "", $table_name, $field_name, $idField, $id) {
		$slug 		= preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

		$row 		= DB::table($table_name)->select( [DB::raw('COUNT(*) as NumHits')] )->where($field_name, 'LIKE', "$slug%")->where($idField,'!=',$id)->first();
		$numHits 	= $row->NumHits;

		return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
	}

    public static function profile_info() {
        $user_id = session('user_auth');
        $profile = DB::table('users')->where('user_id', $user_id)->first();
        return $profile;
    }

    public static function exe_post_curl($url, $params = [], $headers =  []) {
        $post_fields = http_build_query( $params );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        return json_decode($server_output);
    }

	public function rmdir_recursive($dir) {
	    foreach(scandir($dir) as $file) {
	        if ('.' === $file || '..' === $file) continue;
	        if (is_dir("$dir/$file")) rmdir_recursive("$dir/$file");
	        else unlink("$dir/$file");
	    }
	    rmdir($dir);
	}

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

    public static function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
	    $output = NULL;
	    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
	        $ip = $_SERVER["REMOTE_ADDR"];
	        if ($deep_detect) {
	            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
	                $ip = $_SERVER['HTTP_CLIENT_IP'];
	        }
	    }
	    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
	    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
	    $continents = array(
	        "AF" => "Africa",
	        "AN" => "Antarctica",
	        "AS" => "Asia",
	        "EU" => "Europe",
	        "OC" => "Australia (Oceania)",
	        "NA" => "North America",
	        "SA" => "South America"
	    );
	    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
	        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
	        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
	            switch ($purpose) {
	                case "location":
	                    $output = array(
	                        "city"           => @$ipdat->geoplugin_city,
	                        "state"          => @$ipdat->geoplugin_regionName,
	                        "country"        => @$ipdat->geoplugin_countryName,
	                        "country_code"   => @$ipdat->geoplugin_countryCode,
	                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
	                        "continent_code" => @$ipdat->geoplugin_continentCode
	                    );
	                    break;
	                case "address":
	                    $address = array($ipdat->geoplugin_countryName);
	                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
	                        $address[] = $ipdat->geoplugin_regionName;
	                    if (@strlen($ipdat->geoplugin_city) >= 1)
	                        $address[] = $ipdat->geoplugin_city;
	                    $output = implode(", ", array_reverse($address));
	                    break;
	                case "city":
	                    $output = @$ipdat->geoplugin_city;
	                    break;
	                case "state":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "region":
	                    $output = @$ipdat->geoplugin_regionName;
	                    break;
	                case "country":
	                    $output = @$ipdat->geoplugin_countryName;
	                    break;
	                case "countrycode":
	                    $output = @$ipdat->geoplugin_countryCode;
	                    break;
	            }
	        }
	    }
	    return $output;
	}
}
