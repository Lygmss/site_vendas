<?php

try {
    include "php/conexao.php";

    $sql = "SELECT * FROM produtos";

    $stmt = $conn->prepare($sql);
  

    $stmt->execute();

    $dados = $stmt->fetchAll((PDO::FETCH_ASSOC));

} catch (PDOException $err) {

    echo "Não foi possível localizar os registros!".$err->getMessage();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Loja</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="index.php">Produtos</a></li>
                <li><a href="carrinho.php">Carrinho</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
        <aside class="filter">
            <div class="search-container">
            <input class="search-bar" type="search" placeholder="Pesquisar...">
            <button type="submit">Buscar</button>
            </div>
            <h2>Filtros</h2>
            <label for="category">Categoria:</label>
            <select id="categoria" name="categoria">
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

            <h2>Filtros</h2>
            <label for="tamanho">Tamanho:</label>
            <select id="tamanho" name="name">
                <option value="all">Todos</option>
                <option value="p">P</option>
                <option value="m">M</option>
                <option value="g">G</option>
            </select>

            <label for="price">Faixa de Preço:</label>
            <select id="price">
                <option value="all">Todos</option>
                <option value="low">Até R$50</option>
                <option value="medium">R$50 - R$200</option>
                <option value="high">Acima de R$200</option>
            </select>
        </aside>

        <section class="products">
            <?php
            foreach($dados as $produtos){
            ?>
            <div class="product" data-category="categoria1" data-price="low">
                <img src="img/miniaturas/<?php echo $produtos['imagem']?>" alt="<?php echo $produtos['nome']?>">
                <h3><?php echo $produtos['nome']?></h3>
                <p><?php echo $produtos['preco']?></p>
                <a href="produtos.php?id=<?php echo $produtos['id']?>"><button class= 'btn-1'>Visualizar</button></a>
            </div>
            <?php
            }
            ?>    
           
          
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Loja.</p>
    </footer>

    <!-- <script src="script.js"></script> -->
</body>
</html>
