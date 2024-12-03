<?php
// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os valores enviados
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lógica de verificação (aqui você pode adicionar a validação com banco de dados)
    if ($username === 'admin' && $password === 'senha123') {
        // Redirecionar para a página de administração
        header('Location: dashboard.php'); // Página de administração após login
        exit; // Importante para evitar que o código continue executando
    } else {
        $erro = 'Usuário ou senha inválidos.'; // Mensagem de erro
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processando Dados - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="imgs/logo.png" alt="Logo do Processando Dados">
    </div>
    <nav>
        <a href="blog.php">Home</a>
        <a href="#sobre">Sobre</a>
        <a href="autores.php">Autores</a>
    </nav>
</header>


    <main>
        <section id="login">
            <h2>Área de Login</h2>
            <form action="login.php" method="POST">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required><br>

                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required><br>

                <button type="submit">Entrar</button>
            </form>

            <!-- Exibir a mensagem de erro se o login falhar -->
            <?php if (isset($erro)): ?>
                <div class="erro">
                    <p style="color: red;"><?php echo $erro; ?></p>
                </div>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>
