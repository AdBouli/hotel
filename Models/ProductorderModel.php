<?php

require_once CORE.'Model.php';

class ProductorderModel extends Model
{

    protected $id;
    protected $product_id;
    protected $order_id;
    protected $quantity;
    protected $total;
    protected $user_id;
    protected $created;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'products_orders';
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
     * Get product_id Method
     * @return
     */
    public function getproduct_id()
    {
        return $this->product_id;
    }
    
    /**
     * Set product_id Method
     * @param Remplacement value
     */
    public function setproduct_id($value)
    {
        $this->product_id = $value;
    }

    /**
     * Get order_id Method
     * @return
     */
    public function getorder_id()
    {
        return $this->order_id;
    }
    
    /**
     * Set order_id Method
     * @param Remplacement value
     */
    public function setorder_id($value)
    {
        $this->order_id = $value;
    }

    /**
     * Get quantity Method
     * @return
     */
    public function getquantity()
    {
        return $this->quantity;
    }
    
    /**
     * Set quantity Method
     * @param Remplacement value
     */
    public function setquantity($value)
    {
        $this->quantity = $value;
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
     * @return Array product
     */
    public function getProduct()
    {
        $product = $this->loadModel('product', $this->product_id);
        return $product->toArray();
    }

    /**
     * @param Array elements to search
     * @return Array results
     */
    public function search($elements)
    {
        extract($elements);
        $wheres = array();
        // NUM CONDITION
        if (!empty($order_id))
        {
            $wheres[] = '`hotel_products_orders`.`order_id` = \''.$order_id.'\' ';
        }
        if (!empty($product_id))
        {
            $wheres[] = '`hotel_products_orders`.`product_id` = \''.$product_id.'\' ';
        }
        if (!empty($quantity))
        {
            $wheres[] = '`hotel_products_orders`.`quantity` = \''.$quantity.'\' ';
        }
        // MAKE QUERY
        $query = 'SELECT * FROM `hotel_products_orders` '
                .'WHERE '.$this->where($wheres).';';
        return $this->fetch($query);
    }

}

?>
