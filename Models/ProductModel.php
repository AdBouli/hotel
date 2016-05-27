<?php

require_once CORE.'Model.php';

class ProductModel extends Model
{

    protected $id;
    protected $name;
    protected $price;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'products';
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
     * Get price Method
     * @return
     */
    public function getprice()
    {
        return $this->price;
    }
    
    /**
     * Set price Method
     * @param Remplacement value
     */
    public function setprice($value)
    {
        $this->price = $value;
    }

    /**
     * 
     */
    public function search($elements)
    {
        extract($elements);
        // MAKE QUERY
        $query = 'SELECT `id`, `name`, `price` FROM `hotel_products` ';
        if (!empty($name))
        {
            $query .= 'WHERE `name` LIKE \'%'.$name.'%\'';
        }
        $query .= 'ORDER BY `name` ASC;';
        return $this->fetch($query);
    }

}

?>
