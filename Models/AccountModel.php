<?php

require_once CORE.'Model.php';

class AccountModel extends Model
{

    protected $id;
    protected $name;
    protected $firstName;
    protected $address;
    protected $phone;
    protected $mail;
    protected $created;
    protected $modified;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'accounts';
        $this->_DisplayField = 'name';
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
     * Get name Method
     * @return
     */
    public function getname()
    {
        return $this->name;
    }
    
    /**
     * Set name Method
     * @param Remplacement value
     */
    public function setname($value)
    {
        $this->name = $value;
    }

    /**
     * Get firstName Method
     * @return
     */
    public function getfirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Set firstName Method
     * @param Remplacement value
     */
    public function setfirstName($value)
    {
        $this->firstName = $value;
    }

    /**
     * Get address Method
     * @return
     */
    public function getaddress()
    {
        return $this->address;
    }
    
    /**
     * Set address Method
     * @param Remplacement value
     */
    public function setaddress($value)
    {
        $this->address = $value;
    }

    /**
     * Get phone Method
     * @return
     */
    public function getphone()
    {
        return $this->phone;
    }
    
    /**
     * Set phone Method
     * @param Remplacement value
     */
    public function setphone($value)
    {
        $this->phone = $value;
    }

    /**
     * Get mail Method
     * @return
     */
    public function getmail()
    {
        return $this->mail;
    }
    
    /**
     * Set mail Method
     * @param Remplacement value
     */
    public function setmail($value)
    {
        $this->mail = $value;
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
     * @return Array
     */
    public function getReservations()
    {
        return $this->select('*', 'reservations', ['account_id' => $this->id]);
    }

    /**
     * @param Array elements to search
     * @return Array results
     */
    public function search($elements)
    {
        extract($elements);
        $wheres = array();
        // CONDITIONS
        if (!empty($names))
        {
            $elements_name = explode(' ', $names);
            foreach ($elements_name as $value) {
                $wheres[] = '(`name` LIKE \'%'.$value.'%\' OR `firstname` LIKE \'%'.$value.'%\') ';
            }
        }
        if (!empty($name))
        {
            $wheres[] = '`name` LIKE \'%'.$name.'%\' ';
        }
        if (!empty($firstName))
        {
            $wheres[] = '`firstName` LIKE \'%'.$firstName.'%\' ';
        }
        if (!empty($address))
        {
            $wheres[] = '`address` LIKE \'%'.$address.'%\' ';
        }
        if (!empty($phone))
        {
            $wheres[] = '`phone` LIKE \'%'.$phone.'%\' ';
        }
        if (!empty($mail))
        {
            $wheres[] = '`mail` LIKE \'%'.$mail.'%\' ';
        }
        // MAKE QUERY
        $query = 'SELECT `id`, `name`, `firstName`, `address`, `phone`, `mail` '
                .'FROM `hotel_accounts` '
                .'WHERE '.$this->where($wheres).' ORDER BY `name` ASC;';
        return $this->fetch($query);
    }


    /**
     * get logs for the current account
     * @return array results
     */
    public function getLogs()
    {
        return [
            'reservations_logs' => $this->fetch('SELECT * FROM `hotel_reservations_history` WHERE `account_id` = '.$this->id.';')
        ];
    }

}

?>
