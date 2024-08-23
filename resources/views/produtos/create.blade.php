<!-- resources/views/produtos/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Novo Produto</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <label for="nome">Nome do Produto:</label>
        <input type="text" id="nome" name="nome" value="{{ old('nome') }}" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao">{{ old('descricao') }}</textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="text" id="preco" name="preco" value="{{ old('preco') }}" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
