<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3>All Desktop News</h3>
		</div>
		
		<div class="row">
			<div class="col margin-top col-sm-12">
				<div class="cont clearfix">
					<div class="head clearfix">
						<h4 class="pull-left">List of all Desktop News</h4>
						
						<div class="pull-right">
							<div class="clearfix">
								<div class="pull-right search">
									<form method="get" action="" name="search-1">
										<input type="text" name="search" placeholder="Enter search query and press enter" <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>/>
									</form>
								</div>
								<div class="pull-right">
									<button class="btn btn-green besides-search" name="drop" data-drop="new-news" onclick="window.location.href='<?php echo $base_url; ?>/panel/admin/new-desktop-news'">Add News</button>
								</div>
							</div>

						</div>
						</div>
					
					
					<table class="table t-departments">
						<thead>
							<tr>
							<?php
							$sorting = array(
								array(
									'c' => 1,
									'width' => '5%',
									'title' => 'ID'
								),
								array(
									'c' => 2,
									'width' => '55%',
									'title' => 'Subject'
								),								
								array(
									'c' => 4,
									'width' => '15%',
									'title' => 'Create Date'
								)

							);
							
							foreach($sorting as $sorted) {
								// If is set a search...
								if(isset($_GET['search']) && $_GET['search'] != '')
									$s = '&search='.$_GET['search'];
								else
									$s = '';
									
								if($sort == $sorted['c']) {
									if($sort_direction == 'DESC') {
										$arrow = '<i class="fa fa-sort-down"></i>';
										$direction = 'a';
									}else{
										$arrow = '<i class="fa fa-sort-up"></i>';
										$direction = 'd';
									}
									echo '<th width="'.$sorted['width'].'" data-sort="'.$base_url . 'panel/admin/all-desktop-news/?sort='.$sorted['c'].'&w='.$direction.$s.'">';
									echo '<i class="fa fa-sort hid"></i>'.$arrow.$sorted['title'];
									echo '</th>';
								}else{
									echo '<th width="'.$sorted['width'].'" data-sort="'.$base_url . 'panel/admin/all-desktop-news/?sort='.$sorted['c'].'&w=d'.$s.'">';
									echo '<i class="fa fa-sort"></i>'.$sorted['title'];
									echo '</th>';
								}
							}
							?>
								<th width="15%">Actions</th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($all_news->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/admin/desktop-news/' . $row->id; ?>">
								<td><?php echo $row->id; ?></td>

								<td><?php echo $row->subject; ?></td>                               
								<td>
									<?php echo date('M jS, Y \a\t H:i:s', strtotime($row->create_at)); ?>
								</td>
								<td>
									<?php


											echo '<a href="'.$base_url.'panel/admin/desktop-news/'.$row->id.'/delete" title="Delete news" name="delete-admin"><i class="fa fa-close"></i></a>';

									?>
									
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<div id="pagination">
						<?php
						// If is set a sort..
						if(isset($_GET['sort']) && $_GET['sort'] != '' && isset($_GET['w']) && $_GET['w'] != '')
							$srt = '&sort='.$_GET['sort'].'&w='.$_GET['w'];
						else
							$srt = '';
						
						if($page > 1) {
							if(isset($_GET['search']))
								echo '<a href="' . $base_url . 'panel/admin/all-desktop-news/?page=' . ($page-1) . '&search='.$_GET['search'].$srt.'" class="prev"><i class="fa fa-caret-left"></i></a>';
							else
								echo '<a href="' . $base_url . 'panel/admin/all-desktop-news/?page=' . ($page-1) . $srt .'" class="prev"><i class="fa fa-caret-left"></i></a>';
						}
						if($total_pages > $page) {
							if(isset($_GET['search']))
								echo '<a href="' . $base_url . 'panel/admin/all-desktop-news/?page=' . ($page+1) . '&search='.$_GET['search'].$srt.'" class="next"><i class="fa fa-caret-right"></i></a>';
							else
								echo '<a href="' . $base_url . 'panel/admin/all-desktop-news/?page=' . ($page+1) . $srt .'" class="next"><i class="fa fa-caret-right"></i></a>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
	<script src="<?php echo asset_url(); ?>js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo asset_url(); ?>js/tickerr_core.js"></script>
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
			

			
			$('a[name=delete-admin]').click(function(evt) {
				var c = confirm("Are you sure you want to delete this News");
				if(c == false) {
					evt.preventDefault();
					return false;
				}
			});
			

			$('button[name=drop]').click(function(evt) {
				evt.preventDefault();
				var to = $(this).data('drop');
				
				$('.dropdwn[name=dropdwn-'+to+']').slideToggle(300);
			});
			
			var e_active = false;
			function error(e, n) {
				if(e_active != false) {
					$(e_active).removeClass('error');
				}
				
				$(n).addClass('error');
				e_active = n;
				
				$('p.bg-danger').slideUp(200, function() {
					$('p.bg-danger').html(e).slideDown(200);
				});
			}
			


		});
	</script>
</body>
</html>