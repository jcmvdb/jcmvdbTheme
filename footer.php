<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Palmeria
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="wrapper footer-wrapper">
        <div class="text-center social-footer">
            <a href="https://twitter.com/Jcmvdb1"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/jcmvdb1/"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitch.tv/jcmvdb"><i class="fab fa-twitch"></i></a>
            <a href=""><i class="fab fa-linkedin"></i></a>
            <a href=""><i class="fab fa-github"></i></a>
        </div><br>
        <?php
        if (has_nav_menu('menu-2')):
            wp_nav_menu(array(
                'theme_location' => 'menu-2',
                'menu_class' => 'footer-menu',
                'depth' => 1,
            ));
        endif;

        if (has_nav_menu('menu-3')):
            wp_nav_menu(array(
                'theme_location' => 'menu-3',
                'menu_class' => 'theme-social-menu footer-socials',
                'depth' => 1,
                'link_before' => '<span class="menu-text">',
                'link_after' => '</span>',
            ));
        endif;

        ?>
        <div class="site-info">
            <?php
            $dateObj = new DateTime;
            $current_year = $dateObj->format("Y");

            printf(
                wp_kses_post(get_theme_mod('palmeria_footer_text',
                    sprintf(
                        _x('%2$s &copy; %1$s All Rights Reserved.<br> <span style="opacity: .8;">Made by <a href="https://jcmvdb.com" rel="nofollow">jcmvdb</a>.</span>', 'Default footer text. %1$s - current year, %2$s - site title.', 'palmeria'),
                        $current_year,
                        get_bloginfo('name')
                    )
                )),
                $current_year,
                get_bloginfo('name')
            );

            ?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
