<?php

class Products_model extends CI_Model {
	// Get product information
	public function get_product_info($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM tickerr_products WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}
	
	// Get product serial numburs role
	public function get_user_serial_numbers($uid,$pid) {
		$sql = "SELECT s.* FROM tickerr_serial_numbers s inner join tickerr_products p on s.productid=p.id  WHERE s.userid=? and s.productid=?";
		$query = $this->db->query($sql, array($uid,$pid));
		$row = $query->row();
		return $row;
	}
	
//	// Get user ID (by the username)
//	public function get_user_id($username) {
//		$sql = "SELECT `id` FROM `tickerr_users` WHERE `username`=?";
//		$query = $this->db->query($sql, array($username));
//		$row = $query->row();
//		return $row->id;
//	}
//
//	// Update user data
//	public function change_user_data($user, $data, $val) {
//		$sql = "UPDATE `tickerr_users` SET `$data`=? WHERE `id`=?";
//		$query = $this->db->query($sql, array($val, (int)$user));
//		return true;
//	}
//
//	// Get agents list
//	public function get_agents() {
//		$sql = "SELECT * FROM `tickerr_users` WHERE `role` = 2 OR `role` = 3";
//
//		$query = $this->db->query($sql);
//		return $query;
//	}
//
//
//    public function get_user_info_email($id) {
//        $id = $id;
//        $sql = "SELECT * FROM `tickerr_users` WHERE `email`=?";
//        $query = $this->db->query($sql, array($id));
//        return $query->row();
//    }

}