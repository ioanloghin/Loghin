<?php  if ( ! defined('ANTIHACK')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

class Language
{
	private $lang;
	//
	// ========================================================================
	public function __construct($lang)
	{
		$this->lang = array();
		/*$db_results = SQL_DB::sql_querry("(SELECT `key`, `$lang` FROM `".MYSQL_PRE."lang_fulltext`) UNION ALL (SELECT `key`, `$lang` FROM `".MYSQL_PRE."lang_words`)");
		while($row = mysql_fetch_assoc($db_results))
			$this->lang[$row['key']] = $row[$lang];*/
	}
	// ========================================================================
	//
	//
	// ========================================================================
	public function get($key)
	{
		return (isset($this->lang[$key])) ? $this->lang[$key] : '{'.$key.'}';
	}
// ========================================================================
}
// END Language class

/* End of file Language.php */
/* Location: ./system/libraries/Language.php */