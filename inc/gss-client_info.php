<?php

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

    function getOS($userAgent) {

        $osPlatform    =   "Unknown OS Platform";

        $os_array       =   array(
            'windows nt 10.0'    => 'Windows 10',
            'windows nt 6.2'     =>  'Windows 8',
            'windows nt 6.1'     =>  'Windows 7',
            'windows nt 6.0'     =>  'Windows Vista',
            'windows nt 5.2'     =>  'Windows Server 2003/XP x64',
            'windows nt 5.1'     =>  'Windows XP',
            'windows xp'         =>  'Windows XP',
            'windows nt 5.0'     =>  'Windows 2000',
            'windows me'         =>  'Windows ME',
            'win98'              =>  'Windows 98',
            'win95'              =>  'Windows 95',
            'win16'              =>  'Windows 3.11',
            'macintosh|mac os x' =>  'Mac OS X',
            'mac_powerpc'        =>  'Mac OS 9',
            'linux'              =>  'Linux',
            'ubuntu'             =>  'Ubuntu',
            'phone'             =>  'iPhone',
            'pod'               =>  'iPod',
            'pad'               =>  'iPad',
            'android'            =>  'Android',
            'blackberry'         =>  'BlackBerry',
            'webos'              =>  'Mobile'
        );

        foreach ($os_array as $label => $value) {
            if (stripos($userAgent, $label)) {
                return $value;
            }
        }

        return $osPlatform;

    }

    function getBrowser($userAgent) {

        $browser        =   "Unknown Browser";

        $browser_array  =   array(
            'msie'       =>  'Internet Explorer',
            'firefox'    =>  'Firefox',
            'safari'     =>  'Safari',
            'chrome'     =>  'Chrome',
            'opera'      =>  'Opera',
            'netscape'   =>  'Netscape',
            'maxthon'    =>  'Maxthon',
            'konqueror'  =>  'Konqueror',
            'mobile'     =>  'Handheld Browser'
        );

        foreach ($browser_array as $label => $value) {
            if (stripos($userAgent, $label)) {
                return $value;
            }
        }

        return $browser;

    }
    
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
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


?>