<?php
require_once "config/conexao.php";
require_once "includes/funcoes.php";
if (isset($_SESSION["usuario_id"])) {
    header("Location: dashboard.php");
    exit;
}
$erro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $senha = $_POST["senha"] ?? "";
    $consulta = $pdo->prepare("SELECT id, nome, usuario, senha FROM usuarios WHERE usuario = ? OR email = ?");
    $consulta->execute([$usuario, $usuario]);
    $dados = $consulta->fetch(PDO::FETCH_ASSOC);

    if ($dados && password_verify($senha, $dados["senha"])) {
        session_regenerate_id(true);
        $_SESSION["usuario_id"] = $dados["id"];
        $_SESSION["usuario_nome"] = $dados["nome"];
        $_SESSION["usuario_login"] = $dados["usuario"];
        header("Location: dashboard.php");
        exit;
    } else {
        $erro = "Usuário/e-mail ou senha incorretos.";
    }
}
$titulo = "Login";
require_once "includes/cabecalho.php";
?>
<section class="container py-5">
    <div class="formulario mx-auto">
        <h2 class="fw-bold">Acesse sua conta</h2>
        <p class="text-secondary">Bem-vindo à área do cliente Zeta.</p>
        <?php if (isset($_GET["cadastro"])): ?><div class="alert alert-success">Cadastro realizado! Entre com seus dados.</div><?php endif; ?>
        <?php if ($erro): ?><div class="alert alert-danger"><?= limpar($erro) ?></div><?php endif; ?>
        <form method="POST">
            <label class="form-label">Usuário ou e-mail</label>
            <input class="form-control mb-3" type="text" name="usuario" required>
            <label class="form-label">Senha</label>
            <input class="form-control mb-3" type="password" name="senha" required>
            <button class="btn btn-danger w-100">Entrar</button>
        </form>
        <p class="mt-3 mb-0">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a>.</p>
    </div>
</section>
<?php require_once "includes/rodape.php"; ?>