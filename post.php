<?php
// Arquivo onde os posts são armazenados
$postsFile = 'posts.json';

// Carregar os posts do arquivo
$posts = json_decode(file_get_contents($postsFile), true);

// Verificar se o ID do post foi passado via GET
if (isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Verifica se o ID do post existe
    if (isset($posts[$postId])) {
        $post = $posts[$postId]; // Obtém o post específico
    } else {
        // Caso o post não exista
        echo "Post não encontrado!";
        exit;
    }
} else {
    // Caso o ID não tenha sido fornecido
    echo "Post não encontrado!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Processando Dados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="imgs/logo.png" alt="Logo">
        <nav>
            <a href="blog.php">Home</a>
            <a href="#sobre">Sobre</a>
        </nav>
    </div>
</header>

<main>
    <section id="post">
        <h2><?php echo htmlspecialchars($post['title']); ?></h2>
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
        <p><strong>Resumo:</strong> <?php echo nl2br(htmlspecialchars($post['summary'])); ?></p>
        <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        <small>Postado em: <?php echo $post['date']; ?></small>
        
        <!-- Exibe a imagem se houver -->
        <?php if (!empty($post['image'])): ?>
            <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Imagem do Post" style="max-width: 100%; height: auto;">
        <?php endif; ?>
    </section>
</main>

<footer>
    <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
