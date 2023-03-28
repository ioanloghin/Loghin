<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');

class SQL_DB
{
	static $link_identifier;
	public $sql;
	
	// ========================================================================
	public static function sql_connect()
	{
		global $config;
		self::$link_identifier = mysql_connect($config['db_server'], $config['db_user'], $config['db_pass']);
		mysql_select_db($config['db_name'], self::$link_identifier);
		
		return self::$link_identifier;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function sql_set_charset($charset)
	{
		$set_charset = mysql_set_charset($charset);
		return $set_charset;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_querry($querry)
	{
		// daca nu exista conexiunea cu db
		if(!self::$link_identifier)
	    	SQL_DB::sql_connect();
		
		// incearca executia comenzi sql
		if(($result = mysql_query($querry, self::$link_identifier)))
			return $result;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function sql_close()
	{
		return mysql_close();
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_delete($table, $where = NULL, $limit = 0)
	{
		$WHERE = ($where) ? "WHERE ($where)" : NULL;
		$LIMIT = ($limit) ? "LIMIT $limit" : NULL;
		$result = SQL_DB::sql_querry("DELETE FROM `$table` $WHERE $LIMIT");
		return $result;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_select($table, $where = NULL, $order = NULL, $start = 0, $limit = 0, $keys = array(), $distinct = NULL, $group = NULL)
	{
		$List = array();
		if(!empty($where)) $where = "WHERE ($where)";
		$sql_keys = NULL;
		if(count($keys))
		{
			foreach($keys as $k)
			{
				if($sql_keys) $sql_keys .= ", ";
				$sql_keys .= "`$k`";
			}
		}
		else
			$sql_keys = '*';
		$sql_distinct = ($distinct) ? "DISTINCT `$distinct`" : $sql_keys;
		
		$sql_group = ($group) ? " GROUP BY `$group`" : NULL;
		
	    $LIMIT = (!$start && !$limit) ? '' : "LIMIT $start, $limit";
		$rezultat = SQL_DB::sql_querry("SELECT $sql_distinct FROM `$table` $where $order $LIMIT".$sql_group);
		if($rezultat)
		{
			$total = mysql_num_rows($rezultat);
			$nr = 1;
			while ($rand = mysql_fetch_array($rezultat, MYSQL_ASSOC))
			{
				$List[$nr] = $rand;
				$nr++;
			}
			return $List;
		}
		else
		{
			echo "SELECT $sql_distinct FROM `$table` $where $order $LIMIT".$sql_group.'<br />';
			$debug_backtrace = debug_backtrace();
			foreach($debug_backtrace as $row)
			{
				if($row['function'] != 'include' && $row['function'] != 'require' && $row['function'] != 'include_once' && $row['function'] != 'require_once')
				{
					echo '<div style="border:1px solid #990000;margin:0 0 10px 0;padding:5px;font-family:\'Courier New\', Courier, monospace;font-size:12px;"><h4>A PHP Error was encountered</h4><p><strong>Severity</strong>: ...</p><p><strong>Message</strong>: ...</p><p><strong>Filename</strong>: '.$row['file'].'</p><p><strong>Line Number</strong>: '.$row['line'].'</p>';
					if(isset($row['class']))
						echo '<p><strong>Class</strong>: '.$row['class'].'</p>';
					if(isset($row['function']))
						echo '<p><strong>Function</strong>: '.$row['function'].'</p>';
					echo '<p><strong>SQL</strong>: '.$querry.'</p>';
					echo '</div>';
				}
			}
			return false;
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_left_join($table, $table2, $relation, $where = NULL, $order = NULL, $start = 0, $limit = 0)
	{
		if(!empty($where)) $where = "WHERE ($where)";
	    $LIMIT = (!$start && !$limit) ? '' : "LIMIT $start, $limit";
		
		$rezultat = SQL_DB::sql_querry("SELECT * FROM `$table` AS `t1` LEFT JOIN `$table2` AS `t2` ON $relation $where $order $LIMIT");
		$arr = array();
		while ($rand = mysql_fetch_array($rezultat, MYSQL_ASSOC))
			$arr[] = $rand;
		return $arr;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_export($filename)
	{
		$link = mysql_connect($host,$user,$pass);
	    mysql_select_db($name,$link);
	
		// get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		// cycle through
		foreach($tables as $table)
		{
			SQL_DB::sql_connect();
			$result = SQL_DB::sql_querry('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysql_fetch_row(SQL_DB::sql_querry('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			
			for ($i = 0; $i < $num_fields; $i++) 
			{
				while($row = mysql_fetch_row($result))
				{
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) 
					{
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			$return.="\n\n\n";
		}
		
		// save file
		if (!@fopen($filename.'.sql', 'r'))
		{
			$handle = fopen(($filename).'.sql','w+');
			fwrite($handle,$return);
			fclose($handle);
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_count($table, $where = NULL, $key = '*', $limit = 0)
	{
		if($where) $where = "WHERE ($where)";
		
	    $query = SQL_DB::sql_querry("SELECT COUNT($key) FROM `$table` $where");
		$result = mysql_result($query, 0);
		if($limit == 1)
			return ($result);// returneaza TRUE of FALSE
		else
			return $result;// returneaza un numar
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public static function sql_exist($field, $value)
	{
		list($table, $field)=explode('.', $field);
		return (bool)mysql_num_rows(SQL_DB::sql_querry("SELECT 1 FROM `".MYSQL_PRE."$table` WHERE `$field` = '$value' LIMIT 1"));
	}
	// ========================================================================
	public static function sql_insert($table, $keys = array())
	{
		$dbKeys = '';
		$dbVals = '';
		
		foreach($keys as $k => $v)
		{
			if($dbKeys) $dbKeys .= ', ';
			if($dbVals) $dbVals .= ', ';
			
			$dbKeys .= "`$k`";
			
			switch($v)
			{
				case 'NULL':
				case 'NOW()': $dbVals .= $v; break;
				default: $dbVals .= "'".mysql_escape_string($v)."'"; break;
			}
		}
		
		if(SQL_DB::sql_querry("INSERT INTO `$table` ($dbKeys) VALUES ($dbVals)"))
			return mysql_insert_id();
		else
			return 0;
	}
	// ========================================================================
	public static function sql_update($table, $sets = array(), $where = NULL, $limit = 0)
	{
		$dbSet = NULL;
		foreach($sets as $key => $value)
		{
			if($dbSet != NULL) $dbSet .= ', ';
			$dbSet .= "`$key` = '".mysql_escape_string($value)."'";
		}
		if($where) $where = "WHERE ($where)";
		$limit = ($limit) ? "LIMIT $limit" : NULL;
		
		$return = (SQL_DB::sql_querry("UPDATE `$table` SET $dbSet $where $limit"));
		return $return;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function sql_start_transaction()
	{
		SQL_DB::sql_querry("START TRANSACTION;");
	}
	// ========================================================================
	public function sql_rollback()
	{
		SQL_DB::sql_querry("ROLLBACK;");
	}
	// ========================================================================
	public function sql_commit()
	{
		SQL_DB::sql_querry("COMMIT;");
	}
	// ========================================================================
}
// END SQL class

/* End of file SQL_DB.php */
/* Location: ./system/library/SQL_DB.php */
?>