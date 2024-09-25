<?php
// INICIA A SESSÃO SE AINDA NAO FOI INICIADA
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// FUNÇÃO QUE LIMPA O CARRINHO
if($_POST['limparcarrinho']){
unset($_SESSION)

}

// VERIFICA SE O CARRINHO FOI CRIADO, CASO CONTRARIO, INICIALIZA
if (!isset($_SESSION['carrinho'])){
    $_SESSION['carrinho'] = array();
}

$produto = $_POST ['id_produto'];
 
$_SESSION['carrinho'][]= $produto;
 
$ids = implode(",", $_SESSION['carrinho']);
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
        <?php
        if(isset($dados) !=null){
        ?>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): {
                    ?>
                <tr>
                    <td class="produto-info">
                        <img src="img/miniaturas/<?php echo $produto['imagem']; ?>" alt="">
                        <span><?php echo $produto['nome']; ?></span>
                    </td>
                    <td>
                        <input type="number" value="1">
                    </td>
                    <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                </tr>
                <?php 
                endforeach; }}
                ?>
            </tbody>
        </table>
 
        <div class="total">
            <p>Total do Carrinho: <strong>R$ 300,00</strong></p>
        </div>
        <div>
        <button class="checkout-btn">Finalizar Compra</button> 
        <form action="carrinho.php" method="post">
            <button type="submit" class="checkout-btn" name="limparcarrinho">Limpar carrinho</button>
        </form>
        <a href="index.php">
          <button type="button" class="checkout-btn">Voltar</button>
        </a>
    </div>
    
    </div>


</body>
</html>