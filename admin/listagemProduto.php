<?php

try {
    include "../php/conexao.php";

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
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="stylelist.css">
</head>
<body>
    <header>
        <h1>Listagem de Produtos Cadastrados</h1>
        <h3>Minha Loja</h3>
    </header>

    <main>
        <section class="product-list">
            <div class="product-grid">
            <?php
            foreach($dados as $produtos){
            ?>
                <div class="product-card">
                <img class="img-list" src="../img/miniaturas/<?php echo $produtos['imagem']?>" alt="<?php echo $produtos['nome']?>">
                    <div class="product-info">
                        <h3 class="product-name">
                            <?php
                            echo $produtos['nome'];
                            ?>
                        </h3>

                        <p class="product-price">
                            <?php
                            echo $produtos['preco'];
                            ?>
                        </p>

                        <p class="product-category">
                            <?php
                            echo $produtos['categoria'];
                            ?>
                        </p>

                        <p class="product-brand"> 
                            <?php
                            echo $produtos['marca'];
                            ?>
                        </p>
                        <h5>Cor</h5>
                            <p class="product-color"> 
                                <?php
                                echo $produtos['cor'];
                                ?>
                        </p>
                        <h5>Tamanho</h5>
                        <p class="product-size"> 
                            <?php
                            echo $produtos['tamanho'];
                            ?>
                        </p>
                        <p class="product-description">
                            <?php
                            echo $produtos['descricao'];
                            ?>
                        </p>
                        
                        <a href="editarProduto.php"><button>Editar</button></a>
                        <a href="deletarProduto.php"><button>Deletar</button></a>
                    </div>
                   
                </div>
                <?php
                }
                ?> 
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Minha Loja. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
