<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jogadores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-4">
                        <a href="{{ route('players.create') }}" class="btn btn-primary">Cadastrar Novo Jogador</a>
                    </div>

                    <!-- Tabela de Jogadores -->
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Altura (cm)</th>
                            <th scope="col">Peso (kg)</th>
                            <th scope="col">Data de Nascimento</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Suspenso?</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($players as $player)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $player->name }}</td>
                                <td>{{ $player->category }}</td>
                                <td>{{ $player->height }}</td>
                                <td>{{ $player->weight }}</td>
                                <td>{{ \Carbon\Carbon::parse($player->birthdate)->format('d/m/Y') }}</td>
                                <td>{{ $player->email }}</td>
                                <td>{{ $player->isSuspended ? 'Sim' : 'Não' }}</td>
                                <td>
                                    <a href="{{ route('players.edit', $player->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('players.destroy', $player->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este jogador?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Exibir uma mensagem de sucesso, se houver -->
                    @if(session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
