<?php
require_once "config/conexao.php";
require_once "includes/funcoes.php";
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$consulta = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$consulta->execute([$id]);
$produto = $consulta->fetch(PDO::FETCH_ASSOC);
$titulo = "Compra";
require_once "includes/cabecalho.php";
?>
<section class="container py-5">
<?php if (!$produto): ?>
    <div class="alert alert-warning">Produto não encontrado. <a href="produtos.php">Voltar ao catálogo</a>.</div>
<?php else: ?>
    <div class="formulario mx-auto">
        <span class="etiqueta escura">FINALIZAR PEDIDO</span>
        <h2 class="mt-2"><?= limpar($produto["nome"]) ?></h2>
        <p><?= limpar($produto["descricao"]) ?></p>
        <h3 class="text-danger">R$ <?= number_format($produto["preco"], 2, ",", ".") ?></h3>
        <p class="text-secondary">Promoção ilustrativa: consulte a equipe para confirmar condições e disponibilidade.</p>
        <hr>
        <h5>Escolha uma forma de pagamento</h5>
        <div class="alert alert-info">Esta é uma demonstração acadêmica. Nenhum pagamento será cobrado nesta página.</div>
        <div class="border rounded p-3 mb-2"><strong>Pix</strong><br><small>Em uma integração real, o QR Code seria gerado pelo provedor. Parcelamento em até 12 vezes depende das condições do provedor e não é uma característica padrão do Pix.</small></div>
        <div class="border rounded p-3 mb-2"><strong>Cartão de crédito</strong><br><small>Até 6 vezes sem juros, conforme configuração comercial e aprovação do provedor.</small></div>
        <div class="border rounded p-3 mb-2"><strong>Mercado Pago / PayPal / Santander</strong><br><small>Integrações aguardam credenciais e configuração das contas de pagamento.</small></div>
        <a href="produtos.php" class="btn btn-danger w-100 mt-3">Voltar aos produtos</a>
    </div>
<?php endif; ?>
</section>
<?php require_once "includes/rodape.php"; ?>