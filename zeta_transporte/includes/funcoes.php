<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function protegerPagina() {
    if (!isset($_SESSION["usuario_id"])) {
        header("Location: login.php");
        exit;
    }
}

function limpar($texto) {
    return htmlspecialchars($texto ?? "", ENT_QUOTES, "UTF-8");
}
?>