<!DOCTYPE html> 
<html <?php language_attributes(); ?>> 
 
<head> 
 <meta http-equiv="X-UA-Compatible" content="IE=edge"/> 
 <meta charset="<?php bloginfo( 'charset' ); ?>"> 
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes"> 
 <meta name="format-detection" content="telephone=no,email=no,url=no"> 
 
 <?php wp_head(); ?> 
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-md bg-white navbar-custom">

                            <a href="<?php echo home_url(); ?>">
                                <img src="/wp-content/themes/test-theme/assets/img/Purple-Planet.svg" alt="logo" height='50px' width='50px'>
                            </a>

                            <?php if (has_nav_menu( 'header_menu')) { ?>
                                <button type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#navbarNav" 
                                class="navbar-toggler" 
                                aria-controls="navbarNav" 
                                aria-expanded="false" 
                                aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                    <span class="navbar-toggler-icon"></span>
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                                    <?php wp_nav_menu( array(
                                        'theme_location' => 'header_menu',
                                        'menu_class' => 'navbar-nav',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    ) ); ?>
                                </div>
                            <?php } ?>
                        </nav> 
                    </div>
                </div>
            </div>
        </div>