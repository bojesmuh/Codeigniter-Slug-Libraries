<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Slug
 *
 * Muhammad Azis S
 * 
 */
class Slug
{
  /*
	 * Constructor
	 * 
	 */
	public function __construct()
	{
		 $this->CI =& get_instance();
		 $this->CI->load->helper('url');
		
	}
	/**
	 * [create_unique_slug description]
	 * @param  [type] $str    [string yang akan di slug]
	 * @param  [type] $colums [colums di tabel yang akan dituju]
	 * @param  [type] $table  [tabel yang dituju]
	 * @return [type]         [description]
	 */
	public function create_unique_slug($str,$colums, $table)
	{
		//Creates a human-friendly URL string with dashes
	    $slug = url_title($str,"dash",true);
		
		//Set the initial counter to append at the end of the string (if duplicate)
	    $i = 0;
	    $params = array ();
	    $params[$colums] = $slug;
		
	    while ($this->CI->db->where($params)->get($table)->num_rows()) {
	        if (!preg_match ('/-{1}[0-9]+$/', $slug )) {
	            $slug .= '-' . ++$i;
	        } else {
	            $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
	        }
	        	$params [$colums] = $slug;
	        }
	    return $slug;
	} 
}