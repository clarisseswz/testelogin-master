<?php
require_once "config/conexao.php";
$titulo = "Produtos";
require_once "includes/cabecalho.php";
$consulta = $pdo->query("SELECT * FROM produtos ORDER BY id");
$produtos = $consulta->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="container py-5">
    <div class="text-center mb-4">
        <span class="etiqueta escura">CATÁLOGO ZETA</span>
        <h1 class="fw-bold mt-2">Nossas soluções</h1>
        <p class="text-secondary">Quatro linhas para atender diferentes necessidades.</p>
    </div>
    <div class="row g-3 mb-4">
        <?php foreach (["Transporte", "Armazenagem", "Embalagem", "Acessórios"] as $linha): ?>
            <div class="col-6 col-lg-3"><div class="linha-produto"><?= limpar($linha) ?></div></div>
        <?php endforeach; ?>
    </div>
    <div class="row g-4">
        <?php foreach ($produtos as $produto): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="card produto h-100">
                    <div class="produto-imagem"><?= limpar($produto["icone"]) ?></div>
                    <div class="card-body d-flex flex-column">
                        <small class="text-danger fw-bold"><?= limpar($produto["linha"]) ?></small>
                        <h5 class="mt-1"><?= limpar($produto["nome"]) ?></h5>
                        <p class="text-secondary"><?= limpar($produto["descricao"]) ?></p>
                        <h4 class="mt-auto">R$ <?= number_format($produto["preco"], 2, ",", ".") ?></h4>
                        <a class="btn btn-danger" href="compra.php?id=<?= (int)$produto["id"] ?>">Comprar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php require_once "includes/rodape.php"; ?>