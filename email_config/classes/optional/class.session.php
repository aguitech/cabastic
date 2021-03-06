<?php
class _Session
{
	function _Session ()
	{
	   //return session_start();
	}

	function register($var,$value)
	{
	  $_SESSION[$var]=$value;  
	}

	function unregister($var)
	{
		return session_unregister($var);
	}

	function is_set($var)
	{
		return(session_is_registered($var));
	}

	function get($var)
	{
		if ($this->is_set($var))
			$this->$var=$_SESSION[$var];
		else
			$this->$var=null;
		
		return($this->$var);
	}

	function id()
	{
	    return(session_id());
	}

	function finish()
	{
		session_destroy();
		$_COOKIE=array();
	}

}
?>