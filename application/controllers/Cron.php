<?php
class Cron extends CI_Controller {

 
    public function send_news_emails() {

        $this->load->model('News_email_model', 'news_email_model', true);
        $this->load->model('Settings_model', 'settings_model', true);
        $this->load->model('News_model', 'news_model', true);
        $all_pending_emails = $this->news_email_model->pending_news_emails();
        $email_info = $this->settings_model->get_email_info();
		$email_specific = $this->settings_model->get_email_specific('email_new_account');
        $config = $this->settings_model->get_email_settings();
        $cnt_client=$cnt=$ar=0;

        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();


        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'gsgpm1024.siteground.biz';
        $mail->SMTPAuth = true;
        $mail->Username = 'info@news-vzperformance.com';
        $mail->Password = 'wjq7261000333';
        $mail->SMTPSecure = 'ssl';
        $mail->Port     = 465;
        $mail->CharSet = "utf-8";

        $mail->setFrom('info@news-vzperformance.com', 'vz-performance');
        $mail->addReplyTo('info@news-vzperformance.com', 'Reply');
        $cnt_client=$cnt=$ar=0;
        $news_ar=array();
        $prev_news="";

        foreach($all_pending_emails as $cl)
		{
                    if($prev_news != $cl->news_id)
                    {
                        $news_info = $this->news_model->get_news($cl->news_id);
                        $subject= $news_info->subject;
                        $description=$news_info->description;
                        //$email_cnt=$news_info->email_list;
                    }
                    // Add a recipient
                    $mail->addAddress($cl->email);
                    // Email subject
                    $mail->Subject =$subject;
                    // Set email format to HTML
                    $mail->isHTML(true);

                    // Email body content
                    $mailContent =  $description;
                    $mail->Body = $mailContent;

                    // Send email
                    if(!$mail->send()){
                        echo '</br>Message could not be sent'.$cl->email;
                        echo 'Mailer Error: ' . $mail->ErrorInfo;
                    }else{
                         //echo '</br>Message has been sent'.$cl->email;
                          $this->news_email_model->update_news_emails($cl->id); 
                          $cnt_client++;

                          if($cnt_client%10==0)
                              sleep(2);

                    }

                    $mail->clearAddresses();
                    $prev_news=$cl->news_id;
                    $cnt++;
        }

        echo "Total mail sent: ".$cnt_client;
     

    }


}