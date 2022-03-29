<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<div class="content">
		<div class="page-title-cont clearfix">
			<h3><?php echo $this->lang->line('text_dashboard');?> </h3>
		</div>
		
		<div class="row dash-stats">
			<div class="cl col-xs-6 col-sm-4 col-lg-3">
				<div class="box yellow">
					<span class="big"><?php echo $top_counter['pending_tickets']; ?></span>
					<span class="down"><?php echo $this->lang->line('text_tickets_awaiting_your_response');?></span>
				</div>
			</div>
			<div class="cl col-xs-6 col-sm-4 col-lg-3">
				<div class="box red">
					<span class="big"><?php echo $top_counter['no_agent_tickets']; ?></span>
					<span class="down"><?php echo $this->lang->line('text_tickets_without_an_agent');?></span>
				</div>
			</div>
			<div class="cl col-xs-6 col-sm-4 col-lg-3">
				<div class="box light-blue">
					<span class="big"><?php echo $top_counter['pending_agent_tickets']; ?></span>
					<span class="down"><?php echo $this->lang->line('text_tickets_awaiting_agents_response');?></span>
				</div>
			</div>
			<div class="cl col-xs-6 col-sm-4 col-lg-3">
				<div class="box green">
					<span class="big"><?php echo $top_counter['solved_tickets']; ?></span>
					<span class="down"><?php echo $this->lang->line('text_solved_tickets');?></span>
				</div>
			</div>
		</div>
		
		<div class="row padding-fix">
			<div class="col no-bottom-padding col-sm-12">
				<div class="cont">
					<div class="head clearfix">
						<h4 class="pull-left"><?php echo $this->lang->line('text_tickets_awaiting_your_response');?></h4>
						<div class="pull-right search">
							<form method="get" action="<?php echo $base_url; ?>panel/open-tickets" name="search-1">
								<input type="text" name="query" placeholder="<?php echo $this->lang->line('text_enter_search_query_and_press_enter');?>"   />
							</form>
						</div>
					</div>
					
					<?php
					if($top_counter['pending_tickets'] == 0)
						echo $this->lang->line('text_no_tickets');
					else {
					?>
					<table class="table tickets">
						<thead>
							<tr>
								<th width="5%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=1&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_ID');?></th>
								<th width="25%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=2&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_subject');?></th>
								<th width="12%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=3&w=a' ?>"><i class="fa fa-sort hid"></i><i class="fa fa-sort-down"></i><?php echo $this->lang->line('text_priority');?></th>
								<th width="16%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=4&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_agent');?></th>
								<th width="20%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=5&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Department');?></th>
								<th width="22%" data-sort="<?php echo $base_url . 'panel/open-tickets/?type=1sort=6&w=a' ?>" class="md-hide"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Last_Event');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($tickets_awaiting->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/ticket/' . $row->access; ?>">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td>
									<?php
									if($row->priority == '1')
										echo "<div class='badge red'>".$this->lang->line('text_HIGH')."</div>";
									elseif($row->priority == '2')
										echo "<div class='badge yellow'>".$this->lang->line('text_MEDIUM')."</div>";
									else
										echo "<div class='badge green'>".$this->lang->line('text_LOW')."</div>";
									?>
								</td>
								<td>
									<?php
                                    if($row->agentid>0) {
                                        $user_info = $users_model->get_user_info($row->agentid);
                                        echo $user_info->name;
                                    }

									?>
								</td>
								<td>
									<?php echo $tickets_model->get_department_name($row->department); ?>
								</td>
								<td>
									<?php
									if($row->last_update == '0000-00-00 00:00:00')
										echo date('M jS, Y \a\t H:i:s', strtotime($row->date));
									else
										echo date('M jS, Y \a\t H:i:s', strtotime($row->last_update));
									?>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<?php
					if($top_counter['pending_tickets'] > 9)
						echo '<div class="load-more">'.$this->lang->line("text_Load_More").'</div>';
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="row padding-fix">
			<div class="col no-bottom-padding col-sm-12">
				<div class="cont">
					<div class="head clearfix">
						<h4 class="pull-left"><?php echo $this->lang->line('text_tickets_awaiting_agents_response');?></h4>
						<div class="pull-right search">
							<form method="get" action="<?php echo $base_url; ?>panel/pending-tickets" name="search-2">
								<input type="text" name="query" placeholder="<?php echo $this->lang->line('text_enter_search_query_and_press_enter');?>" />
							</form>
						</div>
					</div>
					
					<?php
					if($top_counter['pending_agent_tickets'] == 0)
						echo $this->lang->line("text_no_tickets");
					else {
					?>
					<table class="table tickets">
						<thead>
							<tr>
								<th width="5%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=1&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_ID');?></th>
								<th width="25%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=2&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Title');?></th>
								<th width="12%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=3&w=a' ?>"><i class="fa fa-sort hid"></i><i class="fa fa-sort-down"></i><?php echo $this->lang->line('text_priority');?></th>
								<th width="16%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=4&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Agent');?></th>
								<th width="20%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=5&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Department');?></th>
								<th width="22%" data-sort="<?php echo $base_url . 'panel/pending-tickets/?type=2sort=6&w=a' ?>" class="md-hide"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Last_Event');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($tickets_awaiting_agent->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/ticket/' . $row->access; ?>">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td>
									<?php
									if($row->priority == '1')
										echo '<div class="badge red">'.$this->lang->line("text_HIGH").'</div>';
									elseif($row->priority == '2')
										echo '<div class="badge yellow">'.$this->lang->line("text_MEDIUM").'</div>';
									else
										echo '<div class="badge green">'.$this->lang->line("text_LOW").'</div>';
									?>
								</td>
								<td>
									<?php
									echo $row->agent_final_name;
									?>
								</td>
								<td>
									<?php echo $tickets_model->get_department_name($row->department); ?>
								</td>
								<td>
									<?php
									if($row->last_update == '0000-00-00 00:00:00')
										echo date('M jS, Y \a\t H:i:s', strtotime($row->date));
									else
										echo date('M jS, Y \a\t H:i:s', strtotime($row->last_update));
									?>
								</td >
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<?php
					if($top_counter['pending_agent_tickets'] > 9)
						echo '<div class="load-more">'.$this->lang->line("text_Load_More").'</div>';
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col no-bottom-padding col-sm-12">
				<div class="cont">
					<div class="head clearfix">
						<h4 class="pull-left"><?php echo $this->lang->line('text_tickets_without_an_agent');?></h4>
						<div class="pull-right search">
							<form method="get" action="<?php echo $base_url; ?>panel/new-tickets" name="search-3">
								<input type="text" name="query" placeholder="<?php echo $this->lang->line('text_enter_search_query_and_press_enter');?>" />
							</form>
						</div>
					</div>
					
					<?php
					if($top_counter['no_agent_tickets'] == 0)
						echo $this->lang->line("text_no_tickets");
					else {
					?>
					<table class="table tickets-w-agent">
						<thead>
							<tr>
								<th width="12%" data-sort="<?php echo $base_url . 'panel/new-tickets/?type=3&sort=1&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_ID');?></th>
								<th width="24%" data-sort="<?php echo $base_url . 'panel/new-tickets/?type=3sort=2&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Title');?></th>
								<th width="30%" data-sort="<?php echo $base_url . 'panel/new-tickets/?type=3sort=3&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Department');?></th>
								<th width="35%" data-sort="<?php echo $base_url . 'panel/new-tickets/?type=3sort=4&w=a' ?>"><i class="fa fa-sort hid"></i><i class="fa fa-sort-down"></i><?php echo $this->lang->line('text_Last_Event');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($tickets_without_agent->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/ticket/' . $row->access; ?>">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td>
									<?php echo $tickets_model->get_department_name($row->department); ?>
								</td>
								<td>
									<?php
									if($row->last_update == '0000-00-00 00:00:00')
										echo date('M jS, Y \a\t H:i:s', strtotime($row->date));
									else
										echo date('M jS, Y \a\t H:i:s', strtotime($row->last_update));
									?>
								</td >
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<?php
					if($top_counter['no_agent_tickets'] > 9)
						echo '<div class="load-more">'.$this->lang->line("text_Load_More").'</div>';
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col no-bottom-padding col-sm-12">
				<div class="cont">
					<div class="head clearfix">
						<h4 class="pull-left"><?php echo $this->lang->line('text_solved_tickets');?></h4>
						<div class="pull-right search">
							<form method="get" action="<?php echo $base_url; ?>panel/closed-tickets" name="search-4">
								<input type="text" name="query" placeholder="<?php echo $this->lang->line('text_enter_search_query_and_press_enter');?>" />
							</form>
						</div>
					</div>
					
					<?php
					if($top_counter['solved_tickets'] == 0)
						echo $this->lang->line("text_no_tickets");
					else {
					?>
					<table class="table tickets-w-agent">
						<thead>
							<tr>
								<th width="12%" data-sort="<?php echo $base_url . 'panel/closed-tickets/?type=3&sort=1&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_ID');?></th>
								<th width="24%" data-sort="<?php echo $base_url . 'panel/closed-tickets/?type=3sort=2&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Title');?></th>
								<th width="30%" data-sort="<?php echo $base_url . 'panel/closed-tickets/?type=3sort=3&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Department');?></th>
								<th width="35%" data-sort="<?php echo $base_url . 'panel/closed-tickets/?type=3sort=4&w=a' ?>"><i class="fa fa-sort hid"></i><i class="fa fa-sort-down"></i><?php echo $this->lang->line('text_Last_Event');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($solved_tickets->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/ticket/' . $row->access; ?>">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td>
									<?php echo $tickets_model->get_department_name($row->department); ?>
								</td>
								<td>
									<?php
									if($row->last_update == '0000-00-00 00:00:00')
										echo date('M jS, Y \a\t H:i:s', strtotime($row->date));
									else
										echo date('M jS, Y \a\t H:i:s', strtotime($row->last_update));
									?>
								</td >
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<?php
					if($top_counter['no_agent_tickets'] > 9)
						echo '<div class="load-more">'.$this->lang->line("text_Load_More").'</div>';
					}
					?>
				</div>
			</div>
		</div>
		
		<div class="row padding-fix">
			<div class="col no-bottom-padding col-sm-12">
				<div class="cont">
					<div class="head clearfix">
						<h4 class="pull-left"><?php echo $this->lang->line('text_bugs_pending_to_be_attended');?></h4>
						<div class="pull-right search">
							<form method="get" action="<?php echo $base_url; ?>panel/all-bugs" name="search-4">
								<input type="text" name="query" placeholder="<?php echo $this->lang->line('text_enter_search_query_and_press_enter');?>" />
							</form>
						</div>
					</div>
					
					<?php
					if($top_counter['pending_bugs'] == 0)
						echo 'No bug reports';
					else {
					?>
					<table class="table bugs">
						<thead>
							<tr>
								<th width="9%" data-sort="<?php echo $base_url . 'panel/all-bugs/?type=1sort=1&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_ID');?></th>
								<th width="28%" data-sort="<?php echo $base_url . 'panel/all-bugs/?type=1sort=2&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Title');?></th>
								<th width="15%" data-sort="<?php echo $base_url . 'panel/all-bugs/?type=1sort=3&w=a' ?>"><i class="fa fa-sort hid"></i><i class="fa fa-sort-down"></i><?php echo $this->lang->line('text_priority');?></th>
								<th width="23%" data-sort="<?php echo $base_url . 'panel/all-bugs/?type=1sort=4&w=a' ?>"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Department');?></th>
								<th width="25%" data-sort="<?php echo $base_url . 'panel/all-bugs/?type=1sort=5&w=a' ?>" ><i class="md-hide"><i class="fa fa-sort"></i><?php echo $this->lang->line('text_Created_On');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php
							foreach($pending_bugs->result() as $row) {
							?>
							<tr data-href="<?php echo $base_url . 'panel/bug/' . $row->access; ?>">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->subject; ?></td>
								<td>
									<?php
									if($row->priority == '1')
                                        echo '<div class="badge red">'.$this->lang->line("text_HIGH").'</div>';
                                    elseif($row->priority == '2')
                                        echo '<div class="badge yellow">'.$this->lang->line("text_MEDIUM").'</div>';
                                    else
                                        echo '<div class="badge green">'.$this->lang->line("text_LOW").'</div>';
                                    ?>

								</td>
								<td>
									<?php echo $bugs_model->get_department_name($row->department); ?>
								</td>
								<td>
									<?php echo date('M jS, Y \a\t H:i:s', strtotime($row->date)); ?>
								</td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
					
					<?php
					if($top_counter['pending_bugs'] > 9)
						echo '<div class="load-more">'.$this->lang->line("text_Load_More").'</div>';
					}
					?>
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
		});
	</script>
</body>
</html>