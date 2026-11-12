<?php
require_once "config/conexao.php";
require_once "includes/funcoes.php";
$mensagem = "";
$erro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    $arquivo = $_FILES["curriculo"] ?? null;

    if ($nome === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$arquivo || $arquivo["error"] !== UPLOAD_ERR_OK) {
        $erro = "Confira os campos e selecione seu currículo.";
    } elseif ($arquivo["size"] > 5 * 1024 * 1024) {
        $erro = "O arquivo deve ter no máximo 5 MB.";
    } else {
        $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
        if (!in_array($extensao, ["pdf", "doc", "docx"])) {
            $erro = "Envie o currículo em PDF, DOC ou DOCX.";
        } else {
            $pasta = __DIR__ . "/uploads/curriculos";
            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }
            $nomeArquivo = bin2hex(random_bytes(12)) . "." . $extensao;
            $destino = $pasta . "/" . $nomeArquivo;
            if (move_uploaded_file($arquivo["tmp_name"], $destino)) {
                $salvar = $pdo->prepare("INSERT INTO curriculos (nome, email, telefone, arquivo) VALUES (?, ?, ?, ?)");
                $salvar->execute([$nome, $email, $telefone, $nomeArquivo]);
                $mensagem = "Currículo enviado! Obrigado pelo interesse.";
            } else {
                $erro = "Não foi possível salvar o arquivo. Verifique a permissão da pasta uploads.";
            }
        }
    }
}
$titulo = "Trabalhe conosco";
require_once "includes/cabecalho.php";
?>
<section class="container py-5">
    <div class="formulario mx-auto">
        <h2 class="fw-bold">Trabalhe conosco</h2>
        <p class="text-secondary">Envie seus dados e anexe seu currículo.</p>
        <?php if ($mensagem): ?><div class="alert alert-success"><?= limpar($mensagem) ?></div><?php endif; ?>
        <?php if ($erro): ?><div class="alert alert-danger"><?= limpar($erro) ?></div><?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <label class="form-label">Nome completo</label>
            <input class="form-control mb-3" name="nome" required>
            <label class="form-label">E-mail</label>
            <input class="form-control mb-3" type="email" name="email" required>
            <label class="form-label">Telefone</label>
            <input class="form-control mb-3" name="telefone">
            <label class="form-label">Currículo (PDF, DOC ou DOCX - até 5 MB)</label>
            <input class="form-control mb-3" type="file" name="curriculo" accept=".pdf,.doc,.docx" required>
            <button class="btn btn-danger w-100">Enviar currículo</button>
        </form>
    </div>
</section>
<?php require_once "includes/rodape.php"; ?>