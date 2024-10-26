<?php
    include "../php/conexao.php";
    include "funcao.php";

    // funcoes que sao executadas o abrir a pagina
    $lista_categoria= listaCategoria($conn);
    

    // funcao cadastrar 
    if(isset ($_POST['fn_cadastrar'])){   
        cadastrarCategoria($conn,$_POST['categoria']);
    }
    

    if(isset($_POST['fn_deletar'])){   
        deletarCategoria($conn,$_POST['id']);
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
                        <form action="categoria.php" method="POST">
                            <input type="hidden" name="id" id="id" value="<?php echo $categoria['id']?>">
                            <button type="submit" class="btn-deletar" name="fn_deletar">Deletar</button>
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