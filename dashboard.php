<?php
// Arquivo onde os posts serão armazenados
$postsFile = 'posts.json';

// Verificar se o arquivo de posts existe, caso contrário, criar um arquivo vazio
if (!file_exists($postsFile)) {
    file_put_contents($postsFile, json_encode([]));
}

// Carregar os posts do arquivo
$posts = json_decode(file_get_contents($postsFile), true);

// Verificar se o formulário de novo post foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_POST['content'])) {
    // Verifica se foi enviado uma imagem
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Diretório onde as imagens serão armazenadas
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        
        // Move o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $image = $targetFile; // Armazena o caminho da imagem
        }
    }

    // Adicionar um novo post ao array
    $new_post = [
        'id' => uniqid(), // Identificador único para o post
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'author' => $_POST['author'], // Autor do post
        'summary' => $_POST['summary'], // Resumo do post
        'date' => date('Y-m-d H:i:s'),
        'image' => $image, // Adiciona a imagem ao post
    ];

    // Adicionar o post ao array
    $posts[] = $new_post;

    // Salvar os posts de volta no arquivo
    file_put_contents($postsFile, json_encode($posts));

    // Redirecionar para a página de administração após salvar
    header('Location: dashboard.php');
    exit;
}

// Verificar se foi pedido para excluir um post
if (isset($_GET['delete'])) {
    $postId = $_GET['delete'];

    // Verifica se o ID do post existe
    foreach ($posts as $index => $post) {
        if ($post['id'] == $postId) {
            // Remove o post do array
            unset($posts[$index]);

            // Reindexa o array para corrigir os índices
            $posts = array_values($posts);

            // Salvar os posts atualizados de volta no arquivo
            file_put_contents($postsFile, json_encode($posts));

            // Redirecionar de volta para a página de administração
            header('Location: dashboard.php');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Administração - Processando Dados</title>
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
    <section id="admin">
        <h2>Área de Administração</h2>

        <!-- Formulário para criar um novo post -->
        <h3>Criar Novo Post</h3>
        <form action="dashboard.php" method="POST" enctype="multipart/form-data">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="author">Autor:</label>
            <input type="text" id="author" name="author" required><br>

            <label for="summary">Resumo:</label><br>
            <textarea id="summary" name="summary" required></textarea><br>

            <label for="content">Conteúdo:</label><br>
            <textarea id="content" name="content" required></textarea><br>

            <label for="image">Imagem:</label>
            <input type="file" id="image" name="image" accept="image/*"><br>

            <button type="submit">Criar Post</button>
        </form>

        <!-- Exibição dos posts existentes -->
        <h3>Posts Recentes</h3>
        <div id="posts">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($post['author']); ?></p>
                    <p><strong>Resumo:</strong> <?php echo nl2br(htmlspecialchars($post['summary'])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>

                    <!-- Formatação da data -->
                    <?php $formattedDate = date('d/m/Y', strtotime($post['date'])); ?>
                    <small>Postado em: <?php echo $formattedDate; ?></small>
                    
                    <!-- Exibe a imagem se houver -->
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Imagem do Post" style="max-width: 100%; height: auto;">
                    <?php endif; ?>

                    <!-- Link para excluir o post usando o identificador único -->
                    <a href="?delete=<?php echo htmlspecialchars($post['id']); ?>" onclick="return confirm('Tem certeza que deseja excluir este post?');">Excluir</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
