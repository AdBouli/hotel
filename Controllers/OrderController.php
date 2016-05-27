<?php 

require_once CORE.'Controller.php';

class OrderController extends Controller
{
	public function authorize()
	{
		return [
			'bar' => ['create', 'add', 'modify', 'up', 'up_resume', 'get_total', 'del'],
			'*'   => ['index', 'search', 'view']
		];
	}

	/**
	 * 
	 */
	public function index()
	{
		// Load : type / room / reservation model
		$this->loadModel('type');
		$this->loadModel('room');
		$this->loadModel('reservation');
		$this->set([
			'types'        => $this->type->listAll(['id', 'name']),
			'rooms'        => $this->room->listAll(['id', 'num', 'person', 'floor', 'price']),
			'reservations' => $this->reservation->listAll(['id', 'date', 'total']),
		]);
		$this->render('index');
	}

	public function search()
	{
		$this->_Layout = false;
		$elements = [
			'reservation_id' => @$_POST['reservation'],
			'account'        => @$_POST['account'],
			'paid'           => @$_POST['paid']
		];
		$this->set(['results' => $this->order->search($elements)]);
		$this->render('search');		
	}

	/**
	 * @param Integer reservation id
	 */
	public function create($id = 0)
	{
		if ($id == 0)
		{
			$this->loadModel('room');
			$this->loadModel('type');
			$this->set([
				'rooms' => $this->room->listAll(['id', 'num', 'person', 'floor', 'price']),
				'types' => $this->type->listAll(['id', 'name'])
			]);
			$this->render('pick_reservation');
		} else
		{
			$this->loadModel('reservation', $id);
			$this->set([
				'reservation' => $this->reservation->toArray(),
				'account'     => $this->reservation->getAccount(),
				'room'        => $this->reservation->getRoom(),
			]);
			$this->render('create');
		}
	}

	/**
	 * 
	 */
	public function add()
	{
		$this->setLayout(false);
		$this->order->set($_POST);
		$this->order->settotal(0);
		$this->order->setpaid(0);
		$result = $this->order->add();
		if ($result === true)
		{
			echo 'success';
		} else
		{
			$this->set(['result' => $result]);
			$this->render('add');
		}

	}

	/**
	 * @param Integer order id
	 */
	public function modify($id)
	{
		$this->order->get($id);
		$this->loadModel('reservation', $this->order->getreservation_id());
		$this->set([
			'datas'       => $this->order->toArray(),
			'reservation' => $this->reservation->toArray(),
			'account'     => $this->reservation->getAccount(),
			'room'        => $this->reservation->getRoom(),
			'lines'       => $this->order->getProductsOrders()
		]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->order->get($id);
		if ($_POST['paid'] == 'true')
		{
			$this->order->setpaid(1);
			$result = $this->order->up();
			if ($result == true)
			{
				echo 'paid';
			} else
			{
				$this->set(['result' => $this->order->up()]);
				$this->render('up');
			}
		} else
		{
			$this->set(['result' => $this->order->up()]);
			$this->render('up');
		}
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->order->get($id))
		{
			$this->loadModel('reservation', $this->order->getreservation_id());
			$this->set([
				'datas'       => $this->order->toArray(),
				'reservation' => $this->reservation->toArray(),
				'account'     => $this->reservation->getAccount(),
				'room'        => $this->reservation->getRoom(),
				'lines'       => $this->order->getResume()
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
		$this->order->get($id);
		$this->set(['result' => $this->order->del()]);
		$this->render('del');
	}

	/**
	 * @param Integer order id
	 */
	public function up_resume($id)
	{
		$this->setLayout(false);
		$this->order->get($id);
		$this->set(['lines' => $this->order->getResume()]);
		$this->render('resume');
	}

	/**
	 * @param Integer order id
	 */
	public function get_total($id)
	{
		$this->setLayout(false);
		$this->order->get($id);
		echo $this->order->gettotal();
	}
}

?>