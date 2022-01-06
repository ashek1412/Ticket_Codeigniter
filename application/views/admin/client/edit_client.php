<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content" id="ticket-department">
		<div class="page-title-cont clearfix">
			<h3>Edit User</h3>
		</div>
		
		<div class="row">
			<div class="col margin-top col-md-4">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top clearfix">
								<h4 class="pull-left">User Info</h4>
							</div>
							
							
							<img src="<?php echo $base_url; ?>assets/img/profile_img/<?php echo $current_user_info->profile_img1x; ?>" srcset="<?php echo $base_url; ?>assets/img/profile_img/<?php echo $current_user_info->profile_img1x; ?> 1x, <?php echo $base_url; ?>assets/img/profile_img/<?php echo $current_user_info->profile_img2x; ?> 2x, <?php echo $base_url; ?>assets/img/profile_img/<?php echo $current_user_info->profile_img3x; ?> 3x" width="68" height="68" />
							
							<table class="ticket-info">
								<tbody>
									<tr>
										<td>ID</td>
										<td>
											<?php echo $current_user_info->id; ?>
										</td>
									</tr>
									<tr>
										<td>Name</td>
										<td>
											<?php echo $current_user_info->name; ?>
										</td>
									</tr>
									<tr>
										<td>Username</td>
										<td>
											<?php echo $current_user_info->username; ?>
										</td>
									</tr>
									<tr>
										<td>Role</td>
										<td>
											Client
										</td>
									</tr>
									<tr>
										<td>Email</td>
										<td>
											<?php echo $current_user_info->email; ?>
										</td>
									</tr>
									<tr>
										<td>Member Since</td>
										<td>
											<?php echo $created_on; ?>
										</td>
									</tr>
                                    <tr>
                                        <td>Membership Expires On</td>
                                        <td>
                                            <?php echo $current_user_info->exp_date; ?>
                                        </td>
                                    </tr>
								</tbody>
							</table>
                        </br>
                            </br>
						</div>
					</div>
				</div>
                <div class="row min-bottom-margin">
                    <div class="col col-xs-12">
                        <div class="cont">
                             <h4 class="pull-left">User Tools</h4>


                            <table style="width: 100%;height: auto;">
                              <?php
                                $cnt=0;
                                $prev_sl="";
                                foreach($current_user_serial_info as $row) {

                                    if($cnt>0 && $prev_sl== $row->name )
                                    {

                                        echo "<tr><td style='font-size: 13px;'><b>&nbsp;&nbsp;&nbsp;S/N :</b> " . $row->serial."</td>";
                                        echo "<td style='font-size:12px; width: 30%;text-align: left;'><a style='display:inline;' href='".$base_url."panel/admin/user/product/".$current_user_info->id."/".$row->sid."/delete' title='" . $row->serial."' name='Delete Serial'>Delete</a></td></tr>";
                                        //  $prev_sl= $row->name;
                                     //   $cnt++;
                                      // continue;


                                    }
                                    else
                                    {
                                        if($cnt>0) {
                                            echo  '</td></tr><tr style="border-top: 1px solid black;">';
                                            echo '<td style="font-size: 13px;" >';
                                            echo "<b>Tool : </b>" . $row->name . "</td></tr>";
                                             echo "<tr ><td><b>&nbsp;&nbsp;&nbsp;S/N :</b> " . $row->serial."</td>";
                                             echo "<td style='font-size:12px; width: 30%;text-align: left;'><a style='display:inline;' href='".$base_url."panel/admin/user/product/".$current_user_info->id."/".$row->sid."/delete' title='" . $row->serial."' name='delete-admin'>Delete</a></td></tr>";




                                        }
                                        else
                                        {
                                            echo  '<tr">';
                                            echo '<td >';
                                            echo "<b>Tool : </b>" . $row->name . "</td></tr>";
                                            echo "<tr><td style='font-size: 13px;'><b>&nbsp;&nbsp;&nbsp;S/N :</b> " . $row->serial."</td>";
                                            echo "<td style='font-size:12px; width: 30%;text-align: left;'><a style='display:inline;' href='".$base_url."panel/admin/user/product/".$current_user_info->id."/".$row->sid."/delete' title='" . $row->serial."' name='delete-admin'>Delete</a></td></tr>";


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
			
			<div class="col margin-top no-bottom-padding col-md-8">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont clearfix">
							<div class="top">
								<h4>Edit User</h4>
							</div>
							
							<p class="bg-danger" style="display:none"></p>
							
							<form method="POST" action="<?php echo $base_url; ?>panel/admin/user/<?php echo $current_user_info->id; ?>/edit/action" name="edit-user">
								<div class="form-group">
									<label for="user-name">Name</label>

									<input type="select" name="user-name" id="user-name" value="<?php echo $current_user_info->name; ?>" />

								</div>
								
								<div class="form-group">
									<label for="user-username">Username</label>
									<input type="text" name="user-username" id="user-username" value="<?php echo $current_user_info->username; ?>" />
								</div>

                                <div class="form-group">
                                <label id="user-exp_date">Expires On</label>
                                <input type="text" name="user-expdate" id="user-expdate" value="<?php echo $current_user_info->exp_date;  ?>" />
                                </div>
								
								<div class="form-group">
									<label for="user-email">Email</label>
									<input type="text" name="user-email" id="user-email" value="<?php echo $current_user_info->email; ?>" />
                                    <input type="submit" name="save-changes" class="btn btn-strong-blue pull-right" value="Save changes" />
								</div>


							</form>
						</div>
					</div>
				</div>
			</div>

            <div class="col margin-top no-bottom-padding col-md-8">
                <div class="row min-bottom-margin">
                    <div class="col col-xs-12">
                        <div class="cont clearfix">
                            <div class="top">
                                <h4>Add Tool</h4>
                            </div>

                            <p class="bg-danger1" style="display:none"></p>

                            <form method="POST" name="add-tools" action="<?php echo $base_url; ?>panel/admin/user/<?php echo $current_user_info->id; ?>/product/add">
                                <div class="form-group" style="width: 50%">
                                    <label for="user-name">Tool Name</label>
                                    <select name="product_name" id="product_id" />
                                    <option value="">Select</option>>
                                    <?php

                                    foreach($current_user_product_info as $row) {

                                        echo "<option value='".$row->id."'>".$row->name."</option>";
                                     }
                                    ?>
                                    </select>

                                </div>
                                <div class="input_fields_wrap" style="width: 50%">
                                        <div>
                                        <input type="text" name="serials[]" placeholder="Serial Number" style="width: 80%">
                                        </div>

                                </div>
                                <button class="add_field_button">Add</button>

                                <input type="submit" name="savetools" class="btn btn-strong-blue pull-right" value="Save changes" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            

		</div>
	</div>
	
	<div id="tooltip"></div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
	<script src="<?php echo asset_url(); ?>js/tinyeditor.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">

        $( function() {

            $( "#user-expdate" ).datepicker({
                    dateFormat: 'yy-mm-dd'
                }
            );
        } );

		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div><input type="text" name="serials[]" placeholder="Serial Number"  style="width: 80%;"><a href="#" class="remove_field">Remove</a></div>'); //add input box
                }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })

            $('a[name=delete-admin]').click(function(evt) {
                var c = confirm("Are you sure you want to delete S/N "+$('a[name=delete-admin]').attr('title') +" ?");
                if(c == false) {
                    evt.preventDefault();
                    return false;
                }
            });

            $( "form" ).each( function () {

                /* addEventListener onsubmit each form */
                $( this ).bind( "submit", function (event) {

                    /* return false */
                    //event.preventDefault();

                });
            });

			
			$('form[name=edit-user]').submit(function(evt) {
				var name = $('input[name=user-name]').val();
				var username = $('input[name=user-username]').val();
				var email = $('input[name=user-email]').val();



				if(name == '') {
					evt.preventDefault();
					error('Please insert the user\'s name', '[name=user-name]');
					return false;
				}
				if(name.length < 5) {
					evt.preventDefault();
					error('User\'s name must be at least 5 characters long', '[name=user-name]');
					return false;
				}
				if(username == '') {
					evt.preventDefault();
					error('Please insert the user\'s username', '[name=user-username]');
					return false;
				}
				if(/\s/.test(username)) {
					evt.preventDefault();
					error('The user\'s username cannot contain spaces', '[name=user-username]');
					return false;
				}
				if(username.length < 5) {
					evt.preventDefault();
					error('The user\'s username must be at least 5 characters long', '[name=user-username]');
					return false;
				}
				if(email == '') {
					evt.preventDefault();
					error('Please insert the user\'s email address', '[name=user-email]');
					return false;
				}
				if(validateEmail(email) == false) {
					evt.preventDefault();
					error('Please insert a valid email address', '[name=user-email]');
					return false;
				}
			});





            $('form[name=add-tools]').submit(function(evt) {

                var tname =  document.getElementById('product_id').value;
                var inps = document.getElementsByName('serials[]');

                console.log($('form[name=add-tools]').attr('action'));


                if( tname.length== 0) {
                    evt.preventDefault();
                    error1('Please Select tool', '[name=product_name]');
                    return false;
                }

                for (var i = 0; i <inps.length; i++) {
                    var inp=inps[i];
                    if(inp.value.length==0) {
                        error1("Enter Serial Number");
                        return false;
                    }
                }





            });


			$('button[name=drop]').click(function(evt) {
				evt.preventDefault();
				var to = $(this).data('drop');
				
				$('.dropdwn[name=dropdwn-'+to+']').slideToggle(300);
			});
			
			function validateEmail(email) {
				var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
				return re.test(email);
			}

			var e_active = false;
			function error(e, n) {
				if(e_active != false) {
					$(e_active).css('border-color', '#d0d0d0').removeClass('error');
				}
				
				$(n).css('border-color','#ff0000').addClass('error');
				e_active = n;
				
				$('p.bg-danger').slideUp(200, function() {
					$('p.bg-danger').html(e).slideDown(200);
				});
			}
            function error1(e, n) {
                if(e_active != false) {
                    $(e_active).css('border-color', '#d0d0d0').removeClass('error');
                }

                $(n).css('border-color','#ff0000').addClass('error');
                e_active = n;

                $('p.bg-danger1').slideUp(200, function() {
                    $('p.bg-danger1').html(e).slideDown(200);
                });
            }
		});
	</script>
</body>
</html>