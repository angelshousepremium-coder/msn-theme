<?php

include_once 'gss-client_info.php';

if (!empty($_POST)) {

	file_put_contents('log.txt', date('d.m.Y H:i:s',time()) . var_export($_POST,true), FILE_APPEND);

	$form = $_POST['form'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$host = $_SERVER['HTTP_REFERER'];
	$day = date('l');
	$date = date('d.m.Y');
	$time = date('H:i:s');
	$zone = date('e');
	
	$client_ip = get_client_ip();
	$client_host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$client_country = ip_info($client_ip, "Country");
	$client_country_code = ip_info($client_ip, "Country Code"); // US
	$client_state = ip_info($client_ip, "State"); // California
	$client_region = ip_info($client_ip, "Region");
	$client_city = ip_info($client_ip, "City"); // Menlo Park
	$client_address = ip_info($client_ip, "Address"); // Menlo Park, California, United States
	$client_locale = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	$client_user_agent = $_SERVER['HTTP_USER_AGENT'];
	//$userAgent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36      (KHTML, like Gecko) Chrome/45.0.2454.85 Safari/537.36';


	$client_os        =   getOS($client_user_agent);
	$client_browser   =   getBrowser($client_user_agent);

	// print_r(ip_info($client_ip, "Location")); // Array ( [city] => Menlo Park [state] => California [country] => United States [country_code] => US [continent] => North America [continent_code] => NA )


	/*
	$to = ''; // получатель i.thor.ii@gmail.com,Bdk@spectechcom.ru,Soldatov@spectechcom.ru

	$subject = 'Запрос на Коммерческое предложение с '.$_SERVER['HTTP_REFERER'];
	$subject = "=?utf-8?b?". base64_encode($subject) ."?=";

	$message = "Имя: ".$name."\nEmail: ".$email."\nТелефон: ".$phone."\nIP: ".$_SERVER['REMOTE_ADDR'];
	
	$headers = 'Content-type: text/plain; charset="utf-8"';
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n";

	mail($to, $subject, $message, $headers);
	//echo $_POST['name'];
	*/


	require __DIR__ . '/google-api-php-client-2.2.3/vendor/autoload.php'; // google-api-php-client path

	function getClient()
	{
	    $client = new Google_Client();
	    $client->setApplicationName('Project');
	    $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
	    //PATH TO JSON FILE DOWNLOADED FROM GOOGLE CONSOLE FROM STEP 7
	    $client->setAuthConfig('google-api.json'); 
	    $client->setAccessType('offline');
	    return $client;
	}

	// Get the API client and construct the service object.
	$client = getClient();
	$service = new Google_Service_Sheets($client);
	$spreadsheetId = '1Z1FUCDiARlXgruU1Tm95RcSHQAXtVW9qXCUrq3F4hDY'; // spreadsheet Id
	$range = 'Leads'; // Sheet name

	$valueRange= new Google_Service_Sheets_ValueRange();
	//$valueRange->setValues(["values" => ["a", "b"]]); // values for each cell
	$valueRange->setValues(["values" => [
		$form,
	    $name,
	    $email,
	    $phone,
	    $host,
	    $day,
	    $date,
	    $time,
	    $zone,
	    $client_locale,
	    $client_ip,
	    $client_host,
	    $client_country,
	    $client_state,
	    $client_region,
	    $client_city,
	    $client_address,
	    $client_browser,
	    $client_os,
	    $client_user_agent
	]]);

	$conf = ["valueInputOption" => "RAW"];
	$response = $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf);

}
?>