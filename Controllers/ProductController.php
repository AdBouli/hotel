<?php 

require_once CORE.'Controller.php';

class ProductController extends Controller
{
	public function authorize()
	{
		return [
			'bar' => ['create', 'add',  'modify', 'up', 'del', 'select_product'],
			'*'   => ['index', 'search', 'view']
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
		$this->set(['results' => $this->product->search($elements)]);
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
		$this->product->set($_POST);
		$this->set(['result' => $this->product->add()]);
		$this->render('add');
	}

	/**
	 * 
	 */
	public function modify($id)
	{
		$this->product->get($id);
		$this->set(['datas' => $this->product->toArray()]);
		$this->render('modify');
	}

	/**
	 * 
	 */
	public function up($id)
	{
		$this->setLayout(false);
		$this->product->set($_POST);
		$this->product->setid($id);
		$this->set(['result' => $this->product->up()]);
		$this->render('up');
	}

	/**
	 * 
	 */
	public function view($id)
	{
		if ($this->product->get($id))
		{
			$this->set([
				'datas' => $this->product->toArray(),
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
		$this->product->get($id);
		$this->set(['result' => $this->product->del()]);
		$this->render('del');
	}

	/**
	 * 
	 */
	public function select_product()
	{
		$this->setLayout(false);
		$elements = [
			'name' => @$_POST['name']
		];
		$this->set(['products' => $this->product->search($elements)]);		
		$this->render('select_product');
	}
}

?>