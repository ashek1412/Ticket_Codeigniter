<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta chartset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>VZ-Performance - Verify your information</title>
	
	<link href="<?php echo asset_url(); ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?php echo asset_url(); ?>css/main/main.css" rel="stylesheet" />
	<link href="<?php echo asset_url(); ?>css/main/ticket-bug.css" rel="stylesheet" />
	<link href="<?php echo asset_url(); ?>css/tinyeditor.css" rel="stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700|PT+Sans:400,700|Open+Sans:300,400,600,700,800|Roboto' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div id="container" class="ticket-submitted">
		<img src="<?php echo asset_url(); ?>img/logos/mainlogo@1x.png" srcset="<?php echo asset_url(); ?>img/logos/mainlogo@1x.png 1x, <?php echo asset_url(); ?>img/logos/mainlogo@2x.png 2x, <?php echo asset_url(); ?>img/logos/mainlogo@3x.png 3x" width="360" height="100" />
	
		<?php

		if($action == 1) {
		?>
		<div id="central-container" class="clearfix">
			<h3 class="center"><?php echo $this->lang->line('text_Customer_Verification');?></h3>
			<p>
				<?php echo $this->lang->line('text_To_verify_your_information_please_write_your_VIN_or_License_Plate_Number_below');?>

			</p>
			<?php
			if(isset($error) && $error != null)
				echo '<div id="error" style="display:block; margin:8px 0px -8px 0;">'.$error.'</div>';
			else
				echo '<div id="error" style="margin:8px 0px -8px 0;"></div>';
			?>
			<form method="POST" action="" name="recover-pass">
				<label for="email"></label>
				<input type="text" name="vin" id="vin" style="font-size:1.3em;" placeholder="<?php echo $this->lang->line('text_VIN_OR_Plate_number');?>..." value="<?php echo $this->input->post('vin'); ?>" />
				<input type="submit" name="submit" class="pull-right" value="<?php echo $this->lang->line('text_Genuine_verification');?>" style="width:100%; margin-top:-12px;" />
			</form>
		</div>
		
		<?php
		}
		else if ($action == 2)
		{
            if($customer==NULL)
            {
                echo '<div id="error" style="display:block; margin:8px 0px -8px 0;">No Customer Information Found</div>';

            }
            else
            {
                ?>
        <div class="col col-xs-12">
            <div id="central-container" class="clearfix">
                <div class="top clearfix">
                    <h4 class="center">Customer Information</h4>

                </div>
                <table class="table table-striped">
                    <tbody>

                    <tr scope="row">
                        <td class="text-right">Name :</td>
                        <td style="text-align: left">
                             <?php echo $customer->name; ?>
                        </td>
                    </tr>
                    <tr scope="row">
                        <td class="text-right">License Plate Number :</td>
                        <td style="text-align: left">
                            <?php echo $customer->license_num; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">VIN number :</td>
                        <td style="text-align: left">
                            <?php echo $customer->vin_num; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Displacement :</td>
                        <td style="text-align: left">
                            <?php echo $customer->displacement; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Horsepower :</td>
                        <td style="text-align: left">
                            <?php echo $customer->horsepower; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Year :</td>
                        <td style="text-align: left">
                            <?php echo $customer->year; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Service Content :</td>
                        <td style="text-align: left">
                            <?php echo $customer->srv_content; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Service Time :</td>
                        <td style="text-align: left">
                            <?php echo $customer->srv_time; ?>
                        </td>
                    </tr>

                    <tr scope="row">
                        <td class="text-right">Upgrade place :</td>
                        <td style="text-align: left">
                            <?php echo $customer->upd_place; ?>
                        </td>
                    </tr>
                    <tr scope="row">
                        <td class="text-right">email :</td>
                        <td style="text-align: left">
                            <?php echo $customer->email; ?>
                        </td>
                    </tr>
                    <tr scope="row">
                        <td class="text-right">Phone Number :</td>
                        <td style="text-align: left">
                            <?php echo $customer->phone; ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <?php
            }
		


		
		 } ?>
	</div>
	
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$('document').ready(function() {

			$('form[name=recover-pass]').submit(function(evt) {
				var p1 = $('input[name=vin]').val();
                console.log(p1);
				
				if(p1.length == 0) {
					evt.preventDefault();
					error('Enter VIN or License Plate Number', '[name=vin]')
					return false;
				}

			});
			

			var e_active = false;
			function error(e, n, n2) {
				if(e_active != false)
					$(e_active).css('border-color', '#d0d0d0').removeClass('error');

				$(n).css('border-color','#ff0000').addClass('error');
				e_active = n;
				
				if(n2 !== undefined) {
					$(n2).css('border-color','#ff0000').addClass('error');
					e_active2 = n2;
				}
					
				
				$('#error').slideUp(200, function() {
					$('#error').html(e).slideDown(200);
				});
			}
			
			function disable_error() {
				$(e_active).css('border-color','#d0d0d0');
				e_active = false;
			}
			

		});
	</script>
</body>
</html>