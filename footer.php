<?php
// Si el ID no es 1 osea no es index.php mostrar cierre container si es index no mostrar cierre container (pantalla completa)
if ($id_pagina !== 1) {
    echo "</div>";
}
?>
</div>
<footer>
    
        <div class="headerTop">
            <div class="containerPreNav preNav">
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
        
        <div class="container">
            <div class="navbar-footer">
                <nav>
                    <ul>
                        <li><a href="<?php echo get_site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/noticias">Noticias</a></li>
                        <li><a href="<?php echo get_site_url(); ?>/turnos">Turnos</a></li>
                        <li><?php if(is_user_logged_in() == true){ echo '<a href="'.get_site_url().'/logout">LogOut</a>';}else{ echo '<a href="'.get_site_url().'/login">LogIn</a>';}   ?></li>
                        <?php if(!is_user_logged_in() == true){ echo '<li><a href="'.get_site_url().'/signup">Registrarse</a></li>';}?>
                    </ul>
                </nav>
            </div>
            <span>Sitio Web creado por Javier Pons . Copyright &copy 2019</span>
        </div>
</footer>

<?php wp_footer();?>
</body>

</html>