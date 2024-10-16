<?php
// verifica se um cliente foi selecionado para edição 
    if(isset($_GET["id"])){
        $produto_id = $_GET["id"];

// conexao com o banco de dados
    include "../php/conexao.php";

    // obter os dados do cliente para edição 

    $sql = "SELECT * FROM produtos WHERE id = $produto_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }

    // procesar o formulario para a edição quando enviado
    if($_SERVER["REQUEST_METHOD"] == "POST") { 

        $novo_nome = $_POST ["nome"];
        $novo_descricao = $_POST ["descricao"];
        $novo_preco = $_POST ["preco"];
        $novo_estoque = $_POST ["estoque"];
        $novo_categoria = $_POST ["categoria"];
        $novo_tamanho = $_POST ["tamanho"];
        $novo_cor = $_POST ["cor"];
        $novo_marca = $_POST ["marca"];
        $novo_imagem = $_POST ["imagem"];
    
        // Atualizar os dados do cliente no banco de dados
        $sql =  "UPDATE produtos SET nome = '$novo_nome', descricao = '$novo_descricao', preco = '$novo_preco', estoque = '$novo_estoque', categoria = '$novo_categoria', tamanho = '$novo_tamanho', cor = '$novo_cor', marcar = '$novo_marca' WHERE id = $produto_id";


    }
    if ($conn->query($sql) === TRUE){
        echo "Dados atualizados com sucesso!";
    }else{
        echo "Erro ao atualizar os dados:" . $conn->error;
    }

    $conn->close();

    }else{
        echo "Produtos não especificado para a edição";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="titulo-editar">
        <h1>Editar Cliente</h1>
    </div>
    <form action="" method="POST">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" value="><?php echo $row
        ["nome"]; ?>"required><br>

         <label for="descricao">Descrição</label>
        <input type="text" id="descricao" name="descricao" value="><?php echo $row
        ["descricao"]; ?>"required><br>

         <label for="preco">Preço</label>
        <input type="text" id="preco" name="preco" value="><?php echo $row
        ["preco"]; ?>"required><br>

         <label for="estoque">Estoque</label>
        <input type="text" id="estoque" name="estoque" value="><?php echo $row
        ["estoque"]; ?>"required><br>

        <label for="categoria">Categoria</label>
        <input type="text" id="categoria" name="categoria" value="><?php echo $row
        ["categoria"]; ?>"required><br>

        <label for="tamanho">Tamanho</label>
        <input type="text" id="tamanho" name="tamanho" value="><?php echo $row
        ["tamanho"]; ?>"required><br>

        <label for="cor">Cor</label>
        <input type="text" id="cor" name="cor" value="><?php echo $row
        ["cor"]; ?>"required><br>

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="><?php echo $row
        ["marca"]; ?>"required><br>

        <label for="imagem">Imagem</label>
        <input type="text" id="imagem" name="imagem" value="><?php echo $row
        ["imagem"]; ?>"required><br>



        <input type="submit" value="Salvar Alterações">

    </form>
    <br><a href="listagemProduto.php">Voltar</a>
    
</body>
</html>