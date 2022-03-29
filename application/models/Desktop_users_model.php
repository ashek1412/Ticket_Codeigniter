<?php

class Desktop_users_model extends CI_Model {
	// Get user information
	public function get_desktop_user_info($id) {
		$id = (int)$id;
		$sql = "SELECT *  FROM `tickerr_desktop_users` WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}

	public function get_desktop_user_sl() {
		//$id = (int)$id;
		$sql = "SELECT  IF(MAX(sl_num) IS NULL OR MAX(sl_num)='',CONCAT(YEAR(NOW()),  '0000'),MAX(sl_num)) AS msl FROM tickerr_desktop_users WHERE YEAR(active_date)=YEAR(NOW())";
		$query = $this->db->query($sql);
		return $query->row();
	}

	public function active_desktop_user($user, $val) {
		
		$exp_date=date('Y-m-d', strtotime('+1 year'));
		$sql = "UPDATE `tickerr_desktop_users` SET `sl_num`=?,exp_date=?, active_date=CURDATE(), active=1 WHERE `id`=?";
		$query = $this->db->query($sql, array($val,$exp_date, (int)$user));
		return true;
	}

    public function reactivate_desktop_user($user, $val) {
		
		$sql = "UPDATE `tickerr_desktop_users` SET `exp_date`=?, active=1 WHERE `id`=?";
		$query = $this->db->query($sql, array($val, (int)$user));
		return true;
	}
	
	
	// Get user role
	public function get_desktop_user_role($username) {
		$sql = "SELECT `role` FROM `tickerr_desktop_users` WHERE `username`=?";
		$query = $this->db->query($sql, array($username));
		$row = $query->row();
		return $row->role;
	}
	
	// Get user ID (by the username)
	public function get_desktop_user_id($username) {
		$sql = "SELECT `id` FROM `tickerr_desktop_users` WHERE `username`=?";
		$query = $this->db->query($sql, array($username));
		$row = $query->row();
		return $row->id;
	}
	
	// Update user data
	public function change_user_data($user, $data, $val) {
		$sql = "UPDATE `tickerr_desktop_users` SET `$data`=? WHERE `id`=?";
		$query = $this->db->query($sql, array($val, (int)$user));
		return true;
	}


	public function get_all_users_exp($userid, $rows = 20, $starting = 0, $order_by = 'date', $order = 'DESC', $search = false) {
		if($search == false) {			
			$sql = "SELECT * FROM tickerr_desktop_users ORDER BY `$order_by` $order LIMIT $starting,$rows";
			$query = $this->db->query($sql);
		}else{
			$search = "%$search%";
			$sql = "SELECT * FROM tickerr_desktop_users WHERE (`id` LIKE ? OR `username` LIKE ? OR `name` LIKE ? OR `email` LIKE ? OR `phone` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
			$query = $this->db->query($sql, array($search, $search, $search, $search, $search));
		}
		return $query;
	}
	
	public function count_search_all_users_exp($userid, $search) {
		$search = "%$search%";
		$sql = "SELECT COUNT(*) as c FROM tickerr_desktop_users WHERE (`id` LIKE ? OR `username` LIKE ? OR `name` LIKE ? OR `email` LIKE ? OR `date` LIKE ?)";
		$query = $this->db->query($sql, array($search, $search, $search, $search, $search));
		$row = $query->row();
		return $row->c;
	}
	
	public function count_all_users_exp() {
		$sql = "SELECT COUNT(*) as c FROM `tickerr_desktop_users`";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->c;
	}


	 public function get_all_user_ecu_service($id) {
        $sql = "SELECT e.id, e.func_name ,uf.status FROM tickerr_ecu_functions e LEFT  JOIN (
                SELECT f.ecu_function_id , f.status FROM tickerr_desktop_user_functions f WHERE f.desktop_user_id=?) uf ON e.id=uf.ecu_function_id order by e.func_name";
        $query = $this->db->query($sql,$id);
        return $query;
    }

    public function delete_user_ecu_service($user) {
        $sql = "delete from  `tickerr_desktop_user_functions` where `desktop_user_id`=?";
        $query = $this->db->query($sql, array((int)$user));
        return true;
    }


    // Create new use ecu
    public function insert_user_ecu_function($uid, $fid) {


        // Data to insert
        $userf = array(
            '`desktop_user_id`' => $uid,
            '`ecu_function_id`' => $fid,
            '`status`' => 1,
            '`create_date`' => date('Y-m-d')

        );

        // Create user and return ID
        if($this->db->insert('tickerr_desktop_user_functions', $userf) == true) {
            // save confirmation and return user id
            return $this->db->insert_id();
        }
        return false;
    }
	
	
	
  

   

}