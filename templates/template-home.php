<?php

/**
 * Template name: Home page
 */

get_header(); ?>

        <main class="sections">
            <div class="hero">
                <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="hero-title text-center">
                                    <h2 class="strong"><?php echo _e('Future is NOW') ?></h2>
                                    <h1><?php the_title ();?></h1>
                                    <?php the_content ();?>
                                </div>
                            </div>
                        </div>
                </div>    
            </div>
        </main>

<?php get_footer(); ?>