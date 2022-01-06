<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<meta charset="utf-8" />
<div class="content">
    <div class="page-title-cont clearfix">
        <h3>Search Files</h3>
    </div>

    <div class="row">
        <div class="col margin-top col-sm-12">
            <div class="cont clearfix">
                <div class="head clearfix">
                    <div style="width: 50%;  margin: auto;">
                     <form method="get" action="" name="search-1">
                            <input type="text" name="search" placeholder="Enter search query and press enter" <?php if(isset($_GET['search'])) echo 'value="'.$_GET['search'].'"'; ?>/>
                        </form>
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
                                    'c' => 3,
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
                                    <td><?php echo str_replace('/tickerr/downloads/','',$row['name']); ?></td>
                                    <td><a href="<?php echo $row['name'];?>" target="_blank">View </a></td>
                                    <td><a href="<?php echo $row['name']; ?> "  download>Download</a></td>
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
    });
</script>
</body>
</html>