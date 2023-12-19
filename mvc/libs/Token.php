<?php

class  Token {
	
	
	
	function kodolustur() {			
		Session::init();
	//	return md5(sha1(md5(mt_rand(0,99999999))));
		
		$token=md5(sha1(base64_encode(gzdeflate(gzcompress(serialize(mt_rand(0,99999999)))))));		
		Session::set("token",$token);
		return $token;
	}
	

	
}




?>