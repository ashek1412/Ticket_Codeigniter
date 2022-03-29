<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($d_user_info->exp_date=="0000-00-00")
    $d_user_info->exp_date="";
?>
	<div class="content" id="ticket" data-id="<?php echo $d_user_info->id; ?>" >
		<div class="page-title-cont clearfix">
			<h3>Desktop User Details </h3>

		</div>
		<form method="POST"  name="ecu-services">
		<div class="row">
        	
			<div class="col margin-top col-md-4">
				<div class="row min-bottom-margin">
					<div class="col col-xs-12">
						<div class="cont">
							<div class="top clearfix">
								<h4 class="pull-left">Desktop User Info</h4>
							</div>							
							<table class="ticket-info" >
								<tbody style="text-align: right; font-size:16px; ">
									<tr >
										<td>Username :</td>
										<td style="text-align: left;">
                                            <?php echo $d_user_info->username; ?>
										</td>
									</tr>
									<tr>
										<td>Name :</td>
										<td style="text-align: left;"> <?php echo $d_user_info->name; ?>	</td>
									</tr>
									<tr>
										<td>Company :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->company; ?>	</td>
									</tr>
									<tr>
										<td>Email :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->email; ?>	</td>
									</tr>
                                    <tr>
                                        <td>Phone :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->phone; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>Country :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->country; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>Entry Date :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->date; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>Local IP :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->local_ip; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>Public IP :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->public_ip; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>MAC :</td>
                                        <td style="text-align: left;"> <?php echo $d_user_info->mac; ?>	</td>
                                    </tr>

                                    <tr>
                                        <td>Active :</td>
                                        	<td style="text-align: left;padding: 10px;">  
                                         	<div class="onoffswitch">
                                          	  <input type="checkbox" name="isactive" class="onoffswitch-checkbox" id="myonoffswitch"  <?php if ($d_user_info->active==1) echo 'checked'; ?> />
                                           	 <label class="onoffswitch-label" for="myonoffswitch">
                                                <span class="onoffswitch-inner"></span>
                                                <span class="onoffswitch-switch"></span>
                                       	 	</label>
                                        </div>	
                                    </td>
									</tr>

                                    <tr>
                                        <td>Serial No :</td>
                                        <td style="text-align: left;"><input type="text" name="sl_num" value="<?php echo $d_user_info->sl_num; ?>"   readonly />
                                         	</td>
                                    </tr>
                                    <tr style="text-align: left;">
                                        <td>Expiry Date :</td>
                                        <td style="text-align: left;padding:15px 10px 5px 0px;"> <input type="text" id="exp_date" name="exp_date" value="<?php echo $d_user_info->exp_date; ?>" style="width: 150px;"/></td>
                                    </tr>
                                    

								</tbody>
							</table>


						</div>
					</div>
				</div>
				

			</div>
			
			<div class="col margin-top no-bottom-padding col-md-8 ticket">
                <div class="cont">
				<div class="clearfix">
    				
							<div class="row" style="margin-top:15px; margin-bottom:15px;">

										<div class="cont no-padding no-border">
                                            <table style="width: 100%;" >
                                              <tr><td style='padding: 2px;' colspan='2'><label class='container1'> <input type="checkbox" id="ckbCheckAll" /><span class='checkmark'></span><span class='label label-primary'>Select All</span></td></tr>
                                                                                           <tr >
                                            <?php
                                            $cnt=1;
                                            foreach($d_user_services->result() as $drow)
                                            {
                                                $td_bg="label label-default";
                                                $chk_stat="";

                                                if($drow->status==1)
                                                {
                                                    $td_bg="label label-success";
                                                    $chk_stat="checked";
                                                }


                                                echo "<td style='padding: 2px;'><label class='container1'> <input type='checkbox' ".$chk_stat." name='ecu_serv[]' value='".$drow->id."' class='ecuserv'>  <span class='checkmark'></span><span class='".$td_bg."'>&nbsp;&nbsp;".$drow->func_name."</span></label>
</td>";
                                                if($cnt%2==0 && $cnt >1) {
                                                    echo "</tr><tr >";

                                                }
                                                $cnt++;
                                            }
                                                ?>
                                                </tr>
                                               </table>
											
										</div>
                                       
                                <input type="text" name="did" value="<?php echo $d_user_info->id; ?>"  style="display:none;" />
								 <input type="submit" name="submit" id="sbt" class="btn btn-primary" value="Submit" style="font-size: 14px;background-color: coral; margin-left: 15px;" />

									</div>
                      
   					</div>
    			</div>
                </div>
            </div>
            </form>
          </div>


	

	    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    /* The container */
    .container1 {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        width:400px;
    }

    /* Hide the browser's default checkbox */
    .container1 input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 25px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .container1:hover input ~ .checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .container1 input:checked ~ .checkmark {
        background-color: #4CAF50;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .container1 input:checked ~ .checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .container1 .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }


    .onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}

.onoffswitch-checkbox {
    display: none;
}

.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}

.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    -moz-transition: margin 0.3s ease-in 0s; -webkit-transition: margin 0.3s ease-in 0s;
    -o-transition: margin 0.3s ease-in 0s; transition: margin 0.3s ease-in 0s;
}

.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 12px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    -moz-box-sizing: border-box; -webkit-box-sizing: border-box; box-sizing: border-box;
}

.onoffswitch-inner:before {
    content: "YES";
    padding-left: 10px;
    background-color: #4CAF50; color: #FFFFFF;
}

.onoffswitch-inner:after {
    content: "NO";
    padding-right: 10px;
    background-color: #bc1212; color: #FFFFFF;
    text-align: right;
}

.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    border: 2px solid #999999; border-radius: 20px;
    position: absolute; top: 0; bottom: 0; right: 56px;
    -moz-transition: all 0.3s ease-in 0s; -webkit-transition: all 0.3s ease-in 0s;
    -o-transition: all 0.3s ease-in 0s; transition: all 0.3s ease-in 0s; 
}

.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}

.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}
</style>
	<script type="text/javascript">

     $( function() {

            $( "#exp_date" ).datepicker({
                    dateFormat: 'yy-mm-dd'
                }
            );          


        } );

		$('document').ready(function() {
			// Enable sidebar
            //
             enable_sidebar();

              $("#ckbCheckAll").click(function () {
                    $(".ecuserv").prop('checked', $(this).prop('checked'));
                });
                
                $(".ecuserv").change(function(){
                    if (!$(this).prop("checked")){
                        $("#ckbCheckAll").prop("checked",false);
                    }
                });

			
			
			
		
		});
	</script>
</body>
</html>