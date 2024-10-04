<?php
// INICIA A SESSÃO SE AINDA NAO FOI INICIADA
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// FUNÇÃO QUE LIMPA O CARRINHO
if(isset($_POST['limparcarrinho'])){
unset($_SESSION['carrinho']);

}

// Remove todos os produtos com o ID solicitado do carrinho
if (isset($_POST['removerProduto'])) {
    $idRemover = $_POST['removerProduto'];
    
    // Filtra o carrinho, mantendo apenas os produtos que não têm o ID a ser removido
    $_SESSION['carrinho'] = array_filter($_SESSION['carrinho'], function($id) use ($idRemover) {
        return $id !== $idRemover;
    });
}


// VERIFICA SE O CARRINHO FOI CRIADO, CASO CONTRARIO, INICIALIZA
if (!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}

// Captura via POST o id do produto que será adicionado ao carrinho, se existir
if (isset($_POST['id_produto'])) {
    $produto = $_POST['id_produto'];
    $_SESSION['carrinho'][] = $produto;
}
 
$ids = implode(",", $_SESSION['carrinho']);

$quantidade = 1;

if (!empty($ids)){
    try{
    include 'php/conexao.php';
    $sql = "SELECT * FROM produtos WHERE id IN ($ids)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(PDOException $err)
    {
        echo "Erro".$err->getMessage();
    }
    }
    ?>
 

<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="carrinho.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
 
    <div class="container">
        <h1>Seu carrinho</h1>
        <div class="carrinho">
        <table>
            <thead>
                <tr class= "desc">
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(!empty($ids)){ 
                foreach ($produtos as $produto){
                ?>
                <tr>
                    
                    <td><?php echo $produto['id']?></td>
                    <td><img class="img-carrinho" src="img/miniaturas/<?php echo $produto['imagem']?>" alt="" srcset=""></td>
                    <td><?php echo $produto['nome']?></td>
                    <td><?php echo $quantidade?></td>
                    <td><?php echo $produto['preco']?></td>
                    <td><?php echo $produto['preco'] * $quantidade?></td>
                    <td>
                        <form action="carrinho.php" method="post">
                            <button type="submit" name="removerProduto" value="<?php echo $produto['id']?>" class="remover-produto">
                                <i class="fa-solid fa-trash-can fa-2x"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php 
                }} else{
                               
                ?>
                <td colspan="7">Carrinho Vazio!</td>
                <?php
                }
                ?>
                <?php
                include 'funcao.php';
                ?>


            </tbody>
        </table>
  

    <div>
        <button class="checkout-btn">Finalizar Compra</button> 
        <form action="carrinho.php" method="post">
            <button type="submit" class="checkout-btn" name="limparCarrinho">Limpar carrinho</button>
        </form>
        <a href="index.php">
          <button type="button" class="checkout-btn">Voltar</button>
        </a>  </div>
    </div>
    </div>


</body>
</html>