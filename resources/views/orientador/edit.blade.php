<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-user-graduate mr-2"></i>
        @if(isset($orientador))
            {{ __('Editar orientador') }}
        @else
            {{ __('Adicionar orientador') }}
        @endif
    </x-slot>

    <x-slot name="headerButton">
        <x-clean-button type="button" onclick="window.location='{{route('orientador.listagem')}}'">
            <i class="fa-solid fa-left-long mr-2"></i>{{__('Voltar')}}
        </x-clean-button>
    </x-slot>

    <div style="display: none">
        {{$situacaoValue = old('situacao') ?? ($orientador->situacao ?? '')}}
        {{$idCidadeValue =  old('idCidade') ?? ($orientador->idCidade ?? 0)}}
    </div>

    <div class="p-6">
        <div class="p-6 text-gray-950 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(isset($orientador))
                <form id="form" method="post" action="{{route('orientador.update')}}" class="needs-validation" novalidate>
                    @method('patch')
            @else
                </form>

                <form id="form" method="post" action="{{ route('orientador.create') }}" class="needs-validation" novalidate>
            @endif
                @csrf

                    <input id="id" name="id" value="{{$orientador->id ?? 0}}" type="text" class="form-control hidden">
                    <input id="telefone" name="telefone" type="text" class="form-control hidden">

                    <div class="mb-3 d-flex">
                        <div class="w-50 px-1">
                            <label for="nome" class="form-label">Nome*</label>
                            <input id="nome" name="nome" value="{{old('nome') ?? ($orientador->nome ?? '')}}" type="text" class="form-control input" placeholder="Nome..." required>
                        </div>

                        <div class="w-25 px-1">
                            <label for="idCidade" class="form-label">Cidade*</label>
                            <select id="idCidade" name="idCidade" class="form-select input" required>
                                <option></option>

                                @foreach($cidades as $cidade)
                                    <option value={{$cidade->id}} @if($idCidadeValue == $cidade->id) selected @endif>{{$cidade->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-25 px-1">
                            <label for="situacao" class="form-label">Situação</label>
                            <select id="situacao" name="situacao" class="form-select input">
                                @if($situacaoValue)
                                    selected
                                    <option selected value="1">Habilitado</option>
                                    <option value="0">Desabilitado</option>
                                @else
                                    <option value="1">Habilitado</option>
                                    <option selected value="0">Desabilitado</option>
                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="mb-3 px-1 d-flex">
                        <div class="w-50 px-1">
                            <label for="especializacao" class="form-label">Especialização</label>
                            <input id="especializacao" name="especializacao" class="form-control input" placeholder="Especialização..." value="{{old('especializacao') ?? ($orientador->especializacao ?? '')}}">
                        </div>

                        <div class="w-25 px-1">
                            <label for="telefoneMask" class="form-label">Telefone*</label>
                            <input id="telefoneMask" name="telefoneMask" class="form-control input" placeholder="Telefone..." value="{{old('telefone') ?? ($orientador->telefone ?? '')}}" required>
                        </div>
                    </div>

                    <x-success-button type="submit" class="float-right" style="width: 10rem">
                        @if(isset($orientador))
                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                            {{__('Salvar')}}
                        @else
                            <i class="fa-solid fa-plus mr-2"></i>
                            {{__('Adicionar')}}
                        @endif
                    </x-success-button>
                </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#telefoneMask').inputmask('(99) 99999-9999');
        });

        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            document.getElementById('telefone').value = document.getElementById('telefoneMask').value.replace(/\D/g, '');

            this.submit();
        });
    </script>
</x-app-layout>
