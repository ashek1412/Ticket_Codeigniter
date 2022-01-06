<?php

class Ecu_model extends CI_Model {

    // Get news information

    public function get_ecu($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM tickerr_ecu WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}

    public function get_all_ecus() {

        $sql = "select * FROM tickerr_ecu order by producer";
        $query = $this->db->query($sql);
        return $query;
    }



     public function get_ecu_producer() {

        $sql = "SELECT distinct (producer) as id , producer as name FROM tickerr_ecu where producer !='*' order by producer";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

     public function get_ecu_build_by_producer($vtype) {

        $sql = "SELECT distinct (build_sgrp) as id , build_sgrp as name  FROM tickerr_ecu where producer='$vtype' order by build_sgrp";
        $query = $this->db->query($sql);
        return $query->result_array();
    }




    // Update News
	public function edit_vecu($uid,$nid,$email) {


        $sql = "UPDATE tickerr_ecu SET email=?, update_by=?,update_at=NOW() WHERE id=$nid";

        $query =$this->db->query($sql, array($email, $uid));

        if($query == true)
		    return true;
        else
            return false;
	}

    // Update News
    public function insert_ecu($type, $producer,$build ) {
        $news = array(
            '`use`' => '',
            '`producer`' => $producer,         
            '`build_grp`' => '' ,
            '`build_sgrp`' => $build 
        );

        // Create user and return ID
        if($this->db->insert('tickerr_ecu', $news) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_ecu($id) {
        $sql = "DELETE from tickerr_ecu  WHERE id=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_ecu_exp($userid, $rows = 20, $starting = 0, $order_by = 'id', $order = 'ASC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_ecu ORDER BY `$order_by` $order LIMIT $starting,$rows";
            //echo $sql;
            //exit();
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_ecu WHERE (`id` LIKE ? OR `build_grp` LIKE ? OR `producer` LIKE ? OR `build_sgrp` LIKE ? OR `use` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_ecu($rows = 100, $starting = 0, $order_by = 'producer', $order = 'ASC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_ecu ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_ecu WHERE (`id` LIKE ? OR `build_grp` LIKE ? OR `producer` LIKE ? OR `build_sgrp` LIKE ? OR `use` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_ecu_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_ecu WHERE (`id` LIKE ? OR `build_grp` LIKE ? OR `producer` LIKE ? OR `build_sgrp` LIKE ? OR `use` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_ecu_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_ecu`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }

	


}