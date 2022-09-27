<?php
    if(isset($contRefresh) && $contRefresh === 0) {
        $contRefresh = 1;
        header("Location: recarregar2.php");
    }
        $contRefresh = 0;
        session_cache_expire(5);
        session_start();
    
        if(!isset($_SESSION['prox_pagina'])) $_SESSION['prox_pagina'] = "index.php";
        $refresh = "<meta http-equiv='refresh' content='0; url=" . $_SESSION['prox_pagina'] . "'>";
        unset($_SESSION["prox_pagina"]);
        exit($refresh);
?>
