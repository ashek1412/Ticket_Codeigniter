<?php

class Ecufile_model extends CI_Model {

    // Get ECU Files

    public function get_ecu_file($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM tickerr_ecu_files WHERE `id`=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }


    // Update ECU Files
    public function upload_ecu_file($id,$filename,$uid) {


        $sql = "UPDATE tickerr_ecu_files SET ecu_file_upd=?, update_by=?,update_date=NOW(),file_stat=2 WHERE id=$id";

        $query =$this->db->query($sql, array($filename, $uid));

        if($query == true)
            return true;
        else
            return false;
    }

	 // Update ECU Files
    public function cancel_ecu_file($id,$uid) {


        $sql = "UPDATE tickerr_ecu_files SET  update_by=?,update_date=NOW(),file_stat=3 WHERE id=$id";

        $query =$this->db->query($sql, array($uid));

        if($query == true)
            return true;
        else
            return false;
    }

    // Insert ECU Files
    public function insert_ecu_file($desktop_user,$cus_name, $cus_license, $cus_vin, $cus_dtc, $v_type, $v_producer, $v_series, $v_build, $v_model,$ecu_use,$ecu_producer,$ecu_build,$ecu_nr_prd,$ecu_nr_ecu,$ecu_software, $ecu_version,$ecu_file, $ecu_file_type, $ecu_enetry_date)
    {
        $ecu_files = array(
            'desktop_user' => $desktop_user,
            'cus_name' => $cus_name,
            'cus_license' => $cus_license,
            'cus_vin' => $cus_vin,
            'cus_dtc' => $cus_dtc,
            'v_type' => $v_type,
            'v_producer' => $v_producer,
            'v_series' => $v_series,
            'v_build' => $v_build,
            'v_model' => $v_model,
            'ecu_use' => $ecu_use,
            'ecu_producer' => $ecu_producer,
            'ecu_build' => $ecu_build,
            'ecu_nr_prd' => $ecu_nr_prd,
            'ecu_nr_ecu' => $ecu_nr_ecu,
            'ecu_software' => $ecu_software,
            'ecu_version' => $ecu_version,
            'ecu_file' => $ecu_file,
            'ecu_file_type' => $ecu_file_type,
            'file_stat' => 1,
            'entry_date' => date("Y-m-d H:i:s"),
			 'user_entry_time' => $ecu_enetry_date
        );

        // Create user and return ID
        if($this->db->insert('tickerr_ecu_files', $ecu_files) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_ecu($id) {
        $sql = "DELETE from `tickerr_ecu_files`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_ecu_files_exp($userid, $rows = 20, $starting = 0, $order_by = 'id', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_ecu_files ORDER BY `$order_by` $order LIMIT $starting,$rows";
            //echo $sql;
            //exit();
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_ecu_files WHERE (`desktop_user` LIKE ? OR `cus_dtc` LIKE ? OR `ecu_file_type` LIKE ? OR `ecu_file` LIKE ? OR `entry_date` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_ecu_files($rows = 100, $starting = 0, $order_by = 'id', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_ecu_files ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_ecu_files WHERE (`desktop_user` LIKE ? OR `cus_dtc` LIKE ? OR `ecu_file_type` LIKE ? OR `ecu_file` LIKE ? OR `entry_date` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_ecu_files_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_ecu_files WHERE (`desktop_user` LIKE ? OR `cus_dtc` LIKE ? OR `ecu_file_type` LIKE ? OR `ecu_file` LIKE ? OR `entry_date` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_ecu_files_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_ecu_files`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }


     public function get_all_user_ecu_service($uname) {
        $sql = "SELECT ecu_function_id AS fid, e.func_name AS fname  FROM tickerr_desktop_user_functions f INNER JOIN tickerr_desktop_users d ON f.desktop_user_id=d.id 
INNER JOIN tickerr_ecu_functions e ON f.ecu_function_id=e.id  WHERE f.status=1 AND d.username=?";
        $query = $this->db->query($sql,$uname);
        return $query->result();
    }




   public function get_user_service_count($uname, $cdate) {

             $sql = "SELECT count(*) as cnt FROM tickerr_ecu_files WHERE `desktop_user`='$uname' AND date(entry_date)='$cdate'";
             $query = $this->db->query($sql);            
             $row = $query->row();
             return $row;

   }





}