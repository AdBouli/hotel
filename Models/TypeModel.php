<?php

require_once CORE.'Model.php';

class TypeModel extends Model
{

    protected $id;
    protected $name;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'types';
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
     * @return Array
     */
    public function getRooms()
    {
        return $this->select('*', 'rooms', ['type_id' => $this->id]);
    }

    /**
     * 
     */
    public function search($elements)
    {
        extract($elements);
        // MAKE QUERY
        $query = 'SELECT `id`, `name` FROM `hotel_types` ';
        if (!empty($_POST['name']))
        {
            $query .= 'WHERE `name` LIKE \'%'.$_POST['name'].'%\'';
        }
        $query .= 'ORDER BY `name` ASC;';
        return $this->fetch($query);
    }

}

?>
