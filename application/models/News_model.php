<?php

class News_model extends CI_Model {

    // Get news information

    public function get_news($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM tickerr_news WHERE `id`=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }


    // Update News
    public function edit_news($uid,$nid, $sub, $desc) {


        $sql = "UPDATE tickerr_news SET subject=?,description=?, update_by=?,update_at=NOW() WHERE id=$nid";

        $query =$this->db->query($sql, array($sub, $desc, $uid));

        if($query == true)
            return true;
        else
            return false;
    }

    // Update News
    public function insert_news($uid, $sub, $desc) {
        $news = array(
            '`subject`' => $sub,
            '`description`' => $desc,
            '`create_by`' => $uid,
            '`create_at`' => date('Y-m-d H:i:s')
        );

        // Create user and return ID
        if($this->db->insert('tickerr_news', $news) == true) {
            // save confirmation and return user id

            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_news($id) {
        $sql = "DELETE from `tickerr_news`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_news_exp($userid, $rows = 20, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * ,(select count(news_id) as emails from tickerr_news_emails where news_id=tickerr_news.id and sent_stat=1) cnt FROM tickerr_news ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT *,(select count(news_id) as emails from tickerr_news_emails where news_id=tickerr_news.id and sent_stat=1) cnt FROM tickerr_news WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_news($rows = 100, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT *,(select count(news_id) as emails from tickerr_news_emails where news_id=tickerr_news.id and sent_stat=1) cnt FROM tickerr_news ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * ,(select count(news_id) as emails from tickerr_news_emails where news_id=tickerr_news.id and sent_stat=1 ) cnt FROM tickerr_news WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_news_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_users WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_news_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_users`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }


    //Update News Email Count
    public function update_email_news($nid,$cnt,$type) {

        if($type=='client')
            $sql = "UPDATE tickerr_news SET email_client=? WHERE id=?";
        if($type=='customer')
            $sql = "UPDATE tickerr_news SET email_customer=? WHERE id=?";
        if($type=='email')
            $sql = "UPDATE tickerr_news SET email_list=email_list+? WHERE id=?";



        $query =$this->db->query($sql, array($cnt, $nid));

        if($query == true)
            return true;
        else
            return false;
    }



    public function get_all_desktop_news_api() {

        $sql = "SELECT id, subject,description,create_at FROM tickerr_desktop_news ORDER BY create_at DESC";
        $query = $this->db->query($sql);

        return $query->result();
    }


    public function get_desktop_news($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM tickerr_desktop_news WHERE `id`=?";
        $query = $this->db->query($sql, array($id));
        return $query->row();
    }


    public function insert_desktop_news($uid, $sub, $desc) {
        $news = array(
            '`subject`' => $sub,
            '`description`' => $desc,
            '`create_by`' => $uid,
            '`create_at`' => date('Y-m-d H:i:s')
        );

        // Create user and return ID
        if($this->db->insert('tickerr_desktop_news', $news) == true) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function delete_desktop_news($id) {
        $sql = "DELETE from `tickerr_desktop_news`  WHERE `id`=?";
        $query = $this->db->query($sql, $id);
        if($query == true)
            return true;
        else
            return false;
    }


    public function get_all_desktop_news_exp($userid, $rows = 20, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_desktop_news ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_desktop_news WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function get_all_desktop_news($rows = 100, $starting = 0, $order_by = 'create_at', $order = 'DESC', $search = false) {
        if($search == false) {
            $sql = "SELECT * FROM tickerr_desktop_news ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql);
        }else{
            $search = "%$search%";
            $sql = "SELECT * FROM tickerr_desktop_news WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?) ORDER BY `$order_by` $order LIMIT $starting,$rows";
            $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        }
        return $query;
    }


    public function count_search_all_desktop_news_exp($userid, $search) {
        $search = "%$search%";
        $sql = "SELECT COUNT(*) as c FROM tickerr_desktop_news WHERE (`id` LIKE ? OR `create_by` LIKE ? OR `subject` LIKE ? OR `create_at` LIKE ? OR `update_at` LIKE ?)";
        $query = $this->db->query($sql, array($search, $search, $search, $search, $search));
        $row = $query->row();
        return $row->c;
    }

    public function count_all_desktop_news_exp($userid) {
        $sql = "SELECT COUNT(*) as c FROM `tickerr_desktop_news`";
        $query = $this->db->query($sql);
        $row = $query->row();
        return $row->c;
    }









}