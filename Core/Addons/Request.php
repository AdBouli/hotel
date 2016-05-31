<?php 

require(CONF.'database.php');

trait Request
{
	protected $PDO;

	/**
	 * Create ans configure PDO object
	 * @param String Username
	 * @param String Password
	 * @param String Database
	 */
	public function connect($username, $password, $database)
	{
		$log = _Driver_.":host="._Hostname_."; dbname=$database";
		$this->PDO = new PDO($log, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	}

	/**
	 * Erase PDO object
	 */
	public function disconnect()
	{
		$this->PDO = NULL;
	}

	/**
	 * Execute request and return affected rows number
	 * @param String Query
	 * @return Integer Rows affected
	 */
	public function execute($query){
		// echo $query."<br>";
		$results = $this->PDO->prepare($query);
		$results->execute();
		return $results->rowCount();
	}

	/**
	 * Execute request and fetch result(s)
	 * @param String Query
	 * @return Array Request result(s)
	 */
	public function fetch($query)
	{
		// echo $query."<br>";
		$results = $this->PDO->prepare($query);
		$results->execute();
		return $results->FetchAll(PDO::FETCH_ASSOC);
	}

	/**
	 * Insert request
	 * @param String Table
	 * @param Array Datas [field] => value
	 * @return Boolean
	 */
	public function insert($table, $datas)
	{
		$table = _Prefix_.$table;
		$cols = '';
		$vals = '';
		$i = count($datas);
		foreach ($datas as $col => $val) {
			$i--;
			$cols .= '`'.$col.'`';
			$vals .= '\''.$val.'\'';
			if ($i > 0)
			{
				$cols .= ', ';
				$vals .= ', ';
			}
		}
		return 1 == $this->execute("INSERT INTO $table ($cols) VALUES ($vals);");
	}

	/**
	 * Update request
	 * @param String Table
	 * @param Array Datas : [field] => value
	 * @param Array Where clause(s) : ['condition'] or ['field' => 'value']
	 * @return Boolean
	 */
	public function update($table, $datas, $conditions)
	{
		$table = _Prefix_.$table;
		$sets = '';
		$i = count($datas);
		foreach ($datas as $col => $val) {
			$i--;
			$sets .= '`'.$col.'` =  \''.$val.'\'';
			if ($i > 0)
			{
				$sets .= ', ';
			}
		}
		$conds = $this->where($conditions);
		return 1 == $this->execute("UPDATE $table SET $sets WHERE $conds;");
	}

	/**
	 * Delete request
	 * @param String Table
	 * @param Array Where clause(s) : ['condition'] or ['field' => 'value']
	 * @return Boolean
	 */
	public function delete($table, $conditions)
	{
		$table = _Prefix_.$table;
		$conds = $this->where($conditions);
		return 1 == $this->execute("DELETE FROM $table WHERE $conds;");
	}

	/**
	 * Select request
	 * @param Array Column name(s) ['*'] for all
	 * @param String Table
	 * @param Array Where clause(s) : ['condition'] or ['field' => 'value']
	 * @return Array Request result(s)
	 */
	public function select($columns, $table, $conditions = [])
	{		
		$table = _Prefix_.$table;
		$cols = '';
		$i = count($columns);
		if ($columns == '*' || $columns == ['*'])
		{
			$cols = '*';
		} else
		{
			foreach ($columns as $column) {
				$i--;
				$cols .= '`'.$column.'`';
				if ($i > 0)
				{
					$cols .= ', ';
				}
			}
		}
		$conds = $this->where($conditions);
		return $this->fetch("SELECT $cols FROM $table WHERE $conds;");
	}

	/**
	 * @param Array Where clause(s) : ['condition'] or ['field' => 'value']
	 * @return String
	 */
	public function where($conditions)
	{
		$conds = '';
		if (empty($conditions))
		{
			$conditions = ['1'];
		}
		$i = count($conditions);
		foreach ($conditions as $key => $value) {
			$i--;
			if (is_int($key))
			{
				$conds .= $value;
			} else
			{
				$conds .= '`'.$key.'` = \''.$value.'\'';
			}
			if ($i > 0)
			{
				$conds .= ' AND ';
			}
		}
		return $conds;
	}
}

?>