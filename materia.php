<?php
// Arquivo onde os posts serão armazenados
$postsFile = 'posts.json';

// Carregar os posts do arquivo
$posts = json_decode(file_get_contents($postsFile), true);

// Verificar se o ID foi passado na URL
if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    
    // Procurar o post com o ID correspondente
    $post = null;
    foreach ($posts as $p) {
        if ($p['id'] == $postId) {
            $post = $p;
            break;
        }
    }
    
    // Se o post não for encontrado
    if (!$post) {
        echo "Post não encontrado.";
        exit;
    }

    // Verificando se as chaves existem no array
    $title = isset($post['title']) ? $post['title'] : 'Título não disponível';
    $image = isset($post['image']) ? $post['image'] : 'image_default.jpg';
    $content = isset($post['content']) ? $post['content'] : 'Conteúdo não disponível';
    $author = isset($post['author']) ? $post['author'] : null; // Alterado para 'author' e não um array
} else {
    echo "ID não fornecido.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        /* Seu estilo aqui */
        /* Geral */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            color: #ffffff;
            background-color: #6C2815;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px;
            font-weight: bold;
        }

        header .logo img {
            max-height: 80px;
            width: auto;
        }

        header nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
        }

        /* Página da matéria */
        main article {
            max-width: 800px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            text-align: justify;
        }

        main article h1 {
            font-size: 32px;
            color: #DA421E;
            margin-bottom: 20px;
            text-align: center;
        }

        main article p {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }

        main article img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 20px 0;
        }

        main article a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #E39E2B;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        main article a:hover {
            background-color: #C1771D;
        }

        /* Seção de author */
        .author {
            max-width: 800px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .author h2 {
            font-size: 28px;
            color: #6C2815;
            margin-bottom: 15px;
        }

        .author p {
            font-size: 18px;
            color: #333;
            margin-bottom: 15px;
        }

        .author .autor {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 15px;
            margin-bottom: 15px;
        }

        .author img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 2px solid #6C2815;
        }

        .author span {
            font-size: 16px;
            color: #333;
        }

        .author .descricao {
            font-size: 14px;
            color: #666;
            max-width: 600px;
            margin-left: 15px;
            text-align: justify;
        }

        footer {
            text-align: center;
            background-color: #6C2815;
            color: white;
            padding: 10px 0;
        }
    </style>
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
        <article>
            <h1><?php echo $title; ?></h1>
            <img src="imgs/<?php echo $image; ?>" alt="Imagem da matéria">

            <?php
                // Exibindo o conteúdo da matéria
                echo $content;
            ?>

            <a href="blog.php">Voltar para a página inicial</a>
        </article>

        <!-- Exibindo o autor -->
        <?php if ($author): ?>
            <section class="author">
                <h2><?php echo $author; ?></h2> <!-- Exibindo o autor como string -->
                <div class="autor">
                    <img src="imgs/<?php echo $author['foto']; ?>" alt="Foto do Autor"> <!-- Aqui você deve verificar se $author é um array -->
                    <div>
                <span><?php echo $author['nome']; ?></span>
                <div class="descricao"><?php echo $author['descricao']; ?></div>
            </div>
        </div>
    </section>
<?php else: ?>
    <p>Autor não encontrado.</p>
<?php endif; ?>

        
    </main>

    <footer>
        <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
