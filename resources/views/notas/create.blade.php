<!-- resources/views/notas/create_nota.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Criar Nota de Compra</title>
    <!-- Inclua CSS/Bootstrap aqui se necessário -->
</head>
<body>
    <div class="container">
        <h2>Criar Nova Nota de Compra</h2>

        <!-- Mostra erros de validação -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulário para criar uma nova nota de compra -->
        <form action="{{ route('notas.store') }}" method="POST">
            @csrf <!-- Token de segurança obrigatório em formulários -->

            <div class="form-group">
                <label for="clienteId">Cliente</label>
                <input type="text" name="clienteId" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="produtoId">Produto</label>
                <input type="text" name="produtoId" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" name="quantidade" class="form-control" min="1" required>
            </div>

            <div class="form-group">
                <label for="data">Data da Compra</label>
                <input type="date" name="data" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" name="total" class="form-control" min="0" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Criar Nota</button>
        </form>
    </div>
</body>
</html>
