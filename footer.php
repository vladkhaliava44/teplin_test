<footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="footer__body">
                        <?php if (has_nav_menu( 'footer_menu')) { ?>
                                    <?php wp_nav_menu( array(
                                        'theme_location' => 'footer_menu',
                                        'menu_class' => 'footer-nav',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    ) ); ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <?php wp_footer(); ?>
</body>
</html>


