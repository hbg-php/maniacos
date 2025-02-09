<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Jogador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Cadastro de Jogador de Basquete</h1>

    <!-- Exibir mensagem de sucesso, se houver -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/players') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Posição</label>
            <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" required>
            @error('position')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Altura (cm)</label>
            <input type="number" class="form-control" id="height" name="height" value="{{ old('height') }}" required>
            @error('height')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Peso (kg)</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" required>
            @error('weight')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ old('birthdate') }}" required>
            @error('birthdate')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="team" class="form-label">Time</label>
            <input type="text" class="form-control" id="team" name="team" value="{{ old('team') }}" required>
            @error('team')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>

<!-- Scripts do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
