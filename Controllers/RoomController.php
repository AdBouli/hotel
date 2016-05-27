<?php 

require_once CORE.'Controller.php';

class RoomController extends Controller
{
	public function authorize()
	{
		return [
			'hotel' => ['create', 'add', 'modify', 'up', 'del', 'select_free_room'],
			'*'     => ['index', 'search', 'view', 'select_room']
		];
	}

	/**
	 * 
	 */
	public function index()
	{
		// Load : type model
		$this->loadModel('type');
		$this->set([
			'types' => $this->type->listAll(['id', 'name'])
		]);
		$this->render('index');
	}

	/**
	 * 
	 */
	public function search()
	{
		$this->_Layout = false;
		$elements = [
			'num' => @$_POST['num'],
			'floor' => @$_POST['floor'],
			'person' => @$_POST['person'],
			'type_id' => @$_POST['type']
		];
		$this->set(['results' => $this->room->search($elements)]);
		$this->render('search');
	}

	/**
	 * 
	 */
	public function create()
	{
		$this->set(['types' => $this->room->select(['id', 'name'], 'types')]);
		$this->render('create');
	}

	/**
	 * 
	 */
	public function add()
	{
		$this->setLayout(false);
		$this->room->set($_POST);
		$this->set(['result' => $this->room->add()]);
		$this->render('add');
	}

	/**
	 * 
	 */
	public function modify($id)
	{
		$this->room->get($id);
		$this->set([
			'datas' => $this->room->toArray(),
			'types' => $this->room->select(['id', 'name'], 'types')
		]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->room->set($_POST);
		$this->room->setid($id);
		$this->set(['result' => $this->room->up()]);
		$this->render('up');
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->room->get($id))
		{
			$this->set([
				'datas' => $this->room->toArray(),
				'type'  => $this->room->gettypename(),
				'reservations' => $this->room->getReservations()
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
		$this->room->get($id);
		$this->set(['result' => $this->room->del()]);
		$this->render('del');
	}

	public function select_free_room()
	{
		$this->_Layout = false;
		// Load : type model
		$this->loadModel('type');
		$this->set([
			'types'      => $this->type->listAll(['id', 'name']),
			// Search avaible rooms
			'free_rooms' => $this->room->getFreeRooms($_POST['date1'], $_POST['date2'], @$_POST['person'], @$_POST['type'], @$_POST['floor'])
		]);
		$this->render('select_free_room');
	}

	public function select_room()
	{
		$this->_Layout = false;
		$elements = array();
		if (@$_POST['floor'] > 0)
		{
			$elements['floor'] = $_POST['floor'];
		}
		if (@$_POST['person'] > 0)
		{
			$elements['person'] = $_POST['person'];
		}
		if (@$_POST['type'] > 0)
		{
			$elements['type_id'] = $_POST['type'];
		}
		$this->set(['rooms' => $this->room->search($elements)]);
		$this->render('select_room');
	}

}

?>