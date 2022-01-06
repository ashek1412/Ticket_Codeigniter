<?php

class Emails_model extends CI_Model {

    // Get news information

    public function get_email($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM tickerr_emails WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}





    // Update News
	public function edit_email($uid,$nid,$email) {


        $sql = "UPDATE tickerr_emails SET email=?, update_by=?,update_at=NOW() WHERE id=$nid";

        $query =$this->db->query($sql, array($email, $uid));

        if($query == true)
		    return true;
        else
            return false;
	}

    // Update News
    public function insert_email($uid, $email) {
        $news = array(
            '`email`' => $email,
            '`create_by`' => $uid,
            '`create_at`' => date('Y-m-d H:i:s')
        );

        // Create user and return ID
        if($this->db->replace('tickerr_emails', $news) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_email($id) {
        $sql = "DELETE from `tickerr_emails`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_emails_exp($userid, $rows = 20, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_emails ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_emails WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `email` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_email($rows = 100, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_emails ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_emails WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `email` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_emails_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_emails WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `email` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_emails_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_emails`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }

	


}