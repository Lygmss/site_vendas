








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
        <h1>Minha Loja - Cadastro de Produtos</h1>
        <nav>
            <ul>
                <li><a href="index.html"></a></li>
                <li><a href="produtos.html"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </nav>
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
                        <option value="eletronicos">Eletrônicos</option>
                        <option value="roupas">Roupas</option>
                        <option value="livros">Livros</option>
                        <option value="acessorios">Acessórios</option>
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
