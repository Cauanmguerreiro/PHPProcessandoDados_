<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores - Processando Dados</title>
    <style>
        /* Estilos Gerais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #6C2815;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        header .logo img {
            max-height: 80px;
            width: auto;
        }

        header nav a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        main {
            flex: 1; /* Faz o conteúdo principal crescer para ocupar o espaço disponível */
            padding: 20px;
        }

        h1, h2 {
            color: #DA421E;
            text-align: center;
        }

        /* Seção Autores */
        #autores {
            background-color: #fff;
            padding: 30px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 20px auto;
        }

        .autores-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .autor {
            text-align: center;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            width: 250px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .autor img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .autor h3 {
            color: #6C2815;
            margin: 10px 0;
        }

        .autor p {
            font-size: 0.9em;
            color: #555;
            line-height: 1.5;
        }

        footer {
            background-color: #6C2815;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="imgs/logo.png" alt="Logo do Processando Dados">
        </div>
        <nav>
            <a href="blog.php">Home</a>
            <a href="#sobre">Sobre</a>
        </nav>
    </header>

    <main>
        <section id="autores">
            <h2>Conheça nossos Autores</h2>
            <div class="autores-container">
                <?php
                // Array com dados dos autores
                $autores = [
                    [
                        'nome' => 'Cauan Meira Guerreiro',
                        'descricao' => 'Especialista em desenvolvimento web e entusiasta em tecnologia.',
                        'imagem' => 'imgs/cauan.png'
                    ],
                    [
                        'nome' => 'Nicolas Dimer',
                        'descricao' => 'Programador full stack e colaborador em projetos do canal.',
                        'imagem' => 'imgs/nicolas.jpg'
                    ]
                ];

                // Gerar os blocos de autores
                foreach ($autores as $autor) {
                    echo "<div class='autor'>";
                    echo "<img src='{$autor['imagem']}' alt='Foto de {$autor['nome']}'>";
                    echo "<h3>{$autor['nome']}</h3>";
                    echo "<p>{$autor['descricao']}</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Processando Dados. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
