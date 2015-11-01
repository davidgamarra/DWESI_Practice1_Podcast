<?php

class Session {
	
	private static $started = false;
	//private $trusted = true;
	
	function __construct($name = null) {
		if(!self::$started){
			if($name !== null){
				session_name($name);
			}
			session_start();
		}
		$started = true;
		$this->_control();
	}
	
	private function _control() {
		$ip = $this->get("_IP");
		$client = $this->get("_CLIENT");
		if($ip === null && $client === null){
			$this->set("_IP", Server::getClientAddress());
			$this->set("_CLIENT", Server::getUserAgent());
		} else {
			if($ip !== Server::getClientAddress() || $client !== Server::getUserAgent()){
				$this->destroy();
			}
		}
	}
	
	function get($param) {
		if(isset($_SESSION[$param])){
			return $_SESSION[$param];
		}
		return null;
	}
	
	function getUser() {
		return $this->get("_user");
	}
	
	function set($param, $value) {
		$_SESSION[$param] = $value;
	}
	
	function setUser($user) {
		$this->set("_user", $user);
	}
	
	function isLogged() {
		return $this->getUser()!==null;
	}
	
	function delete($param) {
		if(isset($_SESSION[$param])){
			unset($_SESSION[$param]);
		}
	}
	
	function destroy() {
		session_destroy();
	}
	
	function sendRedirect($destination = "index.php", $final = true) {
		header("Location: $destination");
		if($final === true){
			exit();
		}
	}
}