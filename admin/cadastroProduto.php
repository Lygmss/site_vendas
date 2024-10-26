<?php
    include "../php/conexao.php";
    include "funcao.php";

    if (isset($_POST['cadastrar'])){
        cadastrarProduto($conn,$_POST['cadastrar']);
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
