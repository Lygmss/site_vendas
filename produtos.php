<?php
try {
    include "php/conexao.php";

    $id = $_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id= :id;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);

    $stmt->execute();

    $dados = $stmt->fetch((PDO::FETCH_ASSOC));

} catch (PDOException $err) {

    echo "Não foi possível localizar os registros!".$err->getMessage();
}

?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style2.css">
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
        <section class="product-details">
          
            <div class="product-images">
            <img src="img/miniaturas/<?php echo $dados['imagem']?>" alt="<?php echo $dados['nome']?>">
            </div>
            <div class="product-info">
                <h2><?php
                echo $dados['nome'];
                ?>
                </h2>
                <p class="price"> <?php
                echo $dados['preco'];
                ?></p>
                <p class="description"> 
                    <?php
                    echo $dados['descricao'];
                    ?>
                </p>
                <form action="carrinho.php" method="post">
                    <button class= 'btn-1' name= "id_produto" value="<?php echo $dados['id']?>">Adicionar ao Carrinho</button>
                    <a href="index.php"><button class ='btn-1' type="button">Voltar</button></a>
                </form>
                
            </div>
           
            
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Minha Loja.</p>
    </footer>

    <!-- <script src="script.js"></script> -->
</body>
</html>
