<?php
class Content_model extends MY_Model
{
	public $_table 		= 'content';
	public $primary_key = 'id';
	
	function __construct() 
	{
		parent::__construct();
		
	}
	
	function get_all($arr_where=NULL)
	{
		if($arr_where==NULL)
		{
			 $arr_result = $this->db -> order_by($this->primary_key, 'desc')
						 			-> get($this->_table)
						 			-> result_array();
						 
		}
		else
		{
		 
			 $arr_result = $this->db -> where($arr_where)
			 						 -> order_by($this->primary_key, 'desc')
			 					 	 -> get($this->_table)
									 -> result_array();
								 //echo $this->db->last_query();
		}
								 								 
	  	return $arr_result;
	}
	
	function get_row($id)
	{
		
		$arr_result = $this->db -> where($this->primary_key, $id)
						   		-> get($this->_table)
						   		-> result_array();

	  if(is_array($arr_result) && count($arr_result) > 0)
	  	return $arr_result[0];
	}
	
	function insert_data($arr_data=NULL)
	{

		echo "inside modl";
		$success	= $this->insert($arr_data, true);
		if($success)	   
		 return $this->db->insert_id();
		else
		 return FALSE;  
		
	}
	
	function update_data($id, $arr_data=NULL)
	{

		$success	= $this ->update($id, $arr_data, true);
		//echo $this->db->last_query();						  
		if($success)	   
		 return TRUE;
		else
		 return FALSE;  
		
	}
	
	function count_all($arr_where=NULL)
	{
		if($arr_where==NULL)
		{
			$arr_result = $this->db->count_all_results($this->_table);
						 
		}
		else
		{
			
			$arr_result = $this->db-> where($arr_where)
								   -> count_all_results($this->_table);
		}
								 								 
	  	return $arr_result;
	}
	
	
	function get_row_detail($id)
	{
		
		$arr_result = $this->db -> where($this->primary_key, $id)
						   		-> get($this->_table)
						   		-> result_array();
								
								//echo $this->db->last_query();	

	  if(is_array($arr_result) && count($arr_result) > 0)
	  	return $arr_result[0];
	}

}

?>