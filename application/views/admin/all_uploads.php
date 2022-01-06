<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<meta charset="utf-8" />
<div class="content">
    <div class="page-title-cont clearfix">
        <h3>Upload Files</h3>
    </div>

    <div class="row">
        <div class="col margin-top col-sm-12">
            <div class="cont clearfix">

                <div class="head clearfix">
                    <form method="post" action="" name="general-settings" enctype="multipart/form-data" style="display: inline;">
                    <div class="form-group">

                        <span class="label_desc">
										Maximum  File  Size for Upload is <strong>120 MB</strong>. Previous File will be Replaced with new File
									</span>


                        <div class="upload-files">
                            <div class="file">
                                <button name="selected_file" class="btn btn-upload-file btn-light-blue" id="fld" style="font-size: 14px;">Select file to upload...</button>
                                <input type="submit" name="submit" id="sbt" class="btn btn-upload-file btn-light-blue" value="Upload" style="margin-top: 0px;font-size: 12px;" disabled />
                                <input type="file" name="file_login_logo"  style="display:none;" />
                            </div>
                        </div>

                        <br />
                        <?php

                        if (!isset($error))
                            echo '<p class="bg-danger" style="display:none"></p>';
                        else
                            echo '<p class="bg-danger">' . $error . '</p>';

                        if (!isset($success))
                            echo '<p class="bg-success" style="display:none"></p>';
                        else
                            echo '<p class="bg-success">' . $success . '</p>';


                        ?>

                    </div>
                    </form>
                    <div class="pull-right">
                            <div class="clearfix">
                                <div class="pull-right search">
                                    <form method="get" action="" name="search-1">
                                        <input type="text" name="search" placeholder="Enter search query and press enter" <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>/>
                                    </form>
                                </div>

                            </div>

                        </div>

                </div>




                <?php
                if($all_files_count == 0)
                    echo 'No Files';
                else{
                    ?>
                    <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                            <thead>
                            <tr>
                                <?php
                                $sorting = array(
                                    array(
                                        'c' => 1,
                                        'width' => '2%',
                                        'title' => 'SL'
                                    ),
                                    array(
                                        'c' => 2,
                                        'width' => '78%',
                                        'title' => 'File'
                                    ),

                                    array(
                                        'c' => 3,
                                        'width' => '5%',
                                        'title' => 'View'
                                    ),

                                    array(
                                        'c' => 3,
                                        'width' => '5%',
                                        'title' => 'Download'
                                    ),
                                    array(
                                        'c' => 4,
                                        'width' => '5%',
                                        'title' => 'Delete'
                                    ),
                                    array(
                                        'c' => 5,
                                        'width' => '10%',
                                        'title' => 'Size'
                                    )

                                );

                                foreach($sorting as $sorted) {
                                    // If is set a search...
                                    if(isset($_GET['search']) && $_GET['search'] != '')
                                        $s = '&search='.$_GET['search'];
                                    else
                                        $s = '';

//                                if($sort == $sorted['c']) {
//                                    if($sort_direction == 'DESC') {
//                                        $arrow = '<i class="fa fa-sort-down"></i>';
//                                        $direction = 'a';
//                                    }else{
//                                        $arrow = '<i class="fa fa-sort-up"></i>';
//                                        $direction = 'd';
//                                    }
//                                    echo '<th width="'.$sorted['width'].'" data-sort="'.$base_url . 'panel/admin/all-tickets/?sort='.$sorted['c'].'&w='.$direction.$s.'">';
//                                    echo '<i class="fa fa-sort hid"></i>'.$arrow.$sorted['title'];
//                                    echo '</th>';
//                                }else{
//                                    echo '<th width="'.$sorted['width'].'" data-sort="'.$base_url . 'panel/admin/all-tickets/?sort='.$sorted['c'].'&w=d'.$s.'">';
//                                    echo '<i class="fa fa-sort"></i>'.$sorted['title'];
//                                    echo '</th>';
//                                }
                                    echo '<th width="'.$sorted['width'].'">'.$sorted['title'].'</th>';



                                }
                                ?>
                            </tr>
                            </thead>

                            <tbody >
                            <?php
                            $c=1;
                            if($all_files_count>0) {
                                foreach ($all_files as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo str_replace('/magic/downloads/','',$row['name']); ?></td>
                                        <td><a href="<?php echo $row['name'];?>" target="_blank">View </a></td>
                                        <td><a href="<?php echo $row['name']; ?> "  download>Download</a></td>
                                        <td><a name="delete-file" href="<?php echo $base_url . "panel/admin/all-uploads?del=".$row['path']; ?>" >Delete</a></td>
                                        <td><?php echo  $row['size']." KB"; ?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>

                    <?php
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
            var login_logo = $('input[type=file][name=file_login_logo]');

            var size=Math.round(login_logo[0].files[0].size/(1024),2);
            $('#fld').text(val+" ("+size+" KB)");


            if(size > 120000) {
                alert("Maximum File Size is 120 MB");
                $("#sbt").prop("disabled",true);
            }
            else
                $("#sbt").prop("disabled",false);


        });

        $('a[name=delete-file]').click(function(evt) {
            var c = confirm("Are you sure you want to delete this News");
            if(c == false) {
                evt.preventDefault();
                return false;
            }
        });

        $('form[name=general-settings]').submit(function(evt) {

            //var file_uploads_max_size = $('input[name=file_uploads_max_size]').val();
            var login_logo = $('input[type=file][name=file_login_logo]');


            if(login_logo[0].files.length>0)
            {

                var fsize=Math.round(login_logo[0].files[0].size/(1024*1024),2);
                if(fsize > 12000) {
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