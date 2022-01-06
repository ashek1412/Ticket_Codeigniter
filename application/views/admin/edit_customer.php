<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3>Edit Customer</h3>
		</div>
		
		<div class="row">
			<div class="col col-xs-12">
				<div class="cont clearfix">
					<div class="top clearfix">
						<h4 class="pull-left">Customer Details</h4>
					</div>
					
					<?php



					if(!isset($error))
						echo '<p class="bg-danger" style="display:none"></p>';
					else
						echo '<p class="bg-danger">'.$error.'</p>';
					?>
					
					<form method="POST" action="<?php echo $base_url; ?>panel/admin/customer/<?php echo $customer->id; ?>/edit/action" name="edit-customer">

											<div class="row min-bottom-margin">
							<div class="col col-md-6">
								<div class="form-group">
                                    <input type="text" id="nid" name="nid" value="<?php echo $customer->id; ?>" style="display: none;" />
									<label for="subject">Name</label>
									<input type="text" id="name" name="name" value="<?php echo $customer->name; ?>" />
								</div>
                                <div class="form-group">
                                    <label for="subject">License Plate Number</label>
                                    <input type="text" id="license_num" name="license_num" value="<?php  echo $customer->license_num; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="subject">VIN number</label>
                                    <input type="text" id="vin_num" name="vin_num" value="<?php echo $customer->vin_num; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="subject">Displacement</label>
                                    <input type="text" id="displacement" name="displacement" value="<?php echo $customer->displacement; ?>"  style="width: 150px;"/>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Horsepower</label>
                                    <input type="text" id="horsepower" name="horsepower" value="<?php echo $customer->horsepower; ?>" style="width: 150px;"/>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Year </label>
                                    <input type="text" id="year" class="date-picker-year" name="year" value="<?php  echo $customer->year; ?>" style="width: 50px;"/>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Service Content </label>
                                    <input type="text" id="srv_content" name="srv_content" value="<?php echo $customer->srv_content; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="subject">Service Time </label>
                                    <input type="text" id="srv_time" name="srv_time" value="<?php echo $customer->srv_time; ?>" style="width: 150px;"/>
                                </div>
                                <div class="form-group">
                                    <label for="subject">Upgrade place </label>
                                    <input type="text" id="upd_place" name="upd_place" value="<?php  echo $customer->upd_place; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="subject">email </label>
                                    <input type="text" id="email" name="email" value="<?php echo $customer->email; ?>" />
                                </div>
                                <div class="form-group">
                                    <label for="subject">Phone Number </label>
                                    <input type="text" id="phone" name="phone" value="<?php echo $customer->phone; ?>" />
                                </div>
                                <input type="submit" name="submit" class="btn btn-strong-blue pull-left" value="Update" />
							</div>
							




						</div>


					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div id="tooltip"></div>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
    <script src="<?php echo asset_url(); ?>/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo asset_url(); ?>js/summernote.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
        $( function() {

            $( "#srv_time" ).datepicker({
                    dateFormat: 'yy-mm-dd'
                }
            );

            $('.date-picker-year').datepicker({
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'yy',
                onClose: function(dateText, inst) {
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, 1));
                }
            });
            $(".date-picker-year").focus(function () {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
            });



        } );

		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();

           // $('#summernote').summernote();
			

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
			

			
			$('form[name=edit-customer]').submit(function(evt) {

				var subject = $('input[name=name]').val();
                var email = $('input[name=email]').val();
				//var description = $('select[name=description]').val();
				
				//editor.post();
				//var description = editor.t.value;

                if(subject == '') {
                    evt.preventDefault();
                    error('Enter Name', '[name=name]');
                    return false;
                }
                if(subject.length < 2) {
                    evt.preventDefault();
                    error('Name must be at least 2 characters long', '[name=name]');
                    return false;
                }
                if(validateEmail(email) == false) {
                    evt.preventDefault();
                    error('Please insert a valid email address', '[name=email]');
                    return false;
                }


			});
			
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

            function validateEmail(email) {
                var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
                return re.test(email);
            }
		});
	</script>
</body>
</html>