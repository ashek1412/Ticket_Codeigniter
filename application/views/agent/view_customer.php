<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3>View Customer</h3>
		</div>
		
		<div class="row">
			<div class="col col-xs-12">
				<div class="cont clearfix">
					<div class="top clearfix">
						<h4 class="pull-left">Customer Details</h4>
					</div>
                               <table class="table table-striped">
                                <tbody>

                                <tr scope="row">
                                    <td class="text-right" style="width: 15%">Name :</td>
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
	</div>
    </div>>
	
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
                    error('Name must be at least 2  characters long', '[name=name]');
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