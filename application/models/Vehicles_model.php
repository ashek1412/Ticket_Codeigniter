<?php

class Vehicles_model extends CI_Model {

    // Get news information

    public function get_vehicle($id) {
		$id = (int)$id;
		$sql = "SELECT * FROM tickerr_vehicles WHERE `id`=?";
		$query = $this->db->query($sql, array($id));
		return $query->row();
	}


    public function get_all_vehicles() {

        $sql = "select id,if(type='PKW','Passenger Car', type) as type,producer,series,build,model FROM tickerr_vehicles order by type";
        $query = $this->db->query($sql);
        return $query;
    }

    public function get_vehicles_type() {

        $sql = "SELECT distinct (type) as type, if(type='PKW','Passenger Car', type) as name FROM tickerr_vehicles order by type";
        $query = $this->db->query($sql);
        return $query;
    }


    public function get_vehicles_producer() {

        $sql = "SELECT distinct (producer) as producer FROM tickerr_vehicles order by producer";
        $query = $this->db->query($sql);
        return $query;
    }

     public function get_vehicle_producer_by_type($vtype) {

        $sql = "SELECT distinct (producer) as id , producer as name  FROM tickerr_vehicles where type='$vtype' order by producer";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	  public function get_vehicle_series($vtype, $vprod) {

        $sql = "SELECT distinct (series) as id , series as name  FROM tickerr_vehicles where type='$vtype' and producer='$vprod' order by series";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	 public function get_vehicle_builds($vtype, $vprod, $vseries) {

        $sql = "SELECT distinct (build) as id , build as name  FROM tickerr_vehicles where type='$vtype' and producer='$vprod' and series='$vseries' order by build";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

	 public function get_vehicle_models($vtype, $vprod, $vseries , $vbuild) {

		if($vbuild!="0")
      	  $sql = "SELECT distinct (model) as id , model as name  FROM tickerr_vehicles where type='$vtype' and producer='$vprod' and series='$vseries' and build='$vbuild'  order by model";
		else
		  $sql = "SELECT distinct (model) as id , model as name  FROM tickerr_vehicles where type='$vtype' and producer='$vprod' and series='$vseries'  order by model";
	
        $query = $this->db->query($sql);
        return $query->result_array();
    }




    // Update News
	public function edit_vehicle($uid,$nid,$email) {


        $sql = "UPDATE tickerr_vehicles SET email=?, update_by=?,update_at=NOW() WHERE id=$nid";

        $query =$this->db->query($sql, array($email, $uid));

        if($query == true)
		    return true;
        else
            return false;
	}

    // Update News
    public function insert_vehicle($type, $producer,$series, $build,$model ) {
        $news = array(
            '`type`' => $type,
            '`producer`' => $producer,
            '`series`' => $series,
            '`build`' => $build,
            '`model`' =>  $model          
        );

        // Create user and return ID
        if($this->db->insert('tickerr_vehicles', $news) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_vehicle($id) {
        $sql = "DELETE from `tickerr_vehicles`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_vehicles_exp($userid, $rows = 20, $starting = 0, $order_by = 'id', $order = 'ASC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_vehicles ORDER BY `$order_by` $order LIMIT $starting,$rows";
            //echo $sql;
            //exit();
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_vehicles WHERE (`id` LIKE ? OR `type` LIKE ? OR `producer` LIKE ? OR `series` LIKE ? OR `build` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_vehicle($rows = 100, $starting = 0, $order_by = 'type', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_vehicles ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_vehicles WHERE (`id` LIKE ? OR `type` LIKE ? OR `producer` LIKE ? OR `series` LIKE ? OR `build` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_vehicles_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_vehicles WHERE (`id` LIKE ? OR `type` LIKE ? OR `producer` LIKE ? OR `series` LIKE ? OR `build` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_vehicles_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_vehicles`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }

	


}