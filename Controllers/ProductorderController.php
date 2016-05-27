<?php 

require_once CORE.'Controller.php';

class ProductorderController extends Controller
{
	public function authorize()
	{
		return [
			'bar' => ['add', 'del']
		];
	}

	/**
	 * 
	 */
	public function add()
	{
		$this->setLayout(false);
		$this->loadModel('order', $_POST['order_id']);
		$lines = $this->order->getProductsorders();
		foreach ($lines as $productorder)
		{
			if ($productorder['product_id'] == $_POST['product_id'])
			{
				$lineExist = $productorder['id'];
			}
		}
		if (isset($lineExist))
		{
			$this->productorder->get($lineExist);
			$this->productorder->setquantity($this->productorder->getquantity()+$_POST['quantity']);
			$this->productorder->settotal(floatval($this->productorder->getproduct()['price']) * intval($this->productorder->getquantity()));
			if ($this->productorder->up())
			{
				echo 'up';
			} else
			{
				echo 'error';
			}
		} else
		{
			$this->productorder->set($_POST);
			$this->productorder->settotal(floatval($this->productorder->getproduct()['price']) * intval($_POST['quantity']));
			if ($this->productorder->add())
			{
				echo 'add';
			} else
			{
				echo 'error';
			}
		}
	}

	/**
	 * 
	 */
	public function del($id)
	{		
		$this->productorder->get($id);
		$this->productorder->del();
	}
}

?>