<?php 
// Si el ID no es 1 osea no es index.php mostrar cierre container si es index no mostrar cierre container (pantalla completa)
if($id_pagina !== 1){
    echo "</div>";
}
?>
    
<?php wp_footer(); ?>
</body>

</html>