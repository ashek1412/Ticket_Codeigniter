<?php
class Api_model extends CI_Model
{
    function fetch_all_desktop_user()    {

        $sql = "SELECT username, name, email FROM tickerr_desktop_users order by id";
        $query = $this->db->query($sql);
        return $query->result();
    	
	}

	public function validate_session($user, $pass) {
		$user = $this->db->escape($user);
		$pass = $this->db->escape($pass);
		
		$query = $this->db->query("SELECT `id` FROM `tickerr_desktop_users` WHERE `username`=$user && `password`=$pass");
		if($query->num_rows() == 0)
			return false;
		return true;
	}


	public function validate_machine($user, $machine_id) {
		$user = $this->db->escape($user);
		$machine_id = $this->db->escape($machine_id);
		
		$query = $this->db->query("SELECT `id` FROM `tickerr_desktop_users` WHERE `username`=$user AND (machine_id=$machine_id OR temp_id=$machine_id)");
		if($query->num_rows() == 0)
			return false;
		return true;
	}

   

    function fetch_single_desktop_user($user_id)
    {
        $this->db->where("id", $user_id);
        $query = $this->db->get('tickerr_desktop_users');
        return $query->result_array();
    }

     function get_desktop_user($uname)
    {
        $this->db->where("username", $uname);
        $query = $this->db->get('tickerr_desktop_users');
        return $query->result_array();
    }



    public function check_existing_username($u) {
		$sql = "SELECT `id` FROM `tickerr_desktop_users` WHERE `username`=?";
		$query = $this->db->query($sql, $u);
		return ($query->num_rows() == 0) ? false : true;
	}
	
	// Check if email address exists
	public function check_existing_email($e) {
		$sql = "SELECT `id` FROM `tickerr_desktop_users` WHERE `email`=?";
		$query = $this->db->query($sql, $e);
		return ($query->num_rows() == 0) ? false : true;
	}


	// Check if email address exists
	public function check_existing_machine_id($e) {
		$sql = "SELECT `id` FROM `tickerr_desktop_users` WHERE `machine_id`=?";
		$query = $this->db->query($sql, $e);
		return ($query->num_rows() == 0) ? false : true;
	}




	// Create new account
	public function new_account($name, $username, $email, $password, $company, $phone, $country, $mac, $local_ip,$public_ip,$machine_id) {
		
		
		

		$conf_str = password_hash($machine_id, PASSWORD_BCRYPT); 	
		
		// Data to insert
		$user = array(
			'`username`' => $username,
			'`name`' => $name,
			'`email`' => $email,
			'`phone`' => $phone,
			'`company`' => $company,
			'`country`' =>  $country,
			'`date`' => date('Y-m-d H:i:s'),
			'`password`' => md5($password),
			'`mac`' => $mac,
			'`local_ip`' => $local_ip,
			'`public_ip`' => $public_ip,							
			'`active`' =>0,
			'`exp_date`' => date('Y-m-d', strtotime('+1 year')),
			'`machine_id`' => $machine_id,
			'`conf_str`' => $conf_str
				
		);
		
		// Create user and return ID
		if($this->db->insert('tickerr_desktop_users', $user) == true) {
			// save confirmation and return user id			
			return $this->db->insert_id();
		}
		return false;
	}



	// Create new use ecu
	public function new_account_ecu_function($uid, $fid) {
		
		
			// Data to insert
		$userf = array(
			'`desktop_user_id`' => $uid,
			'`ecu_function_id`' => $fid,
			'`status`' => 0,			
			'`create_date`' => date('Y-m-d')
			
		);
		
		// Create user and return ID
		if($this->db->insert('tickerr_desktop_user_functions', $userf) == true) {
			// save confirmation and return user id			
			return $this->db->insert_id();
		}
		return false;
	}



	public function get_all_ecu_function() {

		$sql = "SELECT * FROM tickerr_ecu_functions order by id";
        $query = $this->db->query($sql);
        return $query;
	}
	

	public function get_desktop_user_mac($mid)
	{			
		$sql = "SELECT email,name,company, phone,active,conf_str,machine_id FROM `tickerr_desktop_users` WHERE (machine_id=? OR temp_id='$mid')";
		$query = $this->db->query($sql, $mid);
		return $query->row();
	}


	public function verify_desktop_user_mac($mid)
	{			
		$sql = "SELECT * FROM `tickerr_desktop_users` WHERE (machine_id=? OR temp_id='$mid')";
		$query = $this->db->query($sql, $mid);
			
		return $query->row();
	}

	public function verify_desktop_user_old_mac($mid)
	{			
		$sql = "SELECT * FROM `tickerr_desktop_users` WHERE temp_id='$mid'";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function get_desktop_user_email($mid)
	{			
		$sql = "SELECT * FROM `tickerr_desktop_users` WHERE `email`=?";
		$query = $this->db->query($sql, $mid);
		return $query->row();
	}


	public function update_user_usb_info($user,$pkey, $usbkey)
	{
		$usb_date=date('Y-m-d H:i:s');

		//$usbkey = password_hash($machine_id, PASSWORD_BCRYPT); 

		$sql = "UPDATE `tickerr_desktop_users` SET `usb_pkey`=?,usb_key=?, usb_date=?  WHERE `username`=?";
		$query = $this->db->query($sql, array($pkey,$usbkey,$usb_date, $user));
		return $this->db->affected_rows();
	}

	public function update_user_ip_info($user,$public_ip, $local_ip)
	{
		//$exp_date=date('Y-m-d', strtotime('+1 year'));
		$sql = "UPDATE `tickerr_desktop_users` SET `public_ip`=?,local_ip=?  WHERE `username`=?";
		$query = $this->db->query($sql, array($public_ip,$local_ip, $user));
		return $this->db->affected_rows();
	}

	public function update_user_mac_info($user,$mac)
	{
		//$exp_date=date('Y-m-d', strtotime('+1 year'));
			$conf_str = password_hash($mac, PASSWORD_BCRYPT); 
		$sql = "UPDATE `tickerr_desktop_users` SET conf_str=?,machine_id=?  WHERE username=?";
		$query = $this->db->query($sql, array($conf_str, $mac, $user));
		return $this->db->affected_rows();
	}


	public function update_user_app_ver($user,$appver)
	{
		//$exp_date=date('Y-m-d', strtotime('+1 year'));
			
		$sql = "UPDATE `tickerr_desktop_users` SET appversion=? WHERE username=?";
		$query = $this->db->query($sql, array($appver, $user));
		return $this->db->affected_rows();
	}



	

}

