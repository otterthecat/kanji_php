<?php

class Db_PDO {
	private $host = '';
	private $db = '';
	private $user = '';
	private $password = '';
	private $pdo = null;

	public function __construct ($arg_array) // host, db, user, password
	{

		return isset ($arg_array) ? $this -> assignProperties ($arg_array) : $this;

	}



	private function assignProperties ($arg_array)
	{

		if (isset ($arg_array['host']) && isset ($arg_array['db']) && isset ($arg_array['user']) && isset ($arg_array['password']))
		{

			$this -> host = $arg_array['host'];
			$this -> db = $arg_array['db'];
			$this -> user = $arg_array['user'];
			$this -> password = $arg_array['password'];

			$this -> pdo = new PDO ('mysql:host=' . $this -> host . ';dbname=' . $this -> db, $this -> user, $this -> password);

			return $this;
		}

		return false;

	}



	private function generateArray ($query_string, $type)
	{

		$pdoStmt = $this -> pdo -> query ($query_string);

		$temp_array = array ();
		while ($row = $pdoStmt -> fetch ($type))
		{

			array_push ($temp_array, $row);
		}

		return $temp_array;

	}



	public function set ($array_settings)
	{

		return isset ($array_settings) ? $this -> assignProperties ($array_settings) : false;

	}



	public function get ($property)
	{

		switch ($property)
		{

			case 'hostname':
				return $this -> hostname;
				break;

			case 'db':
				return $this -> db;
				break;

			case 'user':
				return $this -> db;
				break;

			default:
				return false;
				break;
		}

	}



	public function query ($query_string, $fetch_type = false, $className = null)
	{

		if (!$fetch_type)
		{

			return $this -> pdo -> query ($query_string);
		}

		switch ($fetch_type)
		{
			case 'ASSOC':

				return $this -> generateArray ($query_string, PDO::FETCH_ASSOC);
				break;

			case 'NUM':

				return $this -> generateArray ($query_string, PDO::FETCH_NUM);
				break;

			case 'OBJ':

				return $this -> generateArray ($query_string, PDO::FETCH_OBJ);
				break;

			case 'CLASS':

				$pdoStmt = $this -> pdo -> query ($query_string);
				$pdoStmt -> setFetchMode(PDO::FETCH_CLASS, $className);

				$temp_array = array ();
				while ($row = $pdoStmt -> fetch())
				{

					array_push ($temp_array, $row);
				}

				return $temp_array;
				break;

			default :
				return $this -> pdo -> query ($query_string);
				break;
		}

	}



	public function exec ($query_string)
	{

		return $this -> pdo -> exec ($query_string);

	}



}

// end class

/* end file
 */
