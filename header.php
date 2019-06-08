<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class();?>>
    <div class="headerTop">
        <div class="container preNav">
            <span class="social" style="font-size: 17px; color: #aaa;">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-linkedin-in"></i>
            </span>
            <span class="info">
                <span style="font-size: 17px; color: #5FD3ED;">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>Humberto Primo 7655</p>
                </span>
                <span style="font-size: 17px; color: #5FD3ED;">
                    <i class="fas fa-phone"></i>
                    <p>(0351) 442754</p>
                </span>
                <span style="font-size: 17px; color: #5FD3ED;">
                    <i class="far fa-envelope"></i>
                    <p>info@saludapp.com</p>
                </span>
            </span>
        </div>
    </div>
    <header>
        <div class="container headerLogoMenu">
            <div class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="logo">
            </div>
            <div class="navbar">
                <nav>
                    <ul>
                        <li><a href="<?php echo get_site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/noticias">Noticias</a></li>
                        <li><a href="#">Turnos</a></li>
                        <li><?php if(is_user_logged_in() == true){ echo '<a href="'.get_site_url().'/logout">LogOut</a>';}else{ echo '<a href="'.get_site_url().'/login">LogIn</a>';}   ?></li>
                        <?php if(!is_user_logged_in() == true){ echo '<li><a id="linkSignUp" href="'.get_site_url().'/signup">Registrarse</a></li>';}?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>