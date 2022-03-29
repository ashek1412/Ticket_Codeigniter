<?php

class Users_model extends CI_Model {
	// Get user information
	public function get_user_info($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM `tickerr_users` WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}
	
	// Get user role
	public function get_user_role($username) {
		$sql = "SELECT `role` FROM `tickerr_users` WHERE `username`=?";
		$query = $this->db->query($sql, array($username));
		$row = $query->row();
		return $row->role;
	}
	
	// Get user ID (by the username)
	public function get_user_id($username) {
		$sql = "SELECT `id` FROM `tickerr_users` WHERE `username`=?";
		$query = $this->db->query($sql, array($username));
		$row = $query->row();
		return $row->id;
	}
	
	// Update user data
	public function change_user_data($user, $data, $val) {
		$sql = "UPDATE `tickerr_users` SET `$data`=? WHERE `id`=?";
		$query = $this->db->query($sql, array($val, (int)$user));
		return true;
	}
	
	// Get agents list
	public function get_agents() {
		$sql = "SELECT * FROM `tickerr_users` WHERE `role` = 2 OR `role` = 3";
		
		$query = $this->db->query($sql);
		return $query;
	}


    public function get_user_info_email($id) {
        $id = $id;
        $sql = "SELECT * FROM `tickerr_users` WHERE `email`=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }


    public function get_user_serial_numbers($uid,$pid) {
        $sql = "SELECT s.serial,p.name FROM tickerr_serial_numbers s inner join tickerr_products p on s.productid=p.id  WHERE s.userid=? and s.productid=?";
        $query = $this->db->query($sql, array($uid,$pid));
        $row = $query->row();
        return $row;
    }


	// insert user download record ofr today;

	public function insert_user_download_count($uid) {
		$today=date("Y-m-d");
        $sql = "INSERT IGNORE INTO tickerr_downloads (user_id , dl_date,dl_count ) Values (?,?,?)";
        $query = $this->db->query($sql, array($uid,$today,0));
		return true;
    }

		// update  user download record for today;

	public function update_user_download_count($uid) {
		$today=date("Y-m-d");
        $sql = "Update tickerr_downloads set dl_count=dl_count+1 where user_id=? and dl_date=?";
        $query = $this->db->query($sql, array($uid,$today));
		return true;
    }


	public function get_user_download_count($uid) {
		$today=date("Y-m-d");
        $sql = "SELECT dl_count from tickerr_downloads Where user_id=? and dl_date=?";
        $query = $this->db->query($sql, array($uid,$today));
		 $row = $query->row();
        return $row;
    }

		public function get_agent_users_exp($userid, $rows = 20, $starting = 0, $order_by = 'date', $order = 'DESC', $search = false) {
		if($search == false) {			
			$sql = "SELECT * FROM tickerr_users where created_by=$userid ORDER BY `$order_by` $order LIMIT $starting,$rows";
			$query = $this->db->query($sql);
		}else{
			$search = "%$search%";
			$sql = "SELECT * FROM tickerr_users WHERE (`id` LIKE ? OR `username` LIKE ? OR `name` LIKE ? OR `email` LIKE ? OR `date` LIKE ?) and created_by=? ORDER BY `$order_by` $order LIMIT $starting,$rows";
			$query = $this->db->query($sql, array($search, $search, $search, $search, $search,userid ));
		}
		return $query;
	}


}