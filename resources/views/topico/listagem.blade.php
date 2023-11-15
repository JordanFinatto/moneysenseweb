<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-book mr-2"></i>
        {{ __('Tópicos') }}
    </x-slot>

    <x-slot name="headerButton">
        <x-success-button type="button" onclick="window.location='{{route('topico.adicionar')}}'">
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
                        <th scope="col">Titulo</th>
                        <th scope="col">Orientador</th>
                        <th scope="col">Situação</th>
                        <th scope="col" style="width: 15%; text-align: end">Alterador</th>
                        <th scope="col" style="width: 15%">Alteração</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topicos as $topico)
                        <tr>
                            <th scope="row" style="color: #005fd9; text-align: center; border-right: 1px solid #dedede; border-bottom: 0;">
                                <button title="Editar" onclick="window.location='{{route("topico.editar", ['id' => $topico->id])}}'">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </th>

                            <td style="border-right: 1px solid #dedede; border-bottom: 0;">
                                {{$topico->titulo}}
                            </td>

                            <td style="width: 20%; border-right: 1px solid #dedede; border-bottom: 0;">
                                {{$topico->orientadorDescription}}
                            </td>

                            <td style="width: 10%; border-right: 1px solid #dedede; border-bottom: 0;">
                                {{$topico->situacao ? 'Habilitado' : 'Desabilitado'}}
                            </td>

                            <td style="width: 20%; text-align: end; border-right: 1px solid #dedede; border-bottom: 0;">
                                {{$topico->alteradorDescription}}
                            </td>

                            <td style="border-bottom: 0;">
                                {{$topico->updated_atDescription}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
