<?php

if (isset($_POST['cadastrar'])){



    try {

        // Criar variáveis para Receber os Dados
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $estoque = $_POST['estoque'];
        $categoria = $_POST['categoria'];
        $tamanho = $_POST['tamanho'];
        $cor = $_POST['cor'];
        $marca = $_POST['marca'];

        $caminho = '../img/originais/';
        // captura a extensao da imagem enviado para upload(ex: .png)
            $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
            // gera um hash aleatorio para imagem
            $hash = md5(uniqid($_FILES['imagem']['tmp_name'],true));
            // junta o hash(nome aleatorio) = extensao
            // ex: andvn78ikvid8987biism.jpg
            // HASH: andvn78ikvid8987biism
            // extensao: jpg
            $nome_imagem= $hash.'.' .$extensao;
        
        
            // executa o upload da imagem
            move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho.$nome_imagem);
            $caminho2 = '../img/miniaturas/';
            copy($caminho.$nome_imagem,$caminho2.$nome_imagem);

        
            // var_dump($extensao);
            // exit;
        
        // Importa o arquivo de conexão
        include "../php/conexao.php"; // Certifique-se de que o arquivo conexao.php está no mesmo diretório

        // SQL para inserir dados utilizando prepared statement
        $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria, tamanho, cor, marca, imagem) VALUES (:nome, :descricao, :preco, :estoque, :categoria, :tamanho, :cor, :marca, :imagem)";
        $stmt = $conn->prepare($sql); // Prepara a consulta SQL

        // Anti SQL Injection: Bind dos parâmetros
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
        $stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_STR);
        $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
        $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $nome_imagem, PDO::PARAM_STR);

        // Executa a consulta preparada
        $stmt->execute();

    } catch (PDOException $err) {
        echo "Não foi possível adicionar o cadastro! " . $err->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylecad.css">
    
</head>
<body>
    <header>
        <h1>Minha Loja</h1>
    </header>

    <main>
        <section class="product-form">
            <h2>Cadastro de Produto</h2>
            <form action="cadastroProduto.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Nome do Produto:</label>
                    <input type="text" id="productName" name="nome" required>
                </div>
                
                <div class="form-group">
                    <label for="preco">Preço (R$):</label>
                    <input type="number" id="preco" name="preco" required min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label for="estoque">Estoque:</label>
                    <input type="number" id="estoque" name="estoque" required min="0" step="0.01">
                </div>
                
                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select id="category" name="categoria" required>
                        <option value="all">Todos</option>
                        <option value="camisas">Camisas</option>
                        <option value="calcas">Calças</option>
                        <option value="jaquetas">Jaquetas</option>
                        <option value="vestidos">Vestidos</option>
                        <option value="blusas">Blusas</option>
                        <option value="shorts">Shorts</option>
                        <option value="moletons">Moletons</option>
                        <option value="casacos">Casacos</option>
                        <option value="regatas">Regatas</option>
                        <option value="blazers">Blazers</option>
                        <option value="bermudas">Bermudas</option>
                        <option value="macacoes">Macacões</option>
                        <option value="sueteres">Suéteres</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="marca">Marca:</label>
                    <select id="marca" name="marca" required>
                        <option value="hering">Hering</option>
                        <option value="lacoste">Lacoste</option>
                        <option value="nike">nike</option>
                        <option value="gap">gap</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cor">Cor:</label>
                    <select id="cor" name="cor" required>
                        <option value="azul">Azul</option>
                        <option value="preto">Preto</option>
                        <option value="cinza">Cinza</option>
                        <option value="roxo">Roxo</option>
                        <option value="branco">Branco</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="tamanho">Tamanho:</label>
                    <select id="tamanho" name="tamanho" required>
                    <option value="all">Todos</option>
                    <option value="p">P</option>
                    <option value="m">M</option>
                    <option value="g">G</option>
                    </select>
                </div>

               

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea id="description" name="descricao" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="imagem">Imagem do Produto:</label>
                    <input type="file" id="image" name="imagem" accept="image/*" required>
                </div>

                <button name="cadastrar" type="submit">Cadastrar Produto</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Minha Loja. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
