<?php 

require_once(CORE.'Model.php');

class UserModel extends Model
{
	protected $id;
	protected $username;
	protected $password;
	protected $right;
	protected $created;
	protected $modified;

	/**
	 * 
	 */
	public function __construct($id = 0)
	{
        $this->_PK = 'id';
        $this->_Table = 'users';
        $this->_DisplayField = 'username';
        $this->_Uniques = [];
        parent::__construct($id);
	}

	/**
	 * Get id Method
	 * @return
	 */
	public function getid()
	{
	    return $this->id;
	}

	/**
	 * Set id Method
	 * @param Remplacement value
	 */
	public function setid($value)
	{
	    $this->id = $value;
	}

	/**
	 * Get username Method
	 * @return
	 */
	public function getusername()
	{
	    return $this->username;
	}

	/**
	 * Set username Method
	 * @param Remplacement value
	 */
	public function setusername($value)
	{
	    $this->username = $value;
	}

	/**
	 * Get password Method
	 * @return
	 */
	public function getpassword()
	{
	    return $this->password;
	}

	/**
	 * Set password Method
	 * @param Remplacement value
	 */
	public function setpassword($value)
	{
	    $this->password = md5($value);
	}

	/**
	 * Get right Method
	 * @return
	 */
	public function getright()
	{
	    return $this->right;
	}

	/**
	 * Set right Method
	 * @param Remplacement value
	 */
	public function setright($value)
	{
	    $this->right = $value;
	}

	/**
	 * Get created Method
	 * @return
	 */
	public function getcreated()
	{
	    return $this->created;
	}

	/**
	 * Set created Method
	 * @param Remplacement value
	 */
	public function setcreated($value)
	{
	    $this->created = $value;
	}

	/**
	 * Get modified Method
	 * @return
	 */
	public function getmodified()
	{
	    return $this->modified;
	}

	/**
	 * Set modified Method
	 * @param Remplacement value
	 */
	public function setmodified($value)
	{
	    $this->modified = $value;
	}

	/**
	 * @param String username
	 * @param Strig password
	 * @param Boolean 
	 */
	public function login($username, $password)
	{
		$result = $this->select('*', 'users', [
			'username' => $username,
			'password' => md5($password)
		]);
		if (!empty($result))
		{
			$this->set($result[0]);
			$return = true;
		} else
		{
			$return = false;
		}
		return $return;
	}

	/**
	 * 
	 */
	public function search($elements)
	{
		extract($elements);
		$wheres = array();
		// USERNAME CONDITIONS
		if (!empty($username))
		{
			$wheres[] = '`username` LIKE \'%'.$username.'%\'';
		}
		// RIGHT CONDITIONS
		if (!empty($right))
		{
			$wheres[] = '`right` = \''.$right.'\' ';
		}
		// MAKE QUERY
		$query = 'SELECT `id`, `username`, `right` FROM `hotel_users` '
				.'WHERE '.$this->where($wheres).' ORDER BY `username` ASC;';
		return $this->fetch($query);
	}

    public function getLogs()
    {
        return [
            'reservations_logs' => $this->fetch('SELECT * FROM `hotel_reservations_history` WHERE `user` = \''.$this->username.'\';'),
            'orders_logs'       => $this->fetch('SELECT * FROM `hotel_orders_history` WHERE `user` = \''.$this->username.'\';'),
            'lines_logs'        => $this->fetch('SELECT * FROM `hotel_products_orders_history` WHERE `user` = \''.$this->username.'\';')
        ];
    }

}

?>