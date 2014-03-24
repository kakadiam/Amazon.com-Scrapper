<?php
class Curl {
	var $con = false;
	function Curl() {
		$this->con = curl_init();
	}
	function close() {
		curl_close($this->con);
	}

	function get($url) {

		$ch = $this->con;

		$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);
		if ($content) {
			return $content;
		} else {
			return false;
		}
	}
	function getError()
	{
		return curl_error($ch);
	}
}