<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-user mr-2"></i>
        {{ __('Usuários') }}
    </x-slot>

    <x-slot name="headerButton">
        <x-success-button type="button" onclick="window.location='{{route('usuario.adicionar')}}'">
            <i class="fa-solid fa-plus mr-2"></i>
            {{__('Adicionar')}}
        </x-success-button>
    </x-slot>

    <div class="p-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" style="width: 5%"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col" style="width: 10%;">Situação</th>
                    <th scope="col" style="width: 15%; text-align: end">Alterador</th>
                    <th scope="col" style="width: 15%">Alteração</th>
                </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <th scope="row" style="color: #005fd9; text-align: center; border-right: 1px solid #dedede; border-bottom: 0;">
                            <button title="Editar" onclick="window.location='{{route("usuario.editar", ['id' => $usuario->id])}}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </th>

                        <td style="border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$usuario->nome}}
                        </td>

                        <td style="width: 20%; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$usuario->email}}
                        </td>

                        <td style="width: 10%; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$usuario->situacao ? 'Habilitado' : 'Desabilitado'}}
                        </td>

                        <td style="width: 20%; text-align: end; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$usuario->alteradorDescription}}
                        </td>

                        <td style="border-bottom: 0;">
                            {{$usuario->updated_atDescription}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
