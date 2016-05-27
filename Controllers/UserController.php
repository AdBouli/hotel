<?php 

require_once CORE.'Controller.php';

class UserController extends Controller
{
	public function authorize()
	{
		return [
			'*'  => ['home', 'login', 'logout']
		];
	}

	/**
	 * 
	 */
	public function index()
	{
		$this->render('index');
	}

	/**
	 * 
	 */
	public function search()
	{
		$this->_Layout = false;
		$elements = [
			'username' => @$_POST['username'],
			'right' => @$_POST['right']
		];
		$this->set(['results' => $this->user->search($elements)]);
		$this->render('search');		
	}

	/**
	 * 
	 */
	public function create()
	{
		$this->render('create');
	}

	/**
	 * 
	 */
	public function add()
	{
		$this->setLayout(false);
		$this->user->set($_POST);
		$this->set(['result' => $this->user->add()]);
		$this->render('add');
	}

	/**
	 * 
	 */
	public function modify($id)
	{
		$this->user->get($id);
		$this->set(['datas' => $this->user->toArray()]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->user->set($_POST);
		$this->user->setid($id);
		$this->set(['result' => $this->user->up()]);
		$this->render('up');
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->user->get($id))
		{
			$this->set([
				'datas' => $this->user->toArray()
			]);
		}
		$this->render('view');
	}

	/**
	 * 
	 */
	public function del($id)
	{
		$this->setLayout(false);
		$this->user->get($id);
		$this->set(['result' => $this->user->del()]);
		$this->render('del');
	}

	/**
	 * 
	 */
	public function login()
	{
		$this->_Layout = false;
		if ($this->user->login($_POST['username'], $_POST['password']))
		{
			$this->open_session($this->user->getid(), $this->user->getusername(), $this->user->getright());
			echo 'success';
		} else
		{
			echo 'error';
		}
	}

	/**
	 *
	 */
	public function logout()
	{
		$this->_Layout = false;
		$this->close_session();
	}

	/**
	 * 
	 */
	public function upPassword($id)
	{
		$this->setLayout(false);
		if ($_POST['password'] == $_POST['confirm'])
		{
			$this->user->get($id);
			$this->user->setPassword($_POST['password']);
			$this->set(['result' => $this->user->up()]);
		} else
		{
			$this->set(['result' => 'Les mots de passes ne correspondent pas.']);
		}
		$this->render('upPassword');
	}

	/**
	 * 
	 */
	public function select_user()
	{
		$this->setLayout(false);
		$elements = [
			'username' => @$_POST['username']
		];
		$this->set(['users' => $this->user->search($elements)]);		
		$this->render('select_user');
	}
}

?>