<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3>Edit Email</h3>
		</div>
		
		<div class="row">
			<div class="col col-xs-12">
				<div class="cont clearfix">
					<div class="top clearfix">
						<h4 class="pull-left">Email Details</h4>
					</div>
					
					<?php



					if(!isset($error))
						echo '<p class="bg-danger" style="display:none"></p>';
					else
						echo '<p class="bg-danger">'.$error.'</p>';
					?>
					
					<form method="POST" action="<?php echo $base_url; ?>panel/admin/email/<?php echo $email->id; ?>/edit/action" name="edit-email">

											<div class="row min-bottom-margin">
							<div class="col col-md-6">
								<div class="form-group">
                                    <input type="text" id="nid" name="nid" value="<?php echo $email->id; ?>" style="display: none;" />
									<label for="subject">Email</label>
									<input type="text" id="email" name="email" value="<?php echo $email->email; ?>" />
                                    <input type="submit" name="submit" class="btn btn-strong-blue pull-left" value="Update" />
								</div>

							</div>
							



						</div>


					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div id="tooltip"></div>
	
	
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
<script src="<?php echo asset_url(); ?>/bootstrap/js/bootstrap.js"></script>

	<script type="text/javascript">
		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();

			

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
			

			
			$('form[name=edit-email]').submit(function(evt) {

				var subject = $('input[name=email]').val();
				//var description = $('select[name=description]').val();
				

				if(subject == '') {
					evt.preventDefault();
					error('Enter Emaal', '[name=email]');
					return false;
				}
                if(validateEmail(subject) == false) {
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