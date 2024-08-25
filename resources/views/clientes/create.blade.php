<!DOCTYPE html>
<html>
<head>
    <title>Criar Cliente</title>
</head>
<body>

    <h1>Criar Cliente</h1>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf  <!-- Token de segurança necessário em formulários POST no Laravel -->
        
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="sobrenome">Sobrenome:</label><br>
        <input type="text" id="sobrenome" name="sobrenome" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="telefone">Telefone:</label><br>
        <input type="text" id="telefone" name="telefone"><br><br>

        <input type="submit" value="Criar Cliente">
    </form>

</body>
</html>
