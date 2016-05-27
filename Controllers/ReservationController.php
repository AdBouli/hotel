<?php 

require_once CORE.'Controller.php';

class ReservationController extends Controller
{
	public function authorize()
	{
		return [
			'hotel' => ['create', 'add', 'up', 'del'],
			'*'     => ['index', 'search', 'view', 'select_reservation', 'search_for_create_order', 'get_last_order', 'getDateDiff']
		];
	}

	/**
	 * 
	 */
	public function index()
	{
		// Load : room / type model
		$this->loadModel('room');
		$this->loadModel('type');
		$this->set([
			'rooms' => $this->room->listAll(['id', 'num', 'person', 'floor', 'price']),
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
			'account'   => @$_POST['account'],
			'dateStart' => @$_POST['date1'],
			'dateEnd'   => @$_POST['date2'],
			'room_id'   => @$_POST['room'],
			'type_id'   => @$_POST['type'],
			'floor'     => @$_POST['floor'],
			'paid'      => @$_POST['paid']
		];
		$this->set(['results' => $this->reservation->search($elements)]);
		$this->render('search');
	}

	/**
	 * 
	 */
	public function create()
	{
		// Load : account / room / type model
		$this->loadModel('account');
		$this->loadModel('type');
		$this->set([
			'accounts' => $this->account->listAll(['id', 'name', 'firstName', 'address']),
			'types'    => $this->type->listAll(['id', 'name']),
		]);
		$this->render('create');
	}

	/**
	 * 
	 */
	public function add()
	{
		$this->setLayout(false);
		// CALC DATE DIFF
		$dateDiff = $this->getDateDiff($_POST['dateStart'], $_POST['dateEnd']);
		// IF DATES ARE VALID
		if ($dateDiff > 0)
		{
			// IF ACCOUNT ID IS SET
			if (!empty($_POST['account_id']))
			{
				// IF ROOM IS SET
				if (!empty($_POST['room_id']))
				{
					$this->loadModel('room', $_POST['room_id']);
					$total = $dateDiff * $this->room->getprice();
					$datas = [
						'account_id' => $_POST['account_id'],
						'room_id' => $_POST['room_id'],
						'dateStart' => $_POST['dateStart'],
						'dateEnd' => $_POST['dateEnd'],
						'total' => $total,
						'paid' => 0
					];
					$this->reservation->set($datas);
					// ADD RESERVATION
					$this->set(['result' => $this->reservation->add()]);
				} else
				{
					$this->set(['result' => 'selectionnez une chambre']);
				}
			} else
			{
				$this->set(['result' => 'selectionnez un compte']);
			}
		} else
		{
			$this->set(['result' => 'dates invalides']);
		}
		$this->render('add');
	}

	/**
	 * 
	 */
	public function up($case, $id)
	{
		$this->setLayout(false);
		$this->reservation->get($id);
		switch ($case) {
			case 'paid':
				if (!empty($_POST['paid']))
				{
					$this->reservation->setpaid($_POST['paid']);
				} else
				{
					$this->set(['result' => 'paiement invalide']);
				}
				break;
			case 'dates':
				if (!empty($_POST['dateStart']))
				{
					$this->reservation->setdateStart($_POST['dateStart']);
				}
				if (!empty($_POST['dateEnd']))
				{
					$this->reservation->setdateEnd($_POST['dateEnd']);
				}
				$this->reservation->autoSetTotal();
				break;
			case 'room':
				if (!empty($_POST['room_id']))
				{
					$this->reservation->setroom_id($_POST['room_id']);
				} else
				{
					$this->set(['result' => 'chambre invalide']);
				}
				$this->reservation->autoSetTotal();
				break;
		}
		$this->set(['result' => $this->reservation->up()]);
		$this->render('up');
	}


	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->reservation->get($id))
		{
			$this->set([
				'datas'   => $this->reservation->toArray(),
				'account' => $this->reservation->getAccount(),
				'room'    => $this->reservation->getRoom(),
				'orders'  => $this->reservation->getOrders()
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
		$this->reservation->get($id);
		$this->set(['result' => $this->reservation->del()]);		
		$this->render('del');
	}

	public function select_reservation()
	{
		$this->setLayout(false);
		$elements = [
			'account'   => @$_POST['account'],
			'dateStart' => @$_POST['date1'],
			'dateEnd'   => @$_POST['date2'],
			'room_id'   => @$_POST['room'],
			'person'    => @$_POST['person'],
			'floor'     => @$_POST['floor'],
			'type_id'   => @$_POST['type']
		];
		$this->set(['reservations' => $this->reservation->search($elements)]);
		$this->render('select_reservation');
	}

	public function search_for_create_order()
	{
		$this->setLayout(false);
		$elements = [
			'account'   => @$_POST['account'],
			'dateStart' => @$_POST['date1'],
			'dateEnd'   => @$_POST['date2'],
			'room_id'   => @$_POST['room'],
			'floor'     => @$_POST['floor'],
			'type_id'   => @$_POST['type']
		];
		$this->set(['results' => $this->reservation->search($elements)]);
		$this->render('search_for_create_order');
	}

	public function get_last_order($id)
	{
		$this->setLayout(false);
		$this->reservation->get($id);
		echo $this->reservation->getLastOrder()['id'];
	}

	/**
	 * @param String date
	 * @param String date
	 * @return float difference between two date
	 */
	public function getDateDiff($d1, $d2)
	{
		$tmp = new DateTime($d1);
		return floatval($tmp->diff(new DateTime($d2))->format('%R%a'));
	}

}

?>