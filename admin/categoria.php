<?php
    include "../php/conexao.php";

    // funcoes que sao executadas o abrir a pagina
    $lista_categoria= listaCategoria($conn);
    function listaCategoria($conn){
    // listar categorias
// SEMPRE QUE FOR SELECT É NECESSARIO ARMAZENAR OS DADOS EM UMA VARIAVEL PARA EXIBIR NA TELA(FOREACH)
    try{
        $sql= "SELECT * FROM categoria";
            
        $stmt = $conn->prepare($sql);
        $stmt->execute();  

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // echo"<pre>";     VERIFICAR SE TA DANDO CERTO
        // var_dump($lista_categoria);
    }catch(PDOException $err){
        return[]; 
        // retorna um array vazio em caso de erro
    }
  }

    // funcao cadastrar 
    if(isset ($_POST['fn_cadastrar'])){   
        cadastrarCategoria($conn,$_POST['categoria']);
    }
    function cadastrarCategoria($conn,$categoria){
        try{
            $sql= "INSERT INTO categoria(categoria) VALUES (:categoria);";
            
            $stmt= $conn->prepare($sql);
            // bindparam
            $stmt->bindParam(":categoria", $categoria);
            // executa
            $stmt->execute();  
            echo "Categoria inserida com sucesso";
        }catch(PDOException $err){
            echo "Não foi possivel inserir a categoria $err";
        }
    }

?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categoria</title>
    <link rel="stylesheet" href="funcao.css">
</head>
<body>
    <header>
            <h1>Loja de roupas - ADM </h1>
    </header> 
    <div class="container">
        

        <h2>Gerenciar Categorias</h2>   
        <form action="categoria.php" method="POST">
            
            <label for="categoria">Categoria:</label>
            <input type="text" id="search" name="categoria" >
            <button type="submit" name="fn_cadastrar">Cadastrar</button>
        </form>

        <h2>Listagem de Categorias</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Categoria</th>
                    <th>Data de Cadastro</th>
                    <th>Ações</th>        
                </tr>
            </thead>

            <tbody>
                <?php
                foreach($lista_categoria as $categoria){
                ?>
                <tr>
                    <td><?php echo $categoria['id']?></td>
                    <td><?php echo $categoria['categoria']?></td>
                    <td><?php echo $categoria['data_cad']?></td>
                    <td>
                        <form action="">
                            <button type="button">Deletar</button>
                        </form>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>