<?php
    include "../php/conexao.php";
if (isset($_GET["btn-editarProdutos"])) {
    $produto_id = $_GET['btn-editarProdutos']; // Obter o ID do produto de forma mais clara
    editarProdutos($conn, $produto_id); // Passar o ID do produto para a função
}

function editarProdutos($conn, $produto_id) {
    // Selecionar o produto pelo ID fornecido
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $produto_id, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Processar o formulário para a edição quando enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $novo_nome = $_POST["nome"];
            $novo_descricao = $_POST["descricao"];
            $novo_preco = $_POST["preco"];
            $novo_estoque = $_POST["estoque"];
            $novo_categoria = $_POST["categoria"];
            $novo_tamanho = $_POST["tamanho"];
            $novo_cor = $_POST["cor"];
            $novo_marca = $_POST["marca"];
            $novo_imagem = $_POST["imagem"];

            // Atualizar os dados do produto no banco de dados com prepared statements
            $sql_update = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, estoque = :estoque, categoria = :categoria, tamanho = :tamanho, cor = :cor, marca = :marca WHERE id = :id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':nome', $novo_nome);
            $stmt_update->bindParam(':descricao', $novo_descricao);
            $stmt_update->bindParam(':preco', $novo_preco);
            $stmt_update->bindParam(':estoque', $novo_estoque);
            $stmt_update->bindParam(':categoria', $novo_categoria);
            $stmt_update->bindParam(':tamanho', $novo_tamanho);
            $stmt_update->bindParam(':cor', $novo_cor);
            $stmt_update->bindParam(':marca', $novo_marca);
            $stmt_update->bindParam(':id', $produto_id, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                echo "Produto atualizado com sucesso!";
            } else {
                echo "Erro ao atualizar o produto.";
            }
        }
    } else {
        echo "Produto não encontrado para edição.";
    }
}
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="stylecad.css">
</head>
<body>
    <div id="titulo-editar">
        <h1>Editar Cliente</h1>
    </div>
    <form action="" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="<?php echo $row
        ["nome"]; ?>"required><br>

         <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" value="<?php echo $row
        ["descricao"]; ?>"required><br>

         <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" value="<?php echo $row
        ["preco"]; ?>"required><br>

         <label for="estoque">Estoque</label>
        <input type="text" id="estoque" name="estoque" value="<?php echo $row
        ["estoque"]; ?>"required><br>

        <label for="categoria">Categoria</label>
        <input type="text" id="categoria" name="categoria" value="<?php echo $row
        ["categoria"]; ?>"required><br>

        <label for="tamanho">Tamanho</label>
        <input type="text" id="tamanho" name="tamanho" value="<?php echo $row
        ["tamanho"]; ?>"required><br>

        <label for="cor">Cor</label>
        <input type="text" id="cor" name="cor" value="<?php echo $row
        ["cor"]; ?>"required><br>

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="<?php echo $row
        ["marca"]; ?>"required><br>

        <label for="imagem">Imagem</label>
        <input type="text" id="imagem" name="imagem" value="<?php echo $row
        ["imagem"]; ?>"required><br>


        <form action="editarProdutos.php">
            <input type="submit" value="Salvar Alterações">
            <button type="submit" class="btn-editarProdutos" name="btn-editarProdutos">Salvar Alterações</button>
        </form>

    </form>
    <br><a href="listagemProduto.php">Voltar</a>
    
</body>
</html>