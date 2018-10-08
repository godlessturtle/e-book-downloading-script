<?php 
 class LoginModel extends CI_Model{

 	public function login($email, $pass){
 		$query = $this->db->get_where('admin', array('admin_mail' => $email, 'admin_pass' => $pass));
 		return $query;
 	}

 }


 ?>