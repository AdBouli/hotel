<?php 

require_once ADDN.'Request.php';
require_once ADDN.'Session.php';

class Model
{
	use Request;
	use Session;

	protected $_PK; // String
	protected $_Table; // String
	protected $_DisplayField; // String
	protected $_Uniques; // Array
	protected $_ArraySis; // Array

	/**
	 * @param Integer Id
	 */
	public function __construct($id)
	{
		$this->_ArraySis = ['_PK', '_Table', '_DisplayField', '_Uniques', '_ArraySis', 'PDO'];
		// Init property
		foreach ($this as $key => $value) {
			if (!in_array($key, $this->_ArraySis))
			{
				$this->$key = '';
			}
		}
		$this->connect(_Username_, _Password_, _Database_);
	    if ($id != 0)
	    {
	        $this->get($id);
	    }
	}

	/**
	 * 
	 */
	public function __destruct()
	{
		$this->disconnect();
	}

	/**
	 * Select all rows 
	 * @param Array Columns name
	 * @return Array
	 */
	public function listAll($columns = '*')
	{
		return $this->select($columns, $this->_Table);
	}

	/**
	 * Select row and set current object
	 * @return Boolean
	 */
	public function get($id)
	{
		$row = $this->select('*', $this->_Table, [$this->_PK.' = '.$id]);
		if (empty($row))
		{
			$return = false;
		} else
		{
			// Settings
			foreach ($row[0] as $key => $value)
			{
				$setter = 'set'.$key;
				$this->$setter($value);
			}
			$return = true;
		}
		return $return;
	}

	/**
	 * Set current object with Datas
	 * @param Array Datas [property] => value
	 */
	public function set($datas)
	{
		foreach ($datas as $key => $value) {
			$setter = 'set'.$key;
			$this->$setter($value);
		}
	}

	/**
	 * Check unique field and insert.
	 * @return String Message
	 */
	public function add()
	{
		// Check unique field
		foreach ($this->_Uniques as $field) {
			$test = $this->select('*', $this->_Table , [$field => $this->$field]);
			if (count($test) >= 1)
			{
				$return = $this->$field;
			}
		}
		if (!isset($return))
		{
			// Datas to save
			$datas = array();
			foreach ($this as $key => $value) {
				if (!in_array($key, $this->_ArraySis) && !empty($value))
				{
					$datas[$key] = $value;
				}
			}
			// Up created/modified date and current user
			$date = date('Y-m-d H:i:s');
			if (property_exists($this, 'created'))
			{
				$datas['created'] = $date;
			}
			if (property_exists($this, 'modified'))
			{
				$datas['modified'] = $date;
			}
			if (property_exists($this, 'user_id'))
			{
				$datas['user_id'] = $this->getid_session();
			}
			// Insert
			$return = $this->insert($this->_Table, $datas);
		}
		return $return;
	}

	/**
	 * Check changes field, check unique field and update.
	 * @return String Message
	 */
	public function up()
	{
		$pk = $this->_PK;
		$old = $this->select('*', $this->_Table, [$pk.' = '.$this->$pk]);
		if (empty($old))
		{
			$return = 'Data not found';
		} else
		{
			$changes = array();
			// Recover changes in $changes
			foreach ($old[0] as $key => $value) {
				if ($this->$key != $value)
				{
					$changes[$key] = $this->$key;
				}
			}
			// Check unique fields
			foreach ($this->_Uniques as $field) {
				// If the unique field is part of changes
				if (array_key_exists($field, $changes))
				{
					$test = $this->select('*', $this->_Table, [$field => $this->$field]);
					if (count($test) >= 1)
					{
						$return = $this->$field;
					}
				}
			}
			if (empty($changes))
			{
				$return = 'No changement';
			}
			if (!isset($return))
			{
				// Up modified date and current user
				if (property_exists($this, 'modified'))
				{
					$datas['modified'] = date('Y-m-d H:i:s');
				}
				if (property_exists($this, 'user_id'))
				{
					$datas['user_id'] = $this->getid_session();
				}
				// Update
				$return = $this->update($this->_Table, $changes, [$pk.' = '.$this->$pk]);
			}
		}
		return $return;
	}

	/**
	 * Delete.
	 * @return String Message
	 */
	public function del()
	{
		$pk = $this->_PK;
		return $this->delete($this->_Table, [$pk.' = '.$this->$pk]);
	}

	/**
	 * Convert object to array without system properties
	 * @return Array
	 */
	public function toArray()
	{
		$datas = array();
		foreach ($this as $key => $value) {
			if (!in_array($key, $this->_ArraySis))
			{
				$datas[$key] = $value;
			}
		}
		return $datas;
	}

	/**
	 * @param String Name of model
	 * @return Object model instantiated
	 */
	public function loadModel($name, $id = 0)
	{
		$model = ucfirst($name).'Model';
		require_once MODL.$model.'.php';
		return new $model($id);
	}
	
}

?>
