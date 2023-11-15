<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-book mr-2"></i>
        @if(isset($topico))
            {{ __('Editar tópico') }}
        @else
            {{ __('Adicionar tópico') }}
        @endif
    </x-slot>

    <x-slot name="headerButton">
        <x-clean-button type="button" onclick="window.location='{{route('topico.listagem')}}'">
            <i class="fa-solid fa-left-long mr-2"></i>{{__('Voltar')}}
        </x-clean-button>
    </x-slot>

    <div style="display: none">
        {{$idValue = $topico->id ?? 0}}
        {{$situacaoValue = old('situacao') ?? ($topico->situacao ?? '')}}
        {{$idOrientadorValue =  old('idOrientador') ?? ($topico->idOrientador ?? 0)}}
    </div>

    <div class="p-6">
        <div class="p-6 text-gray-950 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @if(isset($topico))
                <form method="post" action="{{route('topico.update')}}" class="needs-validation" novalidate>
                    @method('patch')
            @else
                </form>

                <form method="post" action="{{ route('topico.create') }}" class="needs-validation" novalidate>
            @endif
                    @csrf

                    <input id="id" name="id" value="{{$idValue}}" type="text" class="form-control hidden">

                    <div class="mb-3 d-flex">
                        <div class="w-50 px-1">
                            <label for="titulo" class="form-label">Título*</label>
                            <input id="titulo" name="titulo" value="{{old('titulo') ?? ($topico->titulo ?? '')}}" type="text" class="form-control input" placeholder="Título..." required>
                        </div>

                        <div class="w-25 px-1">
                            <label for="idOrientador" class="form-label">Orientador</label>
                            <select id="idOrientador" name="idOrientador" class="form-select input">
                                <option value="0"></option>

                                @foreach($orientadores as $orientador)
                                    <option value={{$orientador->id}} @if($idOrientadorValue == $orientador->id) selected @endif>{{$orientador->nome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-25 px-1">
                            <label for="situacao" class="form-label">Situação</label>
                            <select id="situacao" name="situacao" class="form-select input">
                                @if(!$situacaoValue)
                                    selected
                                    <option value="1">Habilitado</option>
                                    <option selected value="0">Desabilitado</option>
                                @else
                                    <option selected value="1">Habilitado</option>
                                    <option value="0">Desabilitado</option>
                                @endif

                            </select>
                        </div>
                    </div>

                    <div class="mb-3 px-1">
                        <label for="conteudo" class="form-label">Conteúdo do tópico*</label>
                        <textarea id="conteudo" name="conteudo" class="form-control input" style="min-height: 150px" required>{{old('conteudo') ?? ($topico->conteudo ?? '')}}</textarea>
                    </div>

                    <x-success-button type="submit" class="float-right" style="width: 10rem">
                        @if(isset($topico))
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
        (() => {
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                        toastr.error("Preencha todos os campos obrigatórios!");
                    }

                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</x-app-layout>
