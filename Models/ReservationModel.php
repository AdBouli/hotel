<?php

require_once CORE.'Model.php';

class ReservationModel extends Model
{

    protected $id;
    protected $account_id;
    protected $room_id;
    protected $dateStart;
    protected $dateEnd;
    protected $total;
    protected $paid;
    protected $user_id;
    protected $created;
    protected $modified;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'reservations';
        $this->_DisplayField = '';
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
     * Get account_id Method
     * @return
     */
    public function getaccount_id()
    {
        return $this->account_id;
    }
    
    /**
     * Set account_id Method
     * @param Remplacement value
     */
    public function setaccount_id($value)
    {
        $this->account_id = $value;
    }

    /**
     * Get room_id Method
     * @return
     */
    public function getroom_id()
    {
        return $this->room_id;
    }
    
    /**
     * Set room_id Method
     * @param Remplacement value
     */
    public function setroom_id($value)
    {
        $this->room_id = $value;
    }

    /**
     * Get date start Method
     * @return
     */
    public function getdateStart()
    {
        return $this->dateStart;
    }
    
    /**
     * Set date start Method
     * @param Remplacement value
     */
    public function setdateStart($value)
    {
        $this->dateStart = $value;
    }

    /**
     * Get date end Method
     * @return
     */
    public function getdateEnd()
    {
        return $this->dateEnd;
    }
    
    /**
     * Set date end Method
     * @param Remplacement value
     */
    public function setdateEnd($value)
    {
        $this->dateEnd = $value;
    }

    /**
     * Get total Method
     * @return
     */
    public function gettotal()
    {
        return $this->total;
    }
    
    /**
     * Set total Method
     * @param Remplacement value
     */
    public function settotal($value)
    {
        $this->total = $value;
    }

    /**
     * Get paid Method
     * @return
     */
    public function getpaid()
    {
        return $this->paid;
    }
    
    /**
     * Set paid Method
     * @param Remplacement value
     */
    public function setpaid($value)
    {
        $this->paid = $value;
    }

    /**
     * Get user_id Method
     * @return
     */
    public function getuser_id()
    {
        return $this->user_id;
    }
    
    /**
     * Set user_id Method
     * @param Remplacement value
     */
    public function setuser_id($value)
    {
        $this->user_id = $value;
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
     * Get orders list
     * @return Array orders list
     */
    public function getOrders()
    {
        $order = $this->loadModel('order');
        return $order->select('*', 'orders', ['reservation_id' => $this->id]);
    }

    /**
     * Get no paid orders list
     * @return Array no paid orders list
     */
    public function getOrdersNoPaid()
    {
        $order = $this->loadModel('order');
        return $order->select('*', 'orders', ['reservation_id' => $this->id, 'paid' => '0']);
    }

    /**
     * Get paid orders list
     * @return Array paid orders list
     */
    public function getOrdersPaid()
    {
        $order = $this->loadModel('order');
        return $order->select('*', 'orders', ['reservation_id' => $this->id, 'paid' => '1']);
    }

    /**
     * Get type name
     */
    public function getAccount()
    {
        $account = $this->loadModel('account', $this->account_id);
        return $account->toArray();
    }

    /**
     * Get type name
     */
    public function getRoom()
    {
        $room = $this->loadModel('room', $this->room_id);
        return $room->toArray();
    }

    /**
     * 
     */
    public function getLastOrder()
    {
        return $this->fetch('SELECT `id` FROM `hotel_orders` WHERE `reservation_id` = '.$this->id.' ORDER BY `created` DESC LIMIT 1;')[0];
    }

    /**
     * 
     */
    public function search($elements)
    {
        extract($elements);
        $wheres = array();
        // ACCOUNT CONDITIONS
        if (!empty($account))
        {
            $element_account = explode(' ', $account);
            foreach ($element_account as $value) {
                $wheres[] = '(`hotel_accounts`.`name` LIKE \'%'.$value.'%\' OR `hotel_accounts`.`firstName` LIKE \'%'.$value.'%\') ';
            }
        }
        // DATES CONDITIONS
        if (!empty($dateStart) || !empty($dateEnd))
        {
            if (!empty($dateStart) && !empty($dateEnd))
            {
                $wheres[] = '`hotel_reservations`.`dateStart` >= \''.$dateStart.'\' ';
                $wheres[] = '`hotel_reservations`.`dateEnd` <= \''.$dateEnd.'\' ';
            } else
            {
                if (!empty($dateStart))
                {
                    $wheres[] = '`hotel_reservations`.`dateStart` >= \''.$dateStart.'\' ';
                } else
                {
                    $wheres[] = '`hotel_reservations`.`dateEnd` <= \''.$dateEnd.'\' ';
                }
            }
        }
        // ROOM CONDITIONS
        if (!empty($room_id))
        {
            $wheres[] = '`hotel_reservations`.`room_id` = '.$room_id.' ';
        } else
        {
            // TYPE CONDITIONS
            if (!empty($type_id))
            {
                $wheres[] = '`hotel_rooms`.`type_id` = '.$type_id.' ';
            }
            // PERSON CONDITIONS
            if (!empty($person))
            {
                $wheres[] = '`hotel_rooms`.`person` = '.$person.' ';
            }
            // FLOOR CONDITIONS
            if (!empty($floor))
            {
                $wheres[] = '`hotel_rooms`.`floor` = '.$floor.' ';
            }
        }
        // PAID CONDITIONS
        if(!empty($paid))
        {
            if ($paid == 'oui')
            {
                $wheres[] = '`hotel_reservations`.`paid` = `hotel_reservations`.`total` ';
            } else
            {
                $wheres[] = '`hotel_reservations`.`paid` < `hotel_reservations`.`total` ';
            }
        }
        // MAKE QUERY
        $query  = 'SELECT `hotel_reservations`.`id`, `hotel_reservations`.`dateStart`, `hotel_reservations`.`dateEnd`, '
                 .'`hotel_reservations`.`total`, `hotel_reservations`.`paid`, '
                 .'`hotel_accounts`.`name`, `hotel_accounts`.`firstname`, '
                 .'`hotel_rooms`.`num`, `hotel_rooms`.`floor`, '
                 .'`hotel_types`.`name` \'type\' '
                 .'FROM `hotel_reservations` '
                 .'INNER JOIN `hotel_accounts` ON `hotel_accounts`.`id` = `hotel_reservations`.`account_id` '
                 .'INNER JOIN `hotel_rooms` ON `hotel_rooms`.`id` = `hotel_reservations`.`room_id` '
                 .'INNER JOIN `hotel_types` ON `hotel_types`.`id` = `hotel_rooms`.`type_id` '
                 .'WHERE '.$this->where($wheres).' ORDER BY `hotel_reservations`.`dateStart` DESC;';
        return $this->fetch($query);
    }

    /**
     * 
     */
    public function autoSetTotal()
    {
        $price = $this->getRoom()['price'];
        $tmp = new DateTime($this->dateStart);
        $price_reservation = floatval($tmp->diff(new DateTime($this->dateEnd))->format('%R%a'));
        if ($price_reservation > 0)
        {
            $total_order = 0;
            $orders = $this->getOrders();
            foreach ($orders as $order)
            {
                $total_order += $order['total'];
            }
            $this->total = $price_reservation + $total_order;
        }
    }

    public function getLogs()
    {
        return [
            'reservation_logs' => $this->fetch('SELECT * FROM `hotel_reservations_history` WHERE `reservation_id` = '.$this->id.';'),
            'orders_logs'       => $this->fetch('SELECT * FROM `hotel_orders_history` WHERE `reservation_id` = '.$this->id.';')
        ];
    }

}

?>
