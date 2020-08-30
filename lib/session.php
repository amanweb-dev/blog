<?php 

/**
 * session class
 */
class Session{
	
	public static function init(){
		session_start();
	}
	public static function set($key,$value){
		$_SESSION[$key] = $value;
	}

	public static function get($key){
		if(isset($_SESSION[$key])){
			return $_SESSION[$key];
		}else{
			return false;
		}
	}

	public static function check_session(){

		self::init();
		if (self::get("login")==false) {
			self::destroy();
			header("Location:login.php");
			
		}
	}

	public static function check_login(){

		self::init();
		if (self::get("login")==true) {
			header("Location:index.php");
			
		}
	}
	public static function destroy(){

		session_destroy();
		header("Location:login.php");
	}

}

 ?>