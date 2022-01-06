<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="sidebar-left" id="sidebar">

    <div class="top">

        <span class="big"><?php echo $user_info->name; ?></span>

        <span class="small">

				<?php

                if($user_info->role == '1') echo $this->lang->line('text_client');

                elseif($user_info->role == '2') echo $this->lang->line('text_agent');

                else echo $this->lang->line('text_administrator');

                ?>

			</span>

    </div>



    <?php

    // 2=Agent, 3=Admin

    //if($user_info->role == '2' || $user_info->role == '3') {
 	if($user_info->role == '2') {        

        ?>



        <span class="nav-title">AGENT DASHBOARD (MY ACCOUNT)</span>

        <ul class="navigation">

            <li<?php if($current_page == 1) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/' ?>">

                    <i class="fa fa-home"></i>Dashboard

                </a>

            </li>

            <li<?php if($current_page == 40) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/all-files' ?>">

                    <i class="fa fa-file"></i>Search

                </a>

            </li>



            <li>

                <a href="javascript:;">

                    <i class="fa fa-list"></i>Tickets

                    <span class="badge pull-right"><?php echo $sidebar_agent_tickets; ?></span>

                    <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

                </a>



                <?php

                if($current_page == 2 || $current_page == 3 || $current_page == 4 || $current_page == 5 || $current_page == 6)

                    echo '<ul class="dropdown open">';

                else

                    echo '<ul class="dropdown">';

                ?>

            <li<?php if($current_page == 2) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/all-tickets' ?>">

                    <i class="fa fa-list"></i>All

                </a>

            </li>

            <li<?php if($current_page == 3) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/new-tickets' ?>">

                    <i class="fa fa-exclamation-circle"></i>New

                    <span class="badge pull-right"><?php echo $sidebar_agent_new_tickets; ?></span>

                </a>

            </li>

            <li<?php if($current_page == 4) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/open-tickets' ?>">

                    <i class="fa fa-mail-reply"></i>Open

                    <span class="badge pull-right"><?php echo $sidebar_agent_open_tickets; ?></span>

                </a>

            </li>

            <li<?php if($current_page == 5) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/closed-tickets' ?>">

                    <i class="fa fa-lock"></i>Closed

                </a>

            </li>

            <li<?php if($current_page == 6) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/pending-tickets' ?>">

                    <i class="fa fa-mail-forward"></i>Pending

                </a>

            </li>

        </ul>

        </li>

        <li>

            <a href="javascript:;">

                <i class="fa fa-bug"></i>Bugs

                <span class="badge pull-right"><?php echo $sidebar_agent_bugs; ?></span>

                <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

            </a>



            <?php

            if($current_page == 7 || $current_page == 8 || $current_page == 9)

                echo '<ul class="dropdown open">';

            else

                echo '<ul class="dropdown">';

            ?>

        <li<?php if($current_page == 7) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/free-bugs' ?>">

                <i class="fa fa-list"></i>Free

                <span class="badge pull-right"><?php echo $sidebar_agent_free_bugs; ?></span>

            </a>

        </li>

        <li<?php if($current_page == 8) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/my-bugs' ?>">

                <i class="fa fa-list"></i>My bugs

                <span class="badge pull-right"><?php echo $sidebar_agent_my_bugs; ?></span>

            </a>

        </li>

        <li<?php if($current_page == 9) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/solved-bugs' ?>">

                <i class="fa fa-check"></i>Solved

            </a>

        </li>

        </ul>

        </li>

        <?php if($user_info->role == '2') { ?>

            <li <?php if($current_page == 43) echo ' class="active"'; ?> >

                <a href="<?php echo $base_url . 'panel/all-customers' ?>">

                    <i class="fa fa-user"></i>Customers

                </a>

            </li>

        <?php } ?>

        <li<?php if($current_page == 10) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/account-settings' ?>">

                <i class="fa fa-gear"></i>Account Settings

            </a>

        </li>

        <li class="navbar-collapsed-link">

            <a href="home.html">

                <i class="fa fa-sign-out"></i>Logout

            </a>

        </li>

        </ul>



        <?php

    }

    ?>





    <?php

    // 3=Admin

    if($user_info->role == '3') {

        ?>

        <span class="nav-title">ADMIN DASHBOARD (SITE)</span>

        <ul class="navigation">

            <li<?php if($current_page == 1) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/' ?>">

                    <i class="fa fa-home"></i>Dashboard

                </a>

            </li>
            
             <li>

                <a href="javascript:;">

                    <i class="fa fa-list"></i>Tickets

                    <span class="badge pull-right"><?php echo $sidebar_agent_tickets; ?></span>

                    <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

                </a>



                <?php

                if($current_page == 2 || $current_page == 3 || $current_page == 4 || $current_page == 5 || $current_page == 6)

                    echo '<ul class="dropdown open">';

                else

                    echo '<ul class="dropdown">';

                ?>

                <li<?php if($current_page == 2) echo ' class="active"'; ?>>
    
                    <a href="<?php echo $base_url . 'panel/all-tickets' ?>">
    
                        <i class="fa fa-list"></i>All
    
                    </a>
    
                </li>

                <li<?php if($current_page == 3) echo ' class="active"'; ?>>
    
                    <a href="<?php echo $base_url . 'panel/new-tickets' ?>">
    
                        <i class="fa fa-exclamation-circle"></i>New
    
                        <span class="badge pull-right"><?php echo $sidebar_agent_new_tickets; ?></span>
    
                    </a>
    
                </li>

                <li<?php if($current_page == 4) echo ' class="active"'; ?>>
    
                    <a href="<?php echo $base_url . 'panel/open-tickets' ?>">
    
                        <i class="fa fa-mail-reply"></i>Open
    
                        <span class="badge pull-right"><?php echo $sidebar_agent_open_tickets; ?></span>
    
                    </a>
    
                </li>

                <li<?php if($current_page == 5) echo ' class="active"'; ?>>
    
                    <a href="<?php echo $base_url . 'panel/closed-tickets' ?>">
    
                        <i class="fa fa-lock"></i>Closed
    
                    </a>
    
                </li>

                <li<?php if($current_page == 6) echo ' class="active"'; ?>>
    
                    <a href="<?php echo $base_url . 'panel/pending-tickets' ?>">
    
                        <i class="fa fa-mail-forward"></i>Pending
    
                    </a>
    
                </li>

         </ul>

        </li>

        <li<?php if($current_page == 37) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-ecu-files' ?>">

                <i class="fa fa-area-chart"></i>ECU Files

				<span class="badge pull-right"><?php if($sidebar_admin_new_ecufiles>0) echo $sidebar_admin_new_ecufiles; ?></span>

            </a>

        </li>

    





        <li<?php if($current_page == 29) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-news' ?>">

                <i class="fa fa-newspaper-o"></i>News

            </a>

        </li>

        <li<?php if($current_page == 30) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-uploads' ?>">

                <i class="fa fa-upload"></i>Upload

            </a>

        </li>





        <li<?php if($current_page == 33) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-vehicles' ?>">

                <i class="fa fa-car"></i>Vehicles

            </a>

        </li>

        <li<?php if($current_page == 34) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-ecu' ?>">

                <i class="fa fa-bolt"></i>ECU

            </a>

        </li>

        <li<?php if($current_page == 36) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-desktop-users' ?>">

                <i class="fa fa-desktop"></i>Desktop Users

            </a>

        </li>

        <li<?php if($current_page == 45) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-desktop-news' ?>">

                <i class="fa fa-newspaper-o"></i>Desktop News

            </a>

        </li>

         <li<?php if($current_page == 38) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/ecm-settings' ?>">

                <i class="fa fa-gear"></i>ECU Service Settings

            </a>


        </li>



        <li>

            <a href="javascript:;">

                <i class="fa fa-gears"></i>Site Settings

                <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

            </a>



            <?php

            if($current_page == 22 ||$current_page == 24 || $current_page == 25 || $current_page == 26 || $current_page == 27 || $current_page == 28 || $current_page == 35)

                echo '<ul class="dropdown open">';

            else

                echo '<ul class="dropdown">';

            ?>

        <li<?php if($current_page == 24) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/general-settings' ?>">

                <i class="fa fa-gear"></i>General Settings

            </a>

        </li>
        
        

        <li<?php if($current_page == 22) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/all-users' ?>">

                <i class="fa fa-users"></i>Users

            </a>

        </li>

        

        <li<?php if($current_page == 35) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/logo-settings' ?>">

                <i class="fa fa-gear"></i>Logo Settings

            </a>

        </li>

        <li<?php if($current_page == 25) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/mailer-settings' ?>">

                <i class="fa fa-gear"></i>Mailer Settings

            </a>

        </li>

        <li<?php if($current_page == 26) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/econfirm-settings' ?>">

                <i class="fa fa-gear"></i>Email Confirmations

            </a>

        </li>

        <li<?php if($current_page == 27) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/admin/arecovery-settings' ?>">

                <i class="fa fa-gear"></i>Account Recoveries

            </a>

        </li>







        </ul>

        </li>

        </ul>

        <?php

    }

    ?>





    <?php

    // 1=Client

    if($user_info->role == '1') {

        ?>

        <span class="nav-title"><?php echo $this->lang->line('text_client_dashboard');?></span>

        <ul class="navigation">

            <li<?php if($current_page == 41) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/all-news' ?>">

                    <i class="fa fa-newspaper-o"></i><?php echo $this->lang->line('text_News');?>

                </a>

            </li>

            <li<?php if($current_page == 24) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/dashboard' ?>">

                    <i class="fa fa-home"></i><?php echo $this->lang->line('text_dashboard');?>            </a>

            </li>

            <li<?php if($current_page == 40) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/all-files' ?>">

                    <i class="fa fa-file"></i><?php echo $this->lang->line('text_search');?>

                </a>

            </li>



            <li<?php if($current_page == 25) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/new-ticket' ?>">

                    <i class="fa fa-list"></i><?php echo $this->lang->line('text_create_new_ticket');?>



                </a>

            </li>

            <li<?php if($current_page == 26) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/new-bug-report' ?>">

                    <i class="fa fa-bug"></i><?php echo $this->lang->line('text_new_bug_report');?>

                </a>

            </li>

            <li>

                <a href="javascript:;">

                    <i class="fa fa-list"></i><?php echo $this->lang->line('text_new_tickets');?>

                    <span class="badge pull-right"><?php echo $sidebar_client_open_tickets; ?></span>

                    <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

                </a>



                <?php

                if($current_page == 27 || $current_page == 28 || $current_page == 29 || $current_page == 30 || $current_page == 31)

                    echo '<ul class="dropdown open">';

                else

                    echo '<ul class="dropdown">';

                ?>

            <li<?php if($current_page == 27) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/all-tickets' ?>">

                    <i class="fa fa-list"></i><?php echo $this->lang->line('text_all');?>

                </a>

            </li>

            <li<?php if($current_page == 28) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/new-tickets' ?>">

                    <i class="fa fa-exclamation-circle"></i><?php echo $this->lang->line('text_new');?>

                </a>

            </li>

            <li<?php if($current_page == 29) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/open-tickets' ?>">

                    <i class="fa fa-mail-reply"></i><?php echo $this->lang->line('text_open');?>

                    <span class="badge pull-right"><?php echo $sidebar_client_open_tickets; ?></span>

                </a>

            </li>

            <li<?php if($current_page == 30) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/closed-tickets' ?>">

                    <i class="fa fa-lock"></i><?php echo $this->lang->line('text_closed');?>

                </a>

            </li>

            <li<?php if($current_page == 31) echo ' class="active"'; ?>>

                <a href="<?php echo $base_url . 'panel/pending-tickets' ?>">

                    <i class="fa fa-mail-forward"></i><?php echo $this->lang->line('text_pending');?>

                </a>

            </li>

        </ul>

        </li>

        <li>

            <a href="javascript:;">

                <i class="fa fa-bug"></i><?php echo $this->lang->line('text_bugs');?>

                <span class="arrow pull-right"><i class="fa fa-angle-right"></i></span>

            </a>



            <?php

            if($current_page == 32 || $current_page == 33 || $current_page == 34)

                echo '<ul class="dropdown open">';

            else

                echo '<ul class="dropdown">';

            ?>

        <li<?php if($current_page == 32) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/all-bugs' ?>">

                <i class="fa fa-list"></i><?php echo $this->lang->line('text_all');?>

            </a>

        </li>

        <li<?php if($current_page == 33) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/solved-bugs' ?>">

                <i class="fa fa-check"></i><?php echo $this->lang->line('text_solved');?>

            </a>

        </li>

        </ul>

        </li>

        <li<?php if($current_page == 10) echo ' class="active"'; ?>>

            <a href="<?php echo $base_url . 'panel/account-settings' ?>">

                <i class="fa fa-gear"></i><?php echo $this->lang->line('text_account_settings');?>

            </a>

        </li>

        <li class="navbar-collapsed-link">

            <a href="<?php echo $base_url . 'panel/logout' ?>">

                <i class="fa fa-sign-out"></i>Logout

            </a>

        </li>

        </ul>

        <?php

    }

    ?>

</div>