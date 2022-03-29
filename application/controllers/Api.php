<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

    }

    function index()
    {
        $data = $this->api_model->fetch_all_desktop_user();
        echo json_encode($data);
    }
	
	public function download_file()
    {
		 if($this->input->post('fname')) 
		 {
			 $path= FCPATH . 'desktop_files/' . $this->input->post('fname');
			 
			 if (file_exists($path)) {
				 $mm_type="application/octet-stream";
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Cache-Control: public");
					header("Content-Description: File Transfer");
					header("Content-Type: " . $mm_type);
					header("Content-Length: " .(string)(filesize($path)) );
					header('Content-Disposition: attachment; filename="'.basename($path).'"');
					header("Content-Transfer-Encoding: binary\n");
					readfile($path); 
					exit();

			 }
			  else {
					header('HTTP/1.0 401 Unauthorized', true, 401);

					}


		 }	

	}

    public function verify_credentials()
    {
       
        $output['stat']=0;
        if($this->input->post('user')) {
             $this->load->model('Api_model', 'api_model', true);
           

            $user = $this->input->post('user');
            $pass = md5($this->input->post('pass'));
			$machine_id = $this->input->post('machine_id');

            $output['user_sl']="";
            $output['exp_date']="";

            if($user == null || strlen($user) < 5)
            {
                $output['stat']=3;
                echo json_encode($output);
            }
            if($pass == null || strlen($pass) < 5) {
                $output['stat']=4;
                echo json_encode($output);

            }

            if($this->api_model->validate_session($user, $pass) == true)
            {
				if($this->api_model->validate_machine($user,$machine_id) == false)
           		 {
               		 $output['stat']=5;
               		 echo json_encode($output);
          	 	 }
				else
				{	
                    $duser=$this->api_model->get_desktop_user($user);
                	$output['stat']=1;
                    $output['user_sl']=$duser[0]['sl_num'];
                    $output['exp_date']=$duser[0]['exp_date'];
                	echo json_encode($output);
				}
            }			
            else
            {
                $output['stat']=0;
                echo json_encode($output);

            }

        }
        else
        {
            $output['stat'] = 0;
            echo json_encode($output);
        }


    }



	public function verify_user_exists()
    {
         
      		
           $this->load->model('Api_model', 'api_model', true);

		// Check if username already exists
			if($this->api_model->check_existing_username($_POST['user']) == true) {
				$output['stat'] = 1;
            	echo json_encode($output);
			}
			
			// Check if email already exists
			else if($this->api_model->check_existing_email($_POST['email']) == true) {
				
				$output['stat'] = 2;
            	echo json_encode($output);
			}					
			else
			{

				$output['stat'] = 0;
            	echo json_encode($output);

			}


	}

	public function new_account() {

			$this->load->model('Api_model', 'api_model', true);
			$this->load->model('Settings_model', 'settings_model', true);
			if($this->input->post('user') != null ) 
			{


				$username=$this->input->post('user');
                $email=$this->input->post('email');
                $name=$this->input->post('fname');
                $company=$this->input->post('cname');
                $phone=$this->input->post('phone');
                $country=$this->input->post('country');
                $password=$this->input->post('pass');
                $mac=$this->input->post('umac');
                $local_ip=$this->input->post('lip');
                $public_ip=$this->input->post('eip');
				$machine_id=$this->input->post('machine_id');				 


                $conf_str=$this->input->post('conf_str');
				$user = $this->api_model->new_account($name, $username, $email, $password, $company, $phone, $country, $mac, $local_ip,$public_ip,$machine_id);
				if($user != false) 
				{

                    //$ecu_functions=$this->api_model->get_all_ecu_function();
                    //foreach($ecu_functions as $cl) {
					//   $insecu= $this->api_model->new_account_ecu_function($user,$cl->func_code);
                   // }
				
					// Get email settings
					$config = $this->settings_model->get_email_settings();
					$email_info = $this->settings_model->get_email_info();
					$email_specific = $this->settings_model->get_email_specific('email_new_account');
					
					$config['mailtype'] = 'html';
					
					// Load library and prepare info
					$this->load->library('email');
					$this->email->initialize($config);
					
					$this->email->from($email_info['email_from_address'], $email_info['email_from_name']);
					$this->email->to($email_info['email_from_address']);
					$this->email->cc('ashek1412@gmail.com');
					
					$this->email->subject('New Desktop User is created');
					
					$msg="New Desktop User is created with following Details,<br />Name :".$name."<br />Email:".$email."<br />Company :".$company;
					$this->email->message($msg);
					$this->email->send();		
					$output['stat'] =1;
            		echo json_encode($output);	
	
				}
				else
				{
					
					$output['stat'] = 0;
            		echo json_encode($output);
				}
			}
    }


    public function new_ecu_file() {

	 $this->load->model('Ecufile_model', 'ecufile_model', true);
	 $this->load->model('Settings_model', 'settings_model', true);
	if($this->input->post('desktop_user') != null ) 
	{
           $desktop_user=$this->input->post('desktop_user');  
           $cus_name=$this->input->post('cus_name');    
           $cus_license=$this->input->post('cus_license');
           $cus_vin=$this->input->post('cus_vin');
           $cus_dtc=$this->input->post('cus_dtc');
               
           $v_type=$this->input->post('v_type');
           $v_producer=$this->input->post('v_producer');
           $v_series=$this->input->post('v_series');
           $v_build=$this->input->post('v_build');
           $v_model=$this->input->post('v_model');

           $ecu_use=$this->input->post('ecu_use');
           $ecu_producer=$this->input->post('ecu_producer');
           $ecu_build=$this->input->post('ecu_build');
           $ecu_nr_prd=$this->input->post('ecu_nr_prd');
           $ecu_nr_ecu=$this->input->post('ecu_nr_ecu');
           $ecu_software=$this->input->post('ecu_software');
           $ecu_version=$this->input->post('ecu_version');
           $ecu_file_type=$this->input->post('ecu_file_type');
           $ecu_enetry_date=$this->input->post('entry_date');
           //$ecu_file=$this->input->post('ecu_file');
           //echo "<pre>";
          // print_r($_FILES);
           //echo "</pre>";

          
           $this->load->helper('upload_helper');        
		   $this->load->helper('ini_filesizes_helper');
           $file_ext = strtolower(pathinfo($_FILES['ecu_file']['name'], PATHINFO_EXTENSION));
           $now=date("Ymd_His");
           $ecu_file = $desktop_user."_".$now."_".$_FILES['ecu_file']['name'];
           $cnf = array(
                    'upload_path' => FCPATH . 'desktop_files/',
                    'allowed_types' =>'*',
                    'file_name' => $desktop_user."_".$now."_".$_FILES['ecu_file']['name'],
                    'overwrite' => true
            );

			 $this->upload->initialize($cnf);

            if($this->upload->do_upload('ecu_file') == false) {

					$output['stat'] =  $error = array('error' => $this->upload->display_errors());;
            		echo json_encode($output);

			}
			else
			{
		 
        

               
 		   $user = $this->ecufile_model->insert_ecu_file($desktop_user,$cus_name, $cus_license, $cus_vin, $cus_dtc, $v_type, $v_producer, $v_series, $v_build, $v_model,$ecu_use,$ecu_producer,$ecu_build,$ecu_nr_prd,$ecu_nr_ecu,
                                                         $ecu_software, $ecu_version,$ecu_file, $ecu_file_type, $ecu_enetry_date);
				if($user != false) 
				{
				
					// Get email settings
					$config = $this->settings_model->get_email_settings();
					$email_info = $this->settings_model->get_email_info();
					$email_specific = $this->settings_model->get_email_specific('email_new_account');
					
					$config['mailtype'] = 'html';
					
					// Load library and prepare info
					$this->load->library('email');
					$this->email->initialize($config);
					
					$this->email->from($email_info['email_from_address'], $email_info['email_from_name']);
					$this->email->to($email_info['email_from_address']);
					$this->email->cc('ashek1412@gmail.com');
					
					$this->email->subject('New File Submitted by Dektop User');
					
					$msg="New File Submitted by Dekstop User with following Details,<br />User :".$desktop_user."<br />File Type:".$ecu_file_type."<br />Dtc :".$cus_dtc."<br />File Name :".$ecu_file;
					$this->email->message($msg);
					$this->email->send();		
					$output['stat'] =$user;
            		echo json_encode($output);	
	
				}
				else
				{
					
					$output['stat'] = 0;
            		echo json_encode($output);
				}
			}
		}
    }


	function check_ecu_file()
	{
			$this->load->model('Ecufile_model', 'ecufile_model', true);
			//$this->load->model('Settings_model', 'settings_model', true);
			if($this->input->post('ecu_file_id') != null ) 
			{
				$id=$this->input->post('ecu_file_id');  
				$ecu_file =$this->ecufile_model->get_ecu_file($id);
				//$output['stat']=$ecu_file->id;
				
				if($ecu_file->file_stat=='2')
				{

					$output['stat'] = 1;
					$output['file'] = $ecu_file->ecu_file_upd;
            		echo json_encode($output);	

				}
               else if($ecu_file->file_stat=='3')
				{

					$output['stat'] =3;
					$output['file'] = "";
            		echo json_encode($output);	

				}
				else
				{
					$output['stat'] = -1 ;
					$output['file']="";
            		echo json_encode($output);		

				}


			}
			

	}



    function insert()
    {
        $this->form_validation->set_rules("first_name", "First Name", "required");
        $this->form_validation->set_rules("last_name", "Last Name", "required");
        $array = array();
        if($this->form_validation->run())
        {
            $data = array(
                'first_name' => trim($this->input->post('first_name')),
                'last_name'  => trim($this->input->post('last_name'))
            );
            $this->api_model->insert_api($data);
            $array = array(
                'success'  => true
            );
        }
        else
        {
            $array = array(
                'error'    => true,
                'first_name_error' => form_error('first_name'),
                'last_name_error' => form_error('last_name')
            );
        }
        echo json_encode($array, true);
    }

   

   
    public function get_vehicle_info()
    {
        $this->load->model('Vehicles_model', 'vehicles_model', true);
        $output=$this->vehicles_model->get_all_vehicles();
         ///   $output['stat'] = 0;
            echo json_encode($output->result());
     }

     public function get_ecu_info()
    {
        $this->load->model('Ecu_model', 'ecu_model', true);
        $output=$this->ecu_model->get_all_ecus();
         ///   $output['stat'] = 0;
            echo json_encode($output->result());
     }


    public function get_user_ecu_service()
    {

        if($this->input->post('user'))
        {
            $this->load->model('Ecufile_model', 'ecufile_model', true);
			$this->load->model('Api_model', 'api_model', true);
            $output=$this->ecufile_model->get_all_user_ecu_service($this->input->post('user'));
			
			
			if($this->input->post('app_ver'))
				$this->api_model->update_user_app_ver($this->input->post('user'), $this->input->post('app_ver'));

         ///   $output['stat'] = 0;
            echo json_encode($output);

        }
     }



    public function get_desktop_news()
    {
            $this->load->model('News_model', 'news_model', true);
            $output=$this->news_model->get_all_desktop_news_api();      
            echo json_encode($output);
     }



	public function get_desktop_user_by_mac()
    {
		if($this->input->post('mac_id'))
		{
			$mac_id=$this->input->post('mac_id');
			
            $this->load->model('Api_model', 'api_model', true);
            $res=$this->api_model->get_desktop_user_mac($mac_id);             
			
			if(isset($res))
			{		
					$hash=$res->conf_str;
					$verify = password_verify($res->machine_id, $hash); 					
					// Print the result depending if they match 
					if (true) { 
						
							$output['stat'] = 1;
							$output['fname'] = $res->name;
							$output['email'] = $res->email;
							$output['phone'] = $res->phone;
							
							$output['status'] = $res->active;


					} else { 
							$output['stat'] =0 ;
							$output['fname'] = "";
							$output['email'] = "";
							$output['phone'] = "";
							$output['status'] = "";
					} 

			}
			else
			{
							$output['stat'] ="2" ;
							$output['fname'] = "";
							$output['email'] = "";
							$output['phone'] = "";
							$output['status'] = "";
			}
			echo json_encode($output);
		}
     }


	public function verify_desktop_user_by_mac()
    {
		
		if($this->input->post('mac_id'))
		{
			$new_devid="";
			$mac_id=$this->input->post('mac_id');
			$local_ip=$this->input->post('local_ip');
			$public_ip=$this->input->post('public_ip');
			//if(isset($this->input->post('new_devid')))
			$new_devid=$this->input->post('new_devid');
            $this->load->model('Api_model', 'api_model', true);
			 $this->load->model('Settings_model', 'settings_model', true);
            $res=$this->api_model->verify_desktop_user_mac($mac_id);             
			
					if(isset($res))
					{		
							$hash=$res->conf_str;
							$verify = password_verify($res->machine_id, $hash); 					
							// Print the result depending if they match 
							if (true) { 


								$settings = array('ecu_service_status', 'ecu_service_stime','ecu_service_etime','ecu_file_limit_per_day');
								$service_status = $this->settings_model->get_multiple_settings($settings);
								
								
									$output['stat'] = 1;
									$output['fname'] = $res->name;
									$output['email'] = $res->email;
									$output['uname'] = $res->username;
									$output['phone'] = $res->phone;
									$output['device_id'] = $res->usb_key;
									$output['device_pkey'] = $res->usb_pkey;
									$output['status'] = $res->active;
									$output['sl_num'] = $res->sl_num;
									$output['exp_date'] = $res->exp_date;
									$output['machine_id'] = $res->machine_id;
									$output['service_status'] = $service_status->ecu_service_status;
									$output['service_stime'] = $service_status->ecu_service_stime;
									$output['service_etime'] = $service_status->ecu_service_etime;
                                    $output['ecufile_limit'] = $service_status->ecu_file_limit_per_day;
									if(strlen($res->temp_id)>1 && strlen($new_devid)>5)
									{
										$this->api_model->update_user_mac_info($res->email,$new_devid);    
									}
									


							} else { 
									$output['stat'] =0 ;
									$output['fname'] = "";
									$output['email'] = "";
									$output['phone'] = "";
									$output['status'] = "";
							} 

					}
					else
					{
									$output['stat'] ="2" ;
									$output['fname'] = "";
									$output['email'] = "";
									$output['phone'] = "";
									$output['status'] = "";
					}
			echo json_encode($output);
		}
     }




	function update_usb_info()
    {
       if($this->input->post('user'))
	   {
		   	$user=$this->input->post('user');
			$pkey=$this->input->post('pkey');
			$usbkey=$this->input->post('usbkey');			   


            $this->load->model('Api_model', 'api_model', true);
            $res=$this->api_model->update_user_usb_info($user,$pkey, $usbkey); 
			$output['stat']=$res;
			echo json_encode($output);

	   }
        
    }


	public function get_desktop_user_by_email()
    {
		
		if($this->input->post('email'))
		{
			$email=$this->input->post('email');
		
            $this->load->model('Api_model', 'api_model', true);
            $res=$this->api_model->get_desktop_user_email($email);             
			
					if(isset($res))
					{		
									if(DateTime::createFromFormat('Y-m-d H:i:s', $res->usb_date) !== false && $res->usb_date!="0000-00-00 00:00:00")
									{
												$output['usb_date'] = $res->usb_date;
										
									}
									
																	
									$output['stat'] = 1;
									$output['fname'] = $res->name;
									$output['email'] = $res->email;
									$output['cname'] = $res->company;
									$output['phone'] = $res->phone;
									$output['mac_id'] = $res->machine_id;
								
									$output['date'] = $res->date;
									$output['status'] = $res->active;
									$output['sl_num'] = $res->sl_num;
									$output['reg_date'] = $res->date;
									
									
						
					}
					else
					{
									$output['stat'] =0 ;
									$output['fname'] = "";
									$output['email'] = "";
									$output['phone'] = "";
									
					}
			echo json_encode($output);
		}
     }



	public function get_vehicle_producer()
    {

			if($this->input->get('vtype'))
			{
                    
					 $this->load->model('Vehicles_model', 'vehicle_model', true);
					 $res=$this->vehicle_model->get_vehicle_producer_by_type($this->input->get('vtype'));  
                    if(isset($res))
					{
                       echo json_encode($res);

                    }

			}

	}


	public function get_vehicle_series()
    {

			if($this->input->get('vtype') && $this->input->get('vprod'))
			{
                    
					 $this->load->model('Vehicles_model', 'vehicle_model', true);
					 $res=$this->vehicle_model->get_vehicle_series($this->input->get('vtype'),$this->input->get('vprod'));  
                    if(isset($res))
					{
                       echo json_encode($res);

                    }

			}

	}

	public function get_vehicle_builds()
    {

			if($this->input->get('vtype') && $this->input->get('vprod') && $this->input->get('vseries'))
			{
                    
					 $this->load->model('Vehicles_model', 'vehicle_model', true);
					 $res=$this->vehicle_model->get_vehicle_builds($this->input->get('vtype'),$this->input->get('vprod'),$this->input->get('vseries'));  
                    if(isset($res))
					{
                       echo json_encode($res);

                    }

			}

	}


	public function get_vehicle_models()
    {

			if($this->input->get('vtype') && $this->input->get('vprod') && $this->input->get('vseries')  && $this->input->get('vbuild'))
			{
                    
					 $this->load->model('Vehicles_model', 'vehicle_model', true);
					 $res=$this->vehicle_model->get_vehicle_models($this->input->get('vtype'),$this->input->get('vprod'),$this->input->get('vseries'),$this->input->get('vbuild'));  
                    if(isset($res))
					{
                       echo json_encode($res);

                    }

			}

	}

	public function get_ecu_producer()
    {

			if($this->input->get('vtype'))
			{
                    
					 $this->load->model('Ecu_model', 'ecu_model', true);
					 $res=$this->ecu_model->get_ecu_producer();  
                     if(isset($res))
					 {
                        echo json_encode($res);

                     }

			}

	}


    public function get_ecu_builds()
    {

			if($this->input->get('vprod'))
			{
                    
					$this->load->model('Ecu_model', 'ecu_model', true);
					$res=$this->ecu_model->get_ecu_build_by_producer($this->input->get('vprod'));  
                    if(isset($res))
					{
                       echo json_encode($res);

                    }

			}

	}


     public function get_user_ecufile_count()
    {

			if($this->input->post('user'))
			{
                    
					$this->load->model('Ecufile_model', 'ecufile_model', true);
					$res=$this->ecufile_model->get_user_service_count($this->input->post('user'),$this->input->post('cdate'));  
                    if(isset($res))
					{
                        $output['stat']=$res->cnt;
                        echo json_encode( $output);

                    }

			}

	}


}


