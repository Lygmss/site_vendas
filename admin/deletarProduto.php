<?php
    // verifica se um cliente foi selecionado para edição 
    if(isset($_GET["id"])){
        $produtos = $_GET["id"];

        include "../php/conexao.php";

        $sql = "DELETE FROM produtos WHERE id = $produtos";

        // Header = redireciona para a pagina produto.php
        if ($conn->query($sql) === TRUE) {
            header("Location: produto.php?excluido=true");
            exit;
        }else {
            echo "Erro ao Excluir o produto" . $conn->connect_error;
        }

        $conn->close();

        }else {
            echo "Produto não espeficado para exclusão";
        }

?>