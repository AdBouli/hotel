<?php 

require_once CORE.'Controller.php';

class TypeController extends Controller
{
	public function authorize()
	{
		return [
			'hotel' => ['create', 'add', 'modify', 'up', 'del'],
			'*'     => ['index', 'search', 'view']
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
			'name' => @$_POST['name']
		];
		$this->set(['results' => $this->type->search($elements)]);
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
		$this->type->set($_POST);
		$this->set(['result' => $this->type->add()]);
		$this->render('add');
	}

	/**
	 * 
	 */
	public function modify($id)
	{
		$this->type->get($id);
		$this->set(['datas' => $this->type->toArray()]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->type->set($_POST);
		$this->type->setid($id);
		$this->set(['result' => $this->type->up()]);
		$this->render('up');
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->type->get($id))
		{
			$this->set([
				'datas' => $this->type->toArray(),
				'rooms' => $this->type->getRooms()
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
		$this->type->get($id);
		$this->set(['result' => $this->type->del()]);
		$this->render('del');
	}
}

?>