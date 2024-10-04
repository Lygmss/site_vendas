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
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylecad.css">
    
</head>
<body>
    <header>
        <h1>Minha Loja</h1>
    </header>

    <main>
        <section class="product-form">
            <h2>Cadastro de Produto</h2>
            <form action="submit-product.html" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productName">Nome do Produto:</label>
                    <input type="text" id="productName" name="productName" required>
                </div>
                
                <div class="form-group">
                    <label for="price">Preço (R$):</label>
                    <input type="number" id="price" name="price" required min="0" step="0.01">
                </div>

                <div class="form-group">
                    <label for="category">Categoria:</label>
                    <select id="category" name="category" required>
                        <option value="all">Todos</option>
                        <option value="camisas">Camisas</option>
                        <option value="calcas">Calças</option>
                        <option value="jaquetas">Jaquetas</option>
                        <option value="vestidos">Vestidos</option>
                        <option value="blusas">Blusas</option>
                        <option value="shorts">Shorts</option>
                        <option value="moletons">Moletons</option>
                        <option value="casacos">Casacos</option>
                        <option value="regatas">Regatas</option>
                        <option value="blazers">Blazers</option>
                        <option value="bermudas">Bermudas</option>
                        <option value="macacoes">Macacões</option>
                        <option value="sueteres">Suéteres</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Tamanho:</label>
                    <select id="category" name="category" required>
                    <option value="all">Todos</option>
                    <option value="p">P</option>
                    <option value="m">M</option>
                    <option value="g">G</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Imagem do Produto:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>

                <button type="submit">Cadastrar Produto</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Minha Loja. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
