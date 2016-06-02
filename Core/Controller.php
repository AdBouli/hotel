<?php 
require_once CORE.'functions.php';

require_once ADDN.'Session.php';
require_once ADDN.'Access.php';

class Controller
{
	use Session;
	use Access;

	protected $_Vars;
	protected $_Views;
	protected $_Layout;

	/**
	 * Construct
	 */
	public function __construct()
	{
		$this->_Vars = array();
		$this->_Views = ucfirst(strtolower(str_replace('Controller', '', get_class($this))));
		$this->_Layout = 'default';
	}

	/**
	 * @param String function name
	 * @param Array of parameter 
	 */
	public function start($function, $params)
	{
		$this->start_session();
		if ($this->has_session() || $function == 'login'){
			if (method_exists($this, $function))
			{
				$this->checkAccess($function);
				if ($this->isAuthorize() || $function == 'login')
				{
					$this->run($function, $params);
				} else
				{
					$this->setViews('error');
					$this->render('right');
				}
			} else
			{
				$this->setViews('error');
				$this->render('404');
			}
		} else
		{
			$this->setViews('home');
			$this->setLayout('home');
			$this->render('home');
		}
	}

	/**
	 * @param String function name
	 * @param Array parameters [0] controller name [1] function to call [2..] agruments	 * 
	 */
	public function run($function, $params)
	{
		$this->loadModel(strtolower(str_replace('Controller', '', get_class($this))));
		call_user_func_array([$this, $function], $params);
	}

	/**
	 * Set the Views directory
	 * @param String Views name
	 */
	public function setViews($name)
	{
		$this->_Views = $name;
	}

	/**
	 * Set the layout
	 * @param String Layout name
	 */
	public function setLayout($name)
	{
		$this->_Layout = $name;
	}

	/**
	 * @param Array Data [var_name] => value
	 */
	public function set($data)
	{
		$this->_Vars = array_merge($this->_Vars, $data);
	}

	/**
	 * @param String Name of model
	 * @param Integer Id to load
	 * @param String Var name to save the model [optional]
	 */
	public function loadModel($name, $id = 0, $propertyName = null)
	{
		if ($propertyName === null)
		{
			$propertyName = $name;
		}
		$model = ucfirst($name).'Model';
		if (file_exists(MODL.$model.'.php'))
		{
			require_once MODL.$model.'.php';
			$this->$propertyName = new $model($id);
		}
	}

	/**
	 * @param String Filename of view (without path and extension)
	 */
	public function render($filename)
	{
		$path_view = VIEW.ucfirst($this->_Views).'/'.$filename.'.php';
		if (file_exists($path_view))
		{
			extract($this->_Vars);
			ob_start();
			require_once $path_view;
			$content_for_layout = ob_get_clean();
			if($this->_Layout == false)
			{
				echo $content_for_layout;
			} else 
			{
				$path_layout = VIEW.'Layout/'. strtolower($this->_Layout).'.php';
				if (file_exists($path_layout))
				{
					require_once $path_layout;
				} else
				{
					echo '<strong>Layout "'. $this->_Layout .'" introuvable!</strong>';
				}
			}
		} else
		{
			echo '<strong>Vue "'. strtolower($filename) .'" introuvable!</strong>';
		}
	}

}

?>