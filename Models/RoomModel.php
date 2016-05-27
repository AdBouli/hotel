<?php

require_once CORE.'Model.php';

class RoomModel extends Model
{

    protected $id;
    protected $num;
    protected $person;
    protected $floor;
    protected $price;
    protected $type_id;

    /**
     *
     */
    public function __construct($id = 0)
    {
        $this->_PK = 'id';
        $this->_Table = 'rooms';
        $this->_DisplayField = 'num';
        $this->_Uniques = [];
        parent::__construct($id);
    }

    /**
     * Get id Method
     * @return Int
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
     * Get num Method
     * @return Int
     */
    public function getnum()
    {
        return $this->num;
    }
    
    /**
     * Set num Method
     * @param Remplacement value
     */
    public function setnum($value)
    {
        $this->num = $value;
    }

    /**
     * Get person Method
     * @return Int
     */
    public function getperson()
    {
        return $this->person;
    }
    
    /**
     * Set person Method
     * @param Remplacement value
     */
    public function setperson($value)
    {
        $this->person = $value;
    }

    /**
     * Get floor Method
     * @return
     */
    public function getfloor()
    {
        return $this->floor;
    }
    
    /**
     * Set floor Method
     * @param Remplacement value
     */
    public function setfloor($value)
    {
        $this->floor = $value;
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
     * Get type_id Method
     * @return
     */
    public function gettype_id()
    {
        return $this->type_id;
    }
    
    /**
     * Set type_id Method
     * @param Remplacement value
     */
    public function settype_id($value)
    {
        $this->type_id = $value;
    }

    /**
     * Get type name
     */
    public function gettypename()
    {
        $type = $this->loadModel('type', $this->gettype_id());
        return $type->getname();
    }

    /**
     * Get reservations list
     * @return Array reservation list
     */
    public function getReservations()
    {
        $reservation = $this->loadModel('reservation');
        return $reservation->select('*', 'reservations', ['room_id' => $this->id]);
    }

    /**
     * 
     */
    public function search($elements)
    {
        extract($elements);
        $wheres = array();
        // NUM CONDITION
        if (!empty($num))
        {
            $wheres[] = '`hotel_rooms`.`num` = \''.$num.'\' ';
        }else
        {
            if (!empty($floor))
            {
                $wheres[] = '`hotel_rooms`.`floor` = \''.$floor.'\' ';
            }
            if (!empty($person))
            {
                $wheres[] = '`hotel_rooms`.`person` = \''.$_POST['person'].'\' ';
            }
            if (!empty($type_id))
            {
                $wheres[] = '`hotel_rooms`.`type_id` = \''.$type_id.'\' ';
            }
        }
        // MAKE QUERY
        $query = 'SELECT `hotel_rooms`.`id`, `hotel_rooms`.`num`, `hotel_rooms`.`person`, `hotel_rooms`.`floor`, `hotel_rooms`.`price`, `hotel_types`.`name` '
                .'FROM `hotel_rooms` '
                .'INNER JOIN `hotel_types` ON `hotel_types`.`id` = `hotel_rooms`.`type_id` '
                .'WHERE '.$this->where($wheres).' ORDER BY `hotel_rooms`.`num` ASC;';
        return $this->fetch($query);
    }

    /**
     * @param String Date start (yyyy-mm-dd)
     * @param String Date end (yyyy-mm-dd)
     * @return Array Free rooms list
     */
    public function getFreeRooms($dateA, $dateB, $person = 0, $type = 0, $floor = 0)
    {
        $subquery = 'SELECT DISTINCT `hotel_rooms`.`id` FROM `hotel_rooms` '
                   .'INNER JOIN `hotel_reservations` ON `hotel_reservations`.`room_id` = `hotel_rooms`.`id` '
                   .'WHERE \''.$dateA.'\' BETWEEN `hotel_reservations`.`dateStart` AND `hotel_reservations`.`dateEnd` '
                   .'OR \''.$dateB.'\' BETWEEN `hotel_reservations`.`dateStart` AND `hotel_reservations`.`dateEnd` '
                   .'OR (\''.$dateA.'\' < `hotel_reservations`.`dateStart` AND `hotel_reservations`.`dateEnd` < \''.$dateB.'\')';
        $query = 'SELECT * FROM `hotel_rooms` '
                .'WHERE `id` NOT IN ('.$subquery.') ';
        if ($person != 0)
        {
            $query .= 'AND `person` = \''.$person.'\' ';
        }
        if ($type != 0)
        {
            $query .= 'AND `type_id` = \''.$type.'\' ';
        }
        if ($floor != 0)
        {
            $query .= 'AND `floor` = \''.$floor.'\' ';
        }
        return $this->fetch($query.'ORDER BY `num` ASC;');
    }

    public function getLogs()
    {
        return [
            'reservations_logs' => $this->fetch('SELECT * FROM `hotel_reservations_history` WHERE `room_id` = '.$this->id.';')
        ];
    }

}

?>
