<?php 

require_once CORE.'Controller.php';

class AccountController extends Controller
{
	public function authorize()
	{
		return [
			'hotel' => ['create', 'add',  'modify', 'up', 'del'],
			'*'     => ['index', 'search', 'view', 'select_account']
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
			'names'   => @$_POST['name'],
			'address' => @$_POST['address'],
			'phone'   => @$_POST['phone'],
			'mail'    => @$_POST['mail']
		];
		$this->set(['results' => $this->account->search($elements)]);
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
		$this->account->set($_POST);
		$this->set(['result' => $this->account->add()]);
		$this->render('add');
	}

	/**
	 * 
	 */
	public function modify($id)
	{
		$this->account->get($id);
		$this->set(['datas' => $this->account->toArray()]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->account->set($_POST);
		$this->account->setid($id);
		$this->set(['result' => $this->account->up()]);
		$this->render('up');
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->account->get($id))
		{
			$this->set([
				'datas' => $this->account->toArray(),
				'reservations' => $this->account->getReservations()
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
		$this->account->get($id);
		$this->set(['result' => $this->account->del()]);
		$this->render('del');
	}

	/**
	 * 
	 */
	public function select_account()
	{
		$this->setLayout(false);
		$elements = [
			'names'   => @$_POST['names'],
			'address' => @$_POST['address'],
			'phone'   => @$_POST['phone'],
			'mail'    => @$_POST['mail']
		];
		$this->set(['accounts' => $this->account->search($elements)]);
		$this->render('select_account');
	}

}

?>