<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-user-graduate mr-2"></i>
        {{ __('Orientadores') }}
    </x-slot>

    <x-slot name="headerButton">
        <x-success-button type="button" onclick="window.location='{{route('orientador.adicionar')}}'">
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
                    <th scope="col">Telefone</th>
                    <th scope="col">Especialização</th>
                    <th scope="col">Situação</th>
                    <th scope="col" style="width: 15%; text-align: end">Alterador</th>
                    <th scope="col" style="width: 15%">Alteração</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orientadores as $orientador)
                    <tr>
                        <th scope="row" style="color: #005fd9; text-align: center; border-right: 1px solid #dedede; border-bottom: 0;">
                            <button title="Editar" onclick="window.location='{{route("orientador.editar", ['id' => $orientador->id])}}'">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </th>

                        <td style="border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$orientador->nome}}
                        </td>

                        <td class="telefone" style="width: 12%; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$orientador->telefone}}
                        </td>

                        <td style="width: 15%; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$orientador->especializacao}}
                        </td>

                        <td style="width: 10%; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$orientador->situacao ? 'Habilitado' : 'Desabilitado'}}
                        </td>

                        <td style="width: 18%; text-align: end; border-right: 1px solid #dedede; border-bottom: 0;">
                            {{$orientador->alteradorDescription}}
                        </td>

                        <td style="border-bottom: 0;">
                            {{$orientador->updated_atDescription}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.telefone').inputmask('(99) 99999-9999');
        });
    </script>
</x-app-layout>
