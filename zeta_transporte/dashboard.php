<?php
require_once "includes/funcoes.php";
protegerPagina();
$titulo = "Minha conta";
require_once "includes/cabecalho.php";
?>
<section class="container py-5">
    <div class="painel">
        <span class="etiqueta escura">ÁREA RESTRITA</span>
        <h1 class="mt-2">Olá, <?= limpar($_SESSION["usuario_nome"]) ?>!</h1>
        <p class="text-secondary">Seu login foi realizado com sucesso. Esta é sua área do cliente.</p>
        <div class="row g-3 mt-3">
            <div class="col-md-6"><a class="atalho" href="produtos.php">Ver produtos <span>→</span></a></div>
            <div class="col-md-6"><a class="atalho" href="curriculos.php">Trabalhe conosco <span>→</span></a></div>
        </div>
        <a href="logout.php" class="btn btn-outline-danger mt-4">Sair da conta</a>
    </div>
</section>
<?php require_once "includes/rodape.php"; ?>