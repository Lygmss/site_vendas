<?php

    function listaCategoria($conn){
    // FUNCAO QUE listar categorias
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

    function deletarCategoria($conn,$id){
        try{
            $sql= "DELETE FROM categoria WHERE id = :id;";
            
            $stmt= $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();  
            echo "Categoria deletada com sucesso";
        }catch(PDOException $err){
            echo "Não foi possivel deletar a categoria $err";
        }

    }

    function cadastrarProduto($conn,$cadastrar){
        try {
    
            // Criar variáveis para Receber os Dados
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $estoque = $_POST['estoque'];
            $categoria = $_POST['categoria'];
            $tamanho = $_POST['tamanho'];
            $cor = $_POST['cor'];
            $marca = $_POST['marca'];
    
            $caminho = '../img/originais/';
            // captura a extensao da imagem enviado para upload(ex: .png)
                $extensao = pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
                // gera um hash aleatorio para imagem
                $hash = md5(uniqid($_FILES['imagem']['tmp_name'],true));
                // junta o hash(nome aleatorio) = extensao
                // ex: andvn78ikvid8987biism.jpg
                // HASH: andvn78ikvid8987biism
                // extensao: jpg
                $nome_imagem= $hash.'.' .$extensao;
            
            
                // executa o upload da imagem
                move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho.$nome_imagem);
                $caminho2 = '../img/miniaturas/';
                copy($caminho.$nome_imagem,$caminho2.$nome_imagem);
    
            
                // var_dump($extensao);
                // exit;
            
            // Importa o arquivo de conexão
            include "../php/conexao.php"; // Certifique-se de que o arquivo conexao.php está no mesmo diretório
    
            // SQL para inserir dados utilizando prepared statement
            $sql = "INSERT INTO produtos (nome, descricao, preco, estoque, categoria, tamanho, cor, marca, imagem) VALUES (:nome, :descricao, :preco, :estoque, :categoria, :tamanho, :cor, :marca, :imagem)";
            $stmt = $conn->prepare($sql); // Prepara a consulta SQL
    
            // Anti SQL Injection: Bind dos parâmetros
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->bindParam(':estoque', $estoque, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->bindParam(':tamanho', $tamanho, PDO::PARAM_STR);
            $stmt->bindParam(':cor', $cor, PDO::PARAM_STR);
            $stmt->bindParam(':marca', $marca, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $nome_imagem, PDO::PARAM_STR);
    
            // Executa a consulta preparada
            $stmt->execute();
    
        } catch (PDOException $err) {
            echo "Não foi possível adicionar o cadastro! " . $err->getMessage();
        }
    }

    
//acho que consegui fazer o fuction do editar

    function editarProdutos($conn, $produto_id){
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