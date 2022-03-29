<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content" id="ticket" data-id="<?php echo $ecu_file_info->id; ?>" ">
		<div class="page-title-cont clearfix">
			<h3>ECU File Deatils </h3>
						<?php
			if($ecu_file_info->file_stat == '1')
				echo '<div class="badge red">Pending</div>';
			elseif($ecu_file_info->file_stat == '2')
				echo '<div class="badge green">Completed</div>';
			else
				echo '<div class="badge yellow">Failed</div>';
			?>
		</div>
		
		<div class="row">
			<div class="col margin-top col-md-4">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top clearfix">
								<h4 class="pull-left">Customer Info</h4>
							</div>
							
							<table class="ticket-info">
								<tbody style="text-align: right;">
									<tr >
										<td>Desktop User :</td>
										<td style="text-align: left;">
                                            <?php echo $ecu_file_info->desktop_user; ?>
										</td>
									</tr>
									<tr>
										<td>Customer Name :</td>
										<td style="text-align: left;"> <?php echo $ecu_file_info->cus_name; ?>	</td>
									</tr>
									<tr>
										<td>Customer VIN :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->cus_vin; ?>	</td>
									</tr>
									<tr>
										<td>Customer License :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->cus_license; ?>	</td>
									</tr>
									<tr>
										<td>DTC Code :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->cus_dtc; ?>	</td>
									</tr>

								</tbody>
							</table>

                          </br>
                            <div class="top clearfix">
                                <h4 class="pull-left">Vehicle Info</h4>
                            </div>
                            <table class="ticket-info">
                                <tbody style="text-align: right;">
                                <tr>
                                    <td>Vehicle Type :</td>
                                    <td style="text-align: left;">
                                        <?php echo $ecu_file_info->v_type; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Producer :</td>
                                    <td style="text-align: left;"> <?php echo $ecu_file_info->v_producer; ?>	</td>
                                </tr>
                                <tr>
                                    <td>Series :</td>
                                    <td style="text-align: left;"> <?php echo $ecu_file_info->v_series; ?>	</td>

                                </tr>
                                <tr>
                                    <td>Build :</td>
                                    <td style="text-align: left;"> <?php echo $ecu_file_info->v_build; ?>	</td>
                                </tr>
                                <tr>
                                    <td>Model :</td>
                                    <td style="text-align: left;"> <?php echo $ecu_file_info->v_model; ?>	</td>
                                </tr>
                                <tr>
                                    <td>Model Year :</td>
                                    <td style="text-align: left;"> <?php echo $ecu_file_info->v_year; ?>	</td>
                                </tr>

                                </tbody>
                            </table>

                                </br>
                                <div class="top clearfix">
                                    <h4 class="pull-left">ECU File Info</h4>
                                </div>
                                <table class="ticket-info">
                                    <tbody style="text-align: right;">
                                    <tr>
                                        <td>Service Type :</td>
                                        <td style="text-align: left;">
                                            <?php echo $ecu_file_info->ecu_file_type; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Use :</td>
                                        <td style="text-align: left;">
                                            <?php echo $ecu_file_info->ecu_use; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Producer :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_producer; ?>	</td>
                                    </tr>
                                    <tr>
                                        <td>Build :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_build; ?>	</td>

                                    </tr>
                                    <tr>
                                        <td>ECU -Nr. Prod :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_nr_prd; ?>	</td>
                                    </tr>
                                    <tr>
                                        <td>ECU -Nr. ECU :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_nr_ecu; ?>	</td>
                                    </tr>
                                    <tr>
                                        <td>Software :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_software; ?>	</td>
                                    </tr>
                                    <tr>
                                        <td>Version :</td>
                                        <td style="text-align: left;"> <?php echo $ecu_file_info->ecu_version; ?>	</td>
                                    </tr>

                                    </tbody>
                            </table>
						</div>
					</div>
				</div>
				

			</div>
			
			<div class="col margin-top no-bottom-padding col-md-8 ticket">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top">
								<h4>Desktop User File</h4>
							</div>
							<div class="tb-content clearfix">
							<?php
							if($upload_file != false) { 										
							?>
								<div class="tb-text">
								<div class="files-holder clearfix">			

                                   
                                    <a href="<?php echo base_url(); ?>ecufile/1/<?php echo $ecu_file_info->id; ?>" class="file clearfix">
									<i class="fa fa-file-o"></i>
										<div class="fileinfo">			
												<span class="filename"><?php echo $ecu_file_info->ecu_file; ?></span>								
												<span class="filesize"><?php echo number_format($upload_file['size'] / 1048576, 2) . 'MB'; ?>
												</br>
												<?php echo date('Y-M-d H:i:s', strtotime($ecu_file_info->entry_date));  ?>
												</span>												
												
										</div>									
									</a>
								</div>
								</div>

							<?php } ?>

						</div>
					</div>
				

				<?php if($ecu_file_info->file_stat=='2') 
				{ 		
								 ?>

				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top">
								<h4>Processed File</h4>
							</div>
							<div class="tb-content clearfix">
							<?php
							if($processed_file != false) { 										
							?>
								<div class="tb-text">
								<div class="files-holder clearfix">			

                                   
                                    <a href="<?php echo base_url(); ?>ecufile/2/<?php echo $ecu_file_info->id; ?>" class="file clearfix">
									<i class="fa fa-file-o"></i>
										<div class="fileinfo">			
												<span class="filename"><?php echo $ecu_file_info->ecu_file_upd; ?></span>								
												<span class="filesize"><?php echo number_format($processed_file['size'] / 1048576, 2) . 'MB'; ?>
												</br>
												<?php echo date('Y-M-d H:i:s', strtotime($ecu_file_info->update_date));  ?>
												</span>												
												
										</div>									
									</a>
								</div>
								</div>

							<?php } ?>

						</div>
					</div>
				
				<?php
				 } 
				 if($ecu_file_info->file_stat=='1') { 
				?>

				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont clearfix">
							<div class="top">
								<h4>Upload Processed ECU File</h4>
							</div>

							<?php

								if (!isset($error))
									echo '<p class="bg-danger" style="display:none"></p>';
								else
									echo '<p class="bg-danger">' . $error . '</p>';

								if (!isset($success))
									echo '<p class="bg-success" style="display:none"></p>';
								else
									echo '<p class="bg-success">' . $success . '</p>';


							
								echo '<form method="POST" enctype="multipart/form-data" name="new-reply">';
								?>								
								<div class="row" style="margin-top:15px; margin-bottom:15px;">
									<div class="col col-sm-6" style="margin-bottom:15px;">
										<div class="cont no-padding no-border">
											<div class="upload-files">
												<div class="file">
                                                   <button name="selected_file" class="btn btn-upload-file btn-light-blue" id="fld" style="font-size: 14px;">Select file to upload...</button>
                                                  <input type="submit" name="submit" id="sbt" class="btn btn-upload-file btn-light-blue" value="Upload" style="margin-top: 0px;font-size: 12px;" disabled />
                                                   <input type="file" name="ecu_file"  style="display:none;" />
												    <input type="text" name="ecu_id" value="<?php echo $ecu_file_info->id; ?>"  style="display:none;" />
												</div>												
											</div>
											
										</div>
										  <input type="submit" name="Cancel" id="sbt" class="btn btn-danger" value="Cancel" style="font-size: 14px;background-color: coral;" />
								  	</div>
									</div>
									         
                                       
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php 
				} 
				
				?>
			</div>
		</div>
	</div>
	
	<div id="tooltip"></div>
	
	
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
	<script type="text/javascript">
		$('document').ready(function() {
			// Enable sidebar
			 enable_sidebar();
			 $(document).delegate('button[name=selected_file]', 'click', function(evt) {
						// Bug fixer
						if(evt.clientX != 0 && evt.clientY != 0) {
							evt.preventDefault();
							$(this).parent().children('input[type=file]').click();
						}
					});

					$(document).delegate('input[type=file]', 'change', function(evt) {
						var val = $(this).val().split('\\').pop();
						//var input_name = val.toLowerCase().split('.').pop();
						var ext = val.toLowerCase().split('.').pop();
						var login_logo = $('input[type=file][name=ecu_file]');
						

						var size=Math.round(login_logo[0].files[0].size/(1024),2);
						$('#fld').text(val+" ("+size+" KB)");


						if(size > 50000) {
							alert("Maximum File Size is 50 MB");
							$("#sbt").prop("disabled",true);
						}
						else
							$("#sbt").prop("disabled",false);


					});

	        $('form[name=new-reply]').submit(function(evt) {
	           //var file_uploads_max_size = $('input[name=file_uploads_max_size]').val();
            var login_logo = $('input[type=file][name=fecu_file]');


            if(login_logo[0].files.length>0)
            {

                var fsize=Math.round(login_logo[0].files[0].size/(1024*1024),2);
                if(fsize > 120) {
                alert("Maximum File Size is 120 MB");
                    return false;
                }
                else
                {
                    if(confirm("Are you sure you want to Upload File ?")){

                    }
                    else{
                        return false;
                    }

                }


            }
        });
			
			
			
		
		});
	</script>
</body>
</html>