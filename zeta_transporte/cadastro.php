<?php
require_once "config/conexao.php";
require_once "includes/funcoes.php";
$erro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $usuario = trim($_POST["usuario"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if ($nome === "" || $usuario === "" || $email === "" || $senha === "") {
        $erro = "Preencha todos os campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Digite um e-mail válido.";
    } elseif (strlen($senha) < 6) {
        $erro = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $consulta = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");
        $consulta->execute([$usuario, $email]);
        if ($consulta->fetch()) {
            $erro = "Este usuário ou e-mail já está cadastrado.";
        } else {
            $senhaProtegida = password_hash($senha, PASSWORD_DEFAULT);
            $inserir = $pdo->prepare("INSERT INTO usuarios (nome, usuario, email, senha) VALUES (?, ?, ?, ?)");
            $inserir->execute([$nome, $usuario, $email, $senhaProtegida]);
            header("Location: login.php?cadastro=ok");
            exit;
        }
    }
}
$titulo = "Cadastro";
require_once "includes/cabecalho.php";
?>
<section class="container py-5">
    <div class="formulario mx-auto">
        <h2 class="fw-bold">Crie sua conta</h2>
        <p class="text-secondary">Cadastre-se para acessar a área do cliente.</p>
        <?php if ($erro): ?><div class="alert alert-danger"><?= limpar($erro) ?></div><?php endif; ?>
        <form method="POST">
            <label class="form-label">Nome completo</label>
            <input class="form-control mb-3" type="text" name="nome" required>
            <label class="form-label">Nome de usuário</label>
            <input class="form-control mb-3" type="text" name="usuario" required>
            <label class="form-label">E-mail</label>
            <input class="form-control mb-3" type="email" name="email" required>
            <label class="form-label">Senha (mínimo 6 caracteres)</label>
            <input class="form-control mb-3" type="password" name="senha" minlength="6" required>
            <button class="btn btn-danger w-100">Cadastrar</button>
        </form>
        <p class="mt-3 mb-0">Já possui conta? <a href="login.php">Faça login</a>.</p>
    </div>
</section>
<?php require_once "includes/rodape.php"; ?>