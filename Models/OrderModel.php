<?php

require_once CORE.'Model.php';

class OrderModel extends Model
{

    protected $id;
    protected $reservation_id;
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
        $this->_Table = 'orders';
        $this->_DisplayField = 'id';
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
     * Get reservation_id Method
     * @return
     */
    public function getreservation_id()
    {
        return $this->reservation_id;
    }
    
    /**
     * Set reservation_id Method
     * @param Remplacement value
     */
    public function setreservation_id($value)
    {
        $this->reservation_id = $value;
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
     * @return Array order lines
     */
    public function getProductsOrders()
    {
        return $this->select('*', 'products_orders', ['order_id' => $this->id]);
    }

    /**
     * @return Array results
     */
    public function getResume()
    {
        $query = 'SELECT `hotel_products_orders`.`id`, `hotel_products`.`name`, `hotel_products`.`price`, `hotel_products_orders`.`quantity`, `hotel_products_orders`.`total` '
                .'FROM `hotel_products_orders` INNER JOIN `hotel_products` ON `hotel_products`.`id` = `hotel_products_orders`.`product_id` '
                .'WHERE `hotel_products_orders`.`order_id` = '.$this->id.';';
        return $this->fetch($query);
    }

    /**
     * @param Array elements to search
     * @return Array results
     */
    public function search($elements)
    {
        extract($elements);
        $wheres = array();
        // RESERVATIONS CONDITIONS
        if (!empty($reservation_id))
        {
            $wheres[] = '`hotel_orders`.`reservation_id` = '.$reservation_id.' ';
        } else
        {
            if (!empty($account))
            {
                $elements_name = explode(' ', $account);
                foreach ($elements_name as $value) {
                    $wheres[] = '(`hotel_accounts`.`name` LIKE \'%'.$value.'%\' OR `hotel_accounts`.`firstname` LIKE \'%'.$value.'%\') ';
                }
            }
        }
        // PAID CONDITIONS
        if(!empty($paid))
        {
            if ($paid == 'oui')
            {
                $wheres[] = '`hotel_orders`.`paid` = 1 ';
            } else
            {
                $wheres[] = '`hotel_orders`.`paid` = 0 ';
            }
        }
        // MAKE QUERY
        $query  = 'SELECT `hotel_orders`.`id`, `hotel_orders`.`created`, `hotel_orders`.`total`, `hotel_orders`.`paid`, '
                 .'`hotel_accounts`.`name`, `hotel_accounts`.`firstname`, '
                 .'count(`hotel_products_orders`.`id`) \'lines\', sum(`hotel_products_orders`.`quantity`) \'products\' '
                 .'FROM `hotel_orders` '
                 .'INNER JOIN `hotel_products_orders` ON `hotel_products_orders`.`order_id` = `hotel_orders`.`id` '
                 .'INNER JOIN `hotel_reservations` ON `hotel_reservations`.`id` = `hotel_orders`.`reservation_id` '
                 .'INNER JOIN `hotel_accounts` ON `hotel_accounts`.`id` = `hotel_reservations`.`account_id` '
                 .'WHERE '.$this->where($wheres).' GROUP BY `hotel_orders`.`id` ORDER BY `hotel_orders`.`created` DESC;';
        return $this->fetch($query);
    }

    /**
     * get logs for the current order
     * @return array results
     */
    public function getLogs()
    {
        return [
            'order_logs' => $this->fetch('SELECT * FROM `hotel_orders_history` WHERE `order_id` = '.$this->id.';'),
            'lines_logs' => $this->fetch('SELECT * FROM `hotel_products_orders_history` WHERE `order_id` = '.$this->id.';')
        ];
    }

}

?>
