<?php 

require_once CORE.'Controller.php';

class LogController extends Controller
{
	public function index()
	{
		$this->loadModel('type');
		$this->set([
			'types' => $this->type->listAll(['id', 'name'])
		]);
		$this->render('index');
	}

	public function search()
	{
		
	}

	public function reservation($id)
	{
		$this->loadModel('reservation', $id);
		$this->set(['logs' => $this->reservation->getLogs()]);
		$this->render('reservation');
	}

	public function order($id)
	{
		$this->loadModel('order', $id);
		$this->set(['logs' => $this->order->getLogs()]);
		$this->render('order');
	}

	public function account($id)
	{
		$this->loadModel('account', $id);
		$this->set(['logs' => $this->account->getLogs()]);
		$this->render('account');
	}

	public function room($id)
	{
		$this->loadModel('room', $id);
		$this->set(['logs' => $this->room->getLogs()]);
		$this->render('room');		
	}

	public function user($id)
	{
		$this->loadModel('user', $id);
		$this->set(['logs' => $this->user->getLogs()]);
		$this->render('user');
	}

}