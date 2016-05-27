<?php 

trait Session
{

	public function start_session()
	{
		session_start();
	}

	public function open_session($id, $name, $right)
	{
		$_SESSION['id']    = $id;
		$_SESSION['name']  = $name;
		$_SESSION['right'] = $right;
	}

	public function close_session()
	{
		session_unset();
		session_destroy();
	}

	public function has_session()
	{
		return isset($_SESSION['id']);
	}

	public function getid_session()
	{
		return @$_SESSION['id'];
	}

	public function getname_session()
	{
		return @$_SESSION['name'];
	}

	public function getright_session()
	{
		return @$_SESSION['right'];
	}

}

?>