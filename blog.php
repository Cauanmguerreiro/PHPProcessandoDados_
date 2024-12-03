<?php
// Arquivo onde os posts estão armazenados
$postsFile = 'posts.json';

// Carregar os posts do arquivo
if (file_exists($postsFile)) {
    $posts = json_decode(file_get_contents($postsFile), true);

    // Ordenar os posts pela data de forma decrescente (mais recente primeiro)
    usort($posts, function($a, $b) {
        // Converter as datas para o formato 'Y-m-d' para garantir a comparação correta
        return strtotime($b['date']) - strtotime($a['date']);
    });
} else {
    $posts = []; // Caso não haja posts, inicializa um array vazio
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Processando Dados</title>
    <style>
        /* Estilos gerais */
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

        footer {
            text-align: center;
            background-color: #6C2815;
            color: white;
            padding: 10px 0;
        }

        /* Seção de Últimos Posts */
        #posts h2 {
            text-align: center; /* Centraliza o título */
            margin-bottom: 20px; /* Adiciona um espaço abaixo do título */
        }

        #sobre {
            font-size: 20px;
            text-align: center; /* Centraliza o título */
            margin-bottom: 20px
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
        <section id="posts">
            <h2>Últimos Posts</h2>

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <article>
                        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Imagem do Post">
                        <?php endif; ?>
                        <!-- Exibe o resumo (campo 'summary') -->
                        <p><?php echo nl2br(htmlspecialchars($post['summary'])); ?></p>
                        
                        <!-- Link para a página do post, passando o ID do post -->
                        <a href="materia.php?id=<?php echo urlencode($post['id']); ?>">Leia Mais</a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Ainda não há posts no blog.</p>
            <?php endif; ?>

        </section>

        <section id="sobre">
            <h2>Sobre o Blog</h2>
            <p>O <span style="color: #DA421E;">Processando Dados</span> é um canal dedicado a compartilhar conhecimento sobre tecnologia...</p>
        </section>

        <section id="contato">
            <h2>Contato</h2>
            <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSeQRp47N0KYJsT8U5HC6s-3HsoMVv0ohrBiJOczMFSXDL46pg/viewform?embedded=true" 
                    width="640" 
                    height="512" 
                    frameborder="0" 
                    marginheight="0" 
                    marginwidth="0">
                Carregando…
            </iframe>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
