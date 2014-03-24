<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Amazon Image Scrapping</title>
</head>
<body>
  <h1>Amazon Image Scrapping</h1>
<?php
$form = '<table align="center" width="900px" border="1" cellspacing="2" cellpadding="8"><tr align="center"><td>
<form method="POST" action="index.php">
<label>ISBN</label><br>
<input type=text name="isbn" size=60 /><br><br>

<center><input type=submit name="Submit" value="GET IMG" /></center>
</form>
</td></tr></table>';

if(!isset($_POST['Submit'])){
	echo $form;
}else {
	$isbn = $_POST['isbn'];
	$link = 'http://www.amazon.com/s/ref=nb_sb_noss?url=search-alias%3Dstripbooks&field-keywords='.$isbn;
	function curl($url){
		include_once ('curl.php');
		$curl = new Curl();
		$link = $curl->get($url);
		return $link;
	}
	$link = (curl($link));
	$newlines = array("  ","\t","\n","\0","\x0B");
	$link = str_replace($newlines, "", $link);
	$start = strpos($link,'<img onload=');
	$end = strpos($link,'<div class="starsAndPrime">',$start);
	$FinalLink = substr($link,$start,$end-$start);
	preg_match('/http:(.*?).jpg/s',$FinalLink,$imglink);	
	echo '<h3>ISBN: '.$isbn.'</h3>';
	echo '<h4>IMG-Link: <img src="'.$imglink[0].'"/></h4>';	
	}
?>
</body>
</html>
