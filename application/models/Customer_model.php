<?php

class Customer_model extends CI_Model {

    // Get news information

    public function get_customer($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM tickerr_customers WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}

    public function get_customer_by_vin($id) {
       //id = (int)$id;
        $sql = "SELECT * FROM tickerr_customers WHERE vin_num=? OR license_num=? ";
        $query = $this->db->query($sql, array($id,$id));
        return $query->row();
    }




    // Update Customer
	public function edit_customer($uid,$name,$license_num, $vin_num, $displacement,$horsepower,$year,$srv_content,$srv_time,$upd_place,$email,$phone,$update_by) {


        $sql = "UPDATE tickerr_customers SET name=?,license_num=?, vin_num=?, displacement=?, horsepower=?, year=?,srv_content=?,srv_time=?,upd_place=?,email=?,phone=?,update_by=?, update_at=NOW() WHERE id=$uid";

        $query =$this->db->query($sql, array($name,$license_num, $vin_num, $displacement,$horsepower,$year,$srv_content,$srv_time,$upd_place,$email,$phone,$update_by));

        if($query == true)
		    return true;
        else
            return false;
	}

    // Update Customer
    public function insert_customer($name,$license_num, $vin_num, $displacement,$horsepower,$year,$srv_content,$srv_time,$upd_place,$email,$phone,$create_by) {
        $news = array(
            '`name`' => $name,
            '`license_num`' => $license_num,
            '`vin_num`' => $vin_num,
            '`displacement`' => $displacement,
            '`horsepower`' => $horsepower,
            '`year`' => $year,
            '`srv_content`' => $srv_content,
            '`srv_time`' => $srv_time,
            '`upd_place`' => $upd_place,
            '`email`' => $email,
            '`phone`' => $phone,
            '`create_by`' => $create_by,
            '`create_at`' => date('Y-m-d H:i:s')
        );

        // Create user and return ID
        if($this->db->insert('tickerr_customers', $news) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_customer($id) {
        $sql = "DELETE from `tickerr_customers`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_customers_exp($userid, $rows = 20, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_customers ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_customers WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `name` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_customers($rows = 100, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_customers ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_customers WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `name` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_customers_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_customers WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `name` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_customers_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_customers`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }

    public function get_agent_customers_exp($userid, $rows = 20, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_customers WHERE create_by=? ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql,array($userid));
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_customers WHERE create_by=? AND (`id` LIKE ? OR `create_by` LIKE ? OR `name` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($userid,$search, $search, $search, $search, $search));
        }
        return $query;
    }

    public function count_search_agent_customers_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_customers WHERE create_by=? AND (`id` LIKE ? OR `create_by` LIKE ? OR `name` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?)";
        $query = $this->db->query($sql, array($userid,$search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }


    public function count_agent_customers_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_customers` where create_by=?";
        $query = $this->db->query($sql,array($userid));
        $row = $query->row();
        return $row->c;
    }


	public function count_all_users_exp($userid) {
		$sql = "SELECT COUNT(*) as c FROM `tickerr_users`";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->c;
	}

	


}