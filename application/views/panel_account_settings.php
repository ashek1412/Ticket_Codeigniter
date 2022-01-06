<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">


		<div class="page-title-cont clearfix">
			<h3><?php echo $this->lang->line('text_account_settings');?></h3>
		</div>

        <ul class="nav nav-pills"  >
            <li class="active" style="background-color: gainsboro;"><a href="#t1" data-toggle="tab" style="font-weight: bold; "><?php echo $this->lang->line('text_basic_settings');?></a></li>
            <li style="background-color: gainsboro;"><a href="#t2" data-toggle="tab" style="font-weight: bold;"><?php echo $this->lang->line('text_Tools');?></a></li>
            <li style="background-color: gainsboro;"><a href="#t3" data-toggle="tab" style="font-weight: bold;"><?php echo $this->lang->line('text_download');?></a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="t1">
                <div class="row" >
                    <div class="col col-xs-12">
                    <div class="cont clearfix">


                        <p class="bg-danger bg-danger1" style="display:none;"></p>

                        <form method="POST" action="<?php echo $base_url; ?>panel/account-settings/basic-settings" name="basic-settings">
                            <div class="row no-bottom-margin">
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="user_name"><?php echo $this->lang->line('text_name');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_here_goes_your_name');?></span>
                                        <input type="text" name="user_name" id="user_name" value="<?php echo $user_info->name; ?>" />
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="user_email"><?php echo $this->lang->line('text_email');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_here_goes_your_email_address');?></span>
                                        <input type="text" name="user_email" id="user_email" value="<?php echo $user_info->email; ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="row no-bottom-margin" style="margin-top:10px;">
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="radios"><?php echo $this->lang->line('text_receive_email_on_ticket_activity');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_enable_this_option_to_receive_an_email_when_a_ticket_of_mine_has_a_new_reply');?></span>
                                        <div class="radio">
                                            <input type="radio" name="email_on_tactivity" id="radio_1" class="green" value="1" <?php if($user_info->email_on_tactivity == '1') echo 'checked '; ?>/>
                                            <label for="radio_1"><?php echo $this->lang->line('text_enabled');?></label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="email_on_tactivity" id="radio_2" class="gray" value="0" <?php if($user_info->email_on_tactivity == '0') echo 'checked '; ?>/>
                                            <label for="radio_2"><?php echo $this->lang->line('text_disabled');?></label>
                                        </div>
                                    </div>

                                        <div class="form-group">
                                            <label for="user_expdate"><?php echo $this->lang->line('text_Membership_Expiration_Date');?></label>

                                            <label style="color: #dd0000"> <?php echo date("d-M-Y",strtotime( $user_info->exp_date)); ?> </label>
                                        </div>

                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="radios"><?php echo $this->lang->line('text_receive_email_on_bug_report_activity');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_enable_this_option_to_receive_an_email_when_a_bug_report_of_mine_has_a_new_status');?></span>
                                        <div class="radio">
                                            <input type="radio" name="email_on_bactivity" id="radio_3" class="green" value="1" <?php if($user_info->email_on_bactivity == '1') echo 'checked '; ?>/>
                                            <label for="radio_3"><?php echo $this->lang->line('text_enabled');?></label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="email_on_bactivity" id="radio_4" class="gray" value="0" <?php if($user_info->email_on_bactivity == '0') echo 'checked '; ?>/>
                                            <label for="radio_4"><?php echo $this->lang->line('text_disabled');?></label>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <input type="submit" name="submit" class="btn btn-strong-blue pull-right" value="<?php echo $this->lang->line('text_save');?>" />
                        </form>
                    </div>
                </div>
            </div>
		
            <div class="row">
                <div class="col col-xs-12">
                    <div class="cont clearfix">
                        <div class="top clearfix">
                            <h4 class="pull-left"><?php echo $this->lang->line('text_change_profile_picture');?></h4>
                        </div>

                        <p class="bg-danger bg-danger2" style="display:none;"></p>

                        <form method="POST" action="<?php echo $base_url; ?>panel/account-settings/change-pp" name="change-pp" enctype="multipart/form-data">
                            <div class="row no-bottom-margin">
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="user_name"><?php echo $this->lang->line('text_current_picture');?></label>
                                        <?php
                                        $_2x = asset_url() . 'img/profile_img/' . $user_info->profile_img2x;
                                        $_3x = asset_url() . 'img/profile_img/' . $user_info->profile_img3x;
                                        ?>
                                        <img src="<?php echo $_2x; ?>" srcset="<?php echo $_2x; ?> 1x, <?php echo $_2x; ?> 2x, <?php echo $_3x; ?> 3x" width="90" height="90" />
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="user_email"><?php echo $this->lang->line('text_upload_new_image');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('The_picture_dimensions_MUST_BE_square');?></span>

                                        <div class="file" style="margin-top:5px;">
                                            <button name="select_profile_picture" class="btn btn-upload-file btn-light-blue"><?php echo $this->lang->line('text_select_file_to_upload');?></button>
                                            <input type="file" name="new_profile_picture" style="display:none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-strong-blue pull-right" value="<?php echo $this->lang->line('text_upload_and_save');?>" />
                        </form>
                    </div>
                </div>
            </div>
		
            <div class="row">
                <div class="col col-xs-12">
                    <div class="cont clearfix">
                        <div class="top clearfix">
                            <h4 class="pull-left"><?php echo $this->lang->line('text_change_password');?> </h4>
                        </div>

                        <?php
                        if($change_password_error == true)
                            echo '<p class="bg-danger bg-danger3">'.$this->lang->line("The_current_password_you_typed_is_not_correct").'</p>';
                        elseif($change_password_success == true)
                            echo '<p class="bg-success">'.$this->lang->line("Password_successfully_changed").'</p>';
                        else
                            echo '<p class="bg-danger bg-danger3" style="display:none;"></p>';
                        ?>

                        <form method="POST" action="<?php echo $base_url; ?>panel/account-settings/change-password" name="change-password">
                            <div class="row no-bottom-margin">
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="current_password"><?php echo $this->lang->line('text_current_password');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_type_here_your_current_password');?></span>
                                        <?php
                                        if($change_password_error == true)
                                            echo '<input type="password" name="current_password" id="current_password" class="error" />';
                                        else
                                            echo '<input type="password" name="current_password" id="current_password" />';
                                        ?>
                                    </div>
                                </div>

                                <div class="col col-md-6">
                                    <div class="form-group">
                                        <label for="new_password"><?php echo $this->lang->line('text_new_password');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_type_here_your_new_password_it_must_be_at_least_5_characters_long');?></span>
                                        <input type="password" name="new_password" id="new_password" />
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password"><?php echo $this->lang->line('text_repeat_password');?></label>
                                        <span class="label_desc"><?php echo $this->lang->line('text_repeat_your_new_password');?></span>
                                        <input type="password" name="new_rpassword" id="new_rpassword" />
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-strong-blue pull-right" value="<?php echo $this->lang->line('text_change_password');?>" />
                        </form>
                    </div>
                    </div>
              </div>
	        </div>
            <div class="tab-pane" id="t2">
                <div class="row">

                    <div class="col col-xs-12">
                        </br>

                        <div class="cont clearfix">
                            <h4><?php echo $this->lang->line('text_Your_Tools');?>                            </h4>
                            <table style="width: 100%;height: auto;">
                                <?php
                                $cnt=0;
                                $prev_sl="";
                                foreach($current_user_serial_info as $row) {

                                    if($cnt>0 && $prev_sl== $row->name )
                                    {

                                        echo "<tr><td style='font-size: 12px;'>S/N : " . $row->serial."</td>";
                                        echo "<td style='font-size:12px; width: 30%;text-align: left;'></td></tr>";
                                        //  $prev_sl= $row->name;
                                        //   $cnt++;
                                        // continue;


                                    }
                                    else
                                    {
                                        if($cnt>0) {
                                            echo  '</td></tr><tr style="border-top: 1px solid black;">';
                                            echo '<td  >';
                                            echo "<b>" . $row->name . "</b></td></tr>";
                                            echo "<tr ><td style='font-size: 12px;'>S/N :" . $row->serial."</td>";
                                            echo "<td style='font-size:12px; width: 30%;text-align: left;'></td></tr>";




                                        }
                                        else
                                        {
                                            echo  '<tr">';
                                            echo '<td >';
                                            echo "<b>" . $row->name . "</b></td></tr>";
                                            echo "<tr><td style='font-size: 12px;'>S/N :" . $row->serial."</td>";
                                            echo "<td style='font-size:12px; width: 30%;text-align: left;'></td></tr>";


                                        }
                                    }

                                    $prev_sl= $row->name;
                                    $cnt++;

                                }
                                ?>


                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="t3">
                <div class="row">

                    <div class="col col-xs-12">
                        </br>

                        <div class="cont clearfix">
                            <h4><?php echo $this->lang->line('text_Download_Software');?>                            </h4>
                            <table style="width: auto;height: auto;" >

                                <tr style="padding: 15px;"><td style='font-size: 14px; width: auto;padding: 15px;'><a href="../downloads/software.zip"><button class="btn" style="background-color: DodgerBlue;"><i class="fa fa-download"></i> <?php echo $this->lang->line('text_Stock_Software');?>                                           </button></td>
                                <td style='font-size:14px;text-align: left;width: auto;padding: 15px;'><button class="btn" style="background-color: DodgerBlue;" disabled><i class="fa fa-download"></i> <?php echo $this->lang->line('text_Update_Software');?> </button></td></tr>


                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
	
	
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
    <script src="<?php echo asset_url(); ?>/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">
		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();
            // $(".nav-tabs a").click(function(){
            //     $(this).tab('show');
            // });
			
			$('thead tr th').on('mouseover', function() {
				$(this).children('i.fa-sort').addClass('active');
				$(this).children('.hid').css('visibility','visible');
			}).on('mouseout', function() {
				$(this).children('i.fa-sort').removeClass('active');
				$(this).children('.hid').css('visibility','hidden');
			});

			$('thead tr th').click(function(evt) {
				if($(this).data('sort') !== undefined)
					location.href = $(this).data('sort');
			});
			
			$('tr').click(function(evt) {
				if($(this).data('href') !== undefined)
					location.href = $(this).data('href');
			});
			
			$('button[name=select_profile_picture]').click(function(evt) {
				evt.preventDefault();
				$(this).parent().children('input[type=file]').click();
			});
			
			$('input[type=file]').on('change', function(evt) {			
				var val = $(this).val().split('\\').pop();
				
				$(this).parent().children('button[name=select_profile_picture]').html(val);
			});
			
			$('form[name=basic-settings]').submit(function(evt) {
				var user_name = $('input[name=user_name]').val();
				var user_email = $('input[name=user_email]').val();
				
				if(user_name == '') {
					evt.preventDefault();
					error1('<?php echo $this->lang->line("text_Please_type_your_name"); ?>', '[name=user_name]');
					return false;
				}
				if(validateEmail(user_email) == false) {
					evt.preventDefault();
					error1('<?php echo $this->lang->line("text_Please_insert_a_valid_email_address"); ?>', '[name=user_email]');
					return false;
				}
			});
			
			$('form[name=change-pp]').submit(function(evt) {
				var file = $('input[type=file][name=new_profile_picture]').val();
				
				if(file == '') {
					evt.preventDefault();
					error2('<?php echo $this->lang->line("text_upload_new_image"); ?>');
					return false;
				}
			});
			
			$('form[name=change-password]').submit(function(evt) {
				var cpass = $('input[name=current_password]').val();
				var pass = $('input[name=new_password]').val();
				var rpass = $('input[name=new_rpassword]').val();
				
				if(cpass == '') {
					evt.preventDefault();
					error3('<?php echo $this->lang->line("text_Please_type_your_current_password"); ?>', '[name=current_password]');
					return false;
				}
				if(pass.length < 5) {
					evt.preventDefault();
					error3('<?php echo $this->lang->line("Password_must_be_at_least_5_characters_long"); ?>', '[name=new_password]');
					return false;
				}
				if(pass == '') {
					evt.preventDefault();
					error3('<?php echo $this->lang->line("Please_type_your_new_password"); ?>', '[name=new_password]');
					return false;
				}
				if(rpass == '') {
					evt.preventDefault();
					error3('<?php echo $this->lang->line("text_Please_type_your_new_password_again"); ?>', '[name=new_rpassword]');
					return false;
				}
				if(pass != rpass) {
					evt.preventDefault();
					error3('<?php echo $this->lang->line("text_Both_passwords_must_match"); ?>', '[name=new_password]', '[name=new_rpassword]');
					return false;
				}
			});
			
			var e_active1 = false;
			var e_active2 = false;
			var e_active3b = false;
			var e_active3x = false;
			function error1(e, n) {
				if(e_active1 != false) {
					$(e_active1).removeClass('error');
				}
				
				$(n).addClass('error');
				e_active1 = n;
				
				$('p.bg-danger1').slideUp(200, function() {
					$('p.bg-danger1').html(e).slideDown(200);
				});
			}
			function error2(e, n) {
				if(e_active2 != false) {
					$(e_active2).removeClass('error');
				}
				
				$(n).addClass('error');
				e_active2 = n;
				
				$('p.bg-danger2').slideUp(200, function() {
					$('p.bg-danger2').html(e).slideDown(200);
				});
			}
			function error3(e, n, x) {
				if(e_active3b != false) {
					$(e_active3b).removeClass('error');
				}
				if(e_active3x != false) {
					$(e_active3x).removeClass('error');
				}
				
				$(n).addClass('error');
				e_active3b = n;
				if(x != false) {
					$(x).addClass('error');
					e_active3x = x;
				}
				
				$('p.bg-danger3').slideUp(200, function() {
					$('p.bg-danger3').html(e).slideDown(200);
				});
			}
			
			function validateEmail(email) {
				var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				return re.test(email);
			}
		});
	</script>
</body>
</html>