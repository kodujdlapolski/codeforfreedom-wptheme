<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Code_for_Freedom
 * @since Code for Freedom 1.0
 */
?>

<footer>
    <div class="container">
        <nav id="bottom-navigation" class="site-navigation bottom-navigation col-xs-12 col-sm-8 row pull-left"
             role="navigation">
            <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_class' => 'nav-menu')); ?>
        </nav>
        <div class="license col-xs-12 col-sm-3 row pull-right">
            <img src="<?php echo get_template_directory_uri(); ?>/images/licence/cc.png" alt="Creative Commons"/>
            <img src="<?php echo get_template_directory_uri(); ?>/images/licence/cc-share.png"
                 alt="Creative Commons Share alike"/>
            <img src="<?php echo get_template_directory_uri(); ?>/images/licence/cc-person.png" alt="Creative Commons"/>
        </div>
        <div class="inspired col-xs-12 row">
            Inspired by <a href="http://ceehack.org/"
                           target="_blank">ceehack.org</a> by <a href="http://te-st.ru/" target="_blank">Teplitsa</a>
        </div>
    </div>
</footer>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.js"></script>

<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-54238293-1', 'auto');
    ga('send', 'pageview');

</script>

<?php wp_footer(); ?>

</body>
</html>