<?php
# Session
/*if(!isset($SESSION_NAME)){
	$SESSION_NAME = "RCD";
}
session_name($SESSION_NAME);*/
session_start();
class session {
	private $login_id;
	private $login_name;
	private $login_filial = 1;
	private $login_tipo;
	private $login_start_time;
	private $login_last_time;
	
	function __construct(){
		$this->login_id = @$_SESSION['LOGIN_ID'];
		$this->login_name = @$_SESSION['LOGIN_NAME'];
		$this->login_tipo = @$_SESSION['PF_USER_TIPO'];
		$this->login_filial = @$_SESSION['LOGIN_FILIAL'];
		$this->login_start_time = @$_SESSION['LOGIN_START_TIME'];
		$this->login_last_time = @$_SESSION['LOGIN_LAST_TIME'];
        $this->loadGetVariable();
	}
    private function loadGetVariable(){
    	global $REPEAT_FROM_GET;
    	if($REPEAT_FROM_GET===true){
    		$refresh = 1;
    	}else{
    		$refresh = 0;
    	}
        if(isset($_GET)){
            if(count($_GET)>0){
                foreach($_GET as $key => $value){
                	$pos = strpos($value, "@");
                	if($pos===false){
                    	$this->setSession($key,$value);
                	}else{
                		$this->setSession($key,substr($value,0,$pos),substr($value, ($pos+1), (strlen($value)-$pos-1)));
                	}
                    if($key=="noRefresh" && $value=="1"){
                    	$refresh = 0;
					}
					if($key=="refresh" && $value=="1"){
                    	$refresh = 2;
                    }
                }
                if($refresh==1){
					$this->refresh();
					exit;
				}
				if($refresh==2){
					$this->refresh();
					exit;
                }
            }
        }
    }
    public function refresh(){
		header("Location: ".$_SERVER['SCRIPT_NAME']);
	}
	public function logOff($returnToPage){
		unset($_SESSION['LOGIN_ID']);
		unset($_SESSION['LOGIN_NAME']);
		unset($_SESSION['SECURITY_CODE']);
		$this->goToPage($returnToPage);
	}
	public function setThisPageAsLogged($code,$returnToPage){
		if(!isset($_SESSION['LOGIN_ID']) || !isset($_SESSION['SECURITY_CODE'])){
			$this->goToPage($returnToPage);
			return false;
		}else{
			if($_SESSION['SECURITY_CODE']!=$code || $this->login_id=="" || $this->login_id==0){
				$this->goToPage($returnToPage);
				return false;
			}else{
				return true;
			}
		}
	}
	public function setSecurityCode($code){
		$_SESSION['SECURITY_CODE'] = $code;
	}
	public function getSecurityCode(){
		if(isset($_SESSION['SECURITY_CODE'])){
			return $_SESSION['SECURITY_CODE'];
		}
	}
	public function setSession($name,$value="",$page=false,$withoutquotation=false){
		if($withoutquotation===false){
			if($page===false || $page==""){
				$_SESSION["'".$name."'"] = $value;
			}else{
				$_SESSION["'".$page."'"]["'".$name."'"] = $value;
			}
		}else{
			if($page===false || $page==""){
				$_SESSION[$name] = $value;
			}else{
				$_SESSION[$page][$name] = $value;
			}
		}
	}
	public function s($name,$value="",$page=true,$withoutquotation=false){
		global $PAGENAME;

		if($page===true){
			$page = $PAGENAME;
		}

		$this->setSession($name,$value,$page,$withoutquotation);
	}
	public function getSession($name,$page=false,$withoutquotation=false){
		if($withoutquotation===false){
			if($page===false || $page==""){
				return @$_SESSION["'".$name."'"];
			}else{
				return @$_SESSION["'".$page."'"]["'".$name."'"];
			}
		}else{
			if($page===false || $page==""){
				return @$_SESSION[$name];
			}else{
				return @$_SESSION[$page][$name];
			}
		}
	}
	public function g($name,$page=true,$withoutquotation=false){
		global $PAGENAME;

		if($page===true){
			$page = $PAGENAME;
		}

		return $this->getSession($name,$page,$withoutquotation);
	}
    public function unSetSession($name,$page=false,$withoutquotation=false){
    	if($withoutquotation===false){
	        if($page===false || $page==""){
				$_SESSION["'".$name."'"] = "";
			}else{
				$_SESSION["'".$page."'"]["'".$name."'"] = "";
			}
    	}else{
    		if($page===false || $page==""){
    			$_SESSION[$name] = "";
    		}else{
    			$_SESSION[$page][$name] = "";
    		}
    	}
    }
	public function u($name,$page=true,$withoutquotation=false){
		global $PAGENAME;

		if($page===true){
			$page = $PAGENAME;
		}

		$this->unSetSession($name,$page,$withoutquotation);
	}
	public function setLoginName($name){
		$this->login_name = $name;
		$_SESSION['LOGIN_NAME'] = $this->login_name;
	}
	public function getLoginName(){
		return $this->login_name;
	}
	public function unSetLoginName(){
		$this->login_name = "";
		$_SESSION['LOGIN_NAME'] = $this->login_name;
	}
	public function setLoginId($id){
		$this->login_id = $id;
		$_SESSION['LOGIN_ID'] = $this->login_id;
	}
	public function getLoginId(){
		global $page;

		if(is_numeric($this->login_id)){
			return $this->login_id;
		}else{
			return $page->profiableDecode($this->login_id);
		}
	}
	public function unSetLoginId(){
		$this->login_id = "";
		$_SESSION['LOGIN_ID'] = $this->login_id;
	}
	public function getLoginTipo(){
		return $this->login_tipo;
	}
	public function setLoginFilial($filial){
		$this->login_filial = $filial;
		$_SESSION['LOGIN_FILIAL'] = $this->login_filial;
	}
	public function getLoginFilial(){
		global $page;

		if(is_numeric($this->login_filial)){
			return $this->login_filial;
		}else{
			return $page->profiableDecode($this->login_filial);
		}
	}
	public function unSetLoginFilial(){
		$this->login_filial = "";
		$_SESSION['LOGIN_FILIAL'] = $this->login_filial;
	}
	public function setLoginTime(){
		$this->login_start_time = time();
		$this->login_last_time = time();
		$_SESSION['LOGIN_START_TIME'] = $this->login_start_time;
		$_SESSION['LOGIN_LAST_TIME'] = $this->login_last_time;
	}
	public function getLoginStartTime(){
		return $this->login_start_time;
	}
	public function getLoginLastTime(){
		return $this->login_last_time;
	}
	public function unSetLoginTime(){
		$this->login_start_time = 0;
		$this->login_last_time = time();
		$_SESSION['LOGIN_START_TIME'] = $this->login_start_time;
		$_SESSION['LOGIN_LAST_TIME'] = $this->login_last_time;
	}
	public function verifyLoginLastTime($interval=600){
		if((time() - $this->login_last_time)>$interval){
			$this->updateLoginLastTime();
			return false;
		}else{
			return true;
		}
	}
	public function updateLoginLastTime(){
		$this->login_last_time = time();
		$_SESSION['LOGIN_LAST_TIME'] = $this->login_last_time;
	}
	public function goToPage($page){
		header("Location: ".$page);
	}
	public function End(){
	}
}