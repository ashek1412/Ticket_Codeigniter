<?php
class News_email_model extends CI_Model {

    public function pending_news_emails() {

        $sql = "SELECT te.* ,e.email FROM tickerr_news_emails te INNER JOIN tickerr_emails e ON e.id=te.email_id INNER JOIN tickerr_news n ON n.id=te.news_id WHERE te.sent_stat =0 AND te.news_id> 20 ORDER BY te.news_id, e.id desc LIMIT 300";
        $query = $this->db->query($sql);
         //$row = $query->rows();
        return $query->result();


    }


    public function update_news_emails($id) {

         $sql = "UPDATE tickerr_news_emails SET sent_stat=1,sent_time=NOW() WHERE id=?";

        $query =$this->db->query($sql, array($id));

        if($query == true)
		    return true;
        else
            return false;
        
        $query = $this->db->query($sql);
         //$row = $query->rows();
        return $query->result();


    }



}