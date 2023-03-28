<?php
// ANTIHACK verificare access din exterior
if(!defined('ANTIHACK'))
{
	header('HTTP/1.0 403 Forbidden');
	header('Status: 403 Forbidden');
	die(include_once("../../module/e_403.php"));
}
//
//
//
class SQL_DB
{
	// ========================================================================
	function sql_connect()
	{
		if (! isset($connect))
		{
		    $connect = mysql_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PAROLA);
			mysql_select_db(BAZA_DATE);
		}
		
		return $connect;
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
	function sql_querry($querry)
	{
	    SQL_DB::sql_connect();
		if(($result = mysql_query($querry)))
			return $result;
		else
		{
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
					echo '</div>';
				}
			}
		}
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function sql_close()
	{
		$status = mysql_close();
		return $status;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function sql_delete($table, $where = NULL, $limit = 0)
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
	public function sql_select($table, $where = NULL, $order = NULL, $start = 0, $limit = 0, $keys = array(), $distinct = NULL, $group = NULL)
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
		$total = mysql_num_rows($rezultat);
		$nr = 1;
		while ($rand = mysql_fetch_array($rezultat, MYSQL_ASSOC))
		{
			$List[$nr] = $rand;
			$nr++;
		}
		return $List;
	}
	// ========================================================================
	//
	//
	// ========================================================================
	function sql_export($filename)
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
	function sql_count($table, $where = NULL, $key = '*', $limit = 0)
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
	function sql_insert($table, $keys = array(), $values = array())
	{
		$dbKeys = NULL;
		$dbVals = NULL;
		
		if(count($keys) && !count($values))
		{
			foreach($keys as $k => $v)
			{
				if($dbKeys != NULL) $dbKeys .= ', ';
					$dbKeys .= "`$k`";
				
				if($dbVals != NULL) $dbVals .= ', ';
				if($v == 'NULL' || $v == 'NOW()')
					$dbVals .= $v;
				else
					$dbVals .= "'".mysql_escape_string($v)."'";
			}
		}
		else
		{
			foreach($keys as $k)
			{
				if($dbKeys != NULL) $dbKeys .= ', ';
				$dbKeys .= "`$k`";
			}
			
			foreach($values as $v)
			{
				if($dbVals != NULL) $dbVals .= ', ';
				if($v == 'NULL' || $v == 'NOW()')
					$dbVals .= $v;
				else
					$dbVals .= "'".mysql_escape_string($v)."'";
			}
		}
		
		if(SQL_DB::sql_querry("INSERT INTO `$table` ($dbKeys) VALUES ($dbVals)"))
			return mysql_insert_id();
		else
			return 0;
	}
	// ========================================================================
	function sql_update($table, $sets = array(), $where = NULL, $limit = 0)
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
}
//:::UPDATE[2012-01-24]::: A nu se indeparta!
?>