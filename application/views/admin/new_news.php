<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3>New News</h3>
		</div>
		
		<div class="row">
			<div class="col col-xs-12">
				<div class="cont clearfix">
					<div class="top clearfix">
						<h4 class="pull-left">News Details</h4>
					</div>
					
					<?php
					if(!isset($error))
						echo '<p class="bg-danger" style="display:none"></p>';
					else
						echo '<p class="bg-danger">'.$error.'</p>';
					?>
					
					<?php

						echo '<form method="POST" action="" name="new-news">';
					?>
						<div class="row min-bottom-margin">
							<div class="col col-md-6">
								<div class="form-group">
									<label for="subject">Subject</label>
									<input type="text" id="subject" name="subject" value="<?php if(isset($_POST['subject'])) echo $_POST['subject']; ?>" />
								</div>

							</div>
							
							<div class="col col-md-8">
								<div class="form-group">
									<label for="ticket_msg">Description</label>
									<span class="label_desc">Write here the content of your news</span>
									<textarea name="description" id="summernote" class="nostyle margin-bottom"><?php if(isset($_POST['description'])) echo $_POST['description']; ?></textarea>
								</div>
                                <input type="submit" name="submit" class="btn btn-strong-blue pull-left" value="Post" />

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
    <script src="<?php echo asset_url(); ?>js/summernote.min.js"></script>


	<script type="text/javascript">
		$('document').ready(function() {
			// Enable sidebar
			enable_sidebar();
            $('#summernote').summernote();
			

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



			
			$('form[name=new-news]').submit(function(evt) {

				var subject = $('input[name=subject]').val();

				

				
				if(subject == '') {
					evt.preventDefault();
					error('Enter Subject', '[name=subject]');
					return false;
				}
				if(subject.length < 5) {
					evt.preventDefault();
					error('Subject must be at least 5 characters long', '[name=subject]');
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
		});
	</script>
</body>
</html>