<?

	function encrypt($string){
		$md5Encrpyt = md5($string);
		$sha1Encrpyt = sha1($md5Encrpyt);
		$cryptEncrpyt = crypt($sha1Encrpyt,st);
		return $cryptEncrpyt;
	}

	

?>