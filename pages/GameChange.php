<?php
/*
 Template Name: GameChange
 */

$user = wp_get_current_user();
get_header();

$games = $wpdb->get_results('SELECT * FROM `Games` `g`LEFT JOIN `Platform` `p`ON `g`.`PlatformId` = `p`.`PlatformId`LEFT JOIN `Form` `f`ON `g`.`FormId` = `f`.`FormId`WHERE 1');

if (in_array('administrator', (array)$user->roles)) {
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>Search for a game in the list</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">

                                <form action="" method="GET">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control" placeholder="Search game">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Game</th>
                                <th>Developer</th>
                                <th>Form</th>
                                <th>Platform</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $con = mysqli_connect("localhost","root","root","jcmvdbcom");

                            if(isset($_GET['search']))
                            {
                                $filtervalues = $_GET['search'];
//                                $query = "SELECT * FROM `Games` `g`LEFT JOIN `Platform` `p`ON `g`.`PlatformId` = `p`.`PlatformId`LEFT JOIN `Form` `f`ON `g`.`FormId` = `f`.`FormId` WHERE CONCAT(Name) LIKE '%$filtervalues%' ";
//                                $query_run = mysqli_query($con, $query);
                                $gamesearch = $wpdb->get_results("SELECT * FROM `Games` `g`LEFT JOIN `Platform` `p`ON `g`.`PlatformId` = `p`.`PlatformId`LEFT JOIN `Form` `f`ON `g`.`FormId` = `f`.`FormId` WHERE CONCAT(Name) LIKE '%$filtervalues%' ");
//                                echo "Found " . count($gamesearch) . " games";
                                if($gamesearch > 0)
                                {
                                    $i = 1;
                                    foreach($gamesearch as $items)
                                    {
                                        ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $items->Name ?></td>
                                            <td><?= $items->Developer ?></td>
                                            <td><?= $items->Form ?></td>
                                            <td><?= $items->Platform ?></td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td colspan="5">No games found with that in the name</td>
                                    </tr>
                                    <?php
                                }
                            } else {
//                            $filtervalues = $_GET['search'];
//                                $query = 'SELECT * FROM `Games` `g`LEFT JOIN `Platform` `p`ON `g`.`PlatformId` = `p`.`PlatformId`LEFT JOIN `Form` `f`ON `g`.`FormId` = `f`.`FormId` WHERE 1';
//                                $query_run = mysqli_query($con, $query);
                                $i = 1;
                                foreach($games as $items)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $items->Name ?></td>
                                        <td><?= $items->Developer ?></td>
                                        <td><?= $items->Form ?></td>
                                        <td><?= $items->Platform ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
} else {
    ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <section class="error-404 not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'palmeria' ); ?></h1>
                </header><!-- .page-header -->

                <div class="page-content">
                    <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try search?', 'palmeria' ); ?></p>
                    <a href="<?php home_url();?>" class="button"><?php echo esc_html__('Go to home page', 'palmeria');?></a>
                </div>

            </section><!-- .error-404 -->

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
}

get_footer();

?>
