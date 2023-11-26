<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-user mr-2"></i>
        @if(isset($usuario))
            {{ __('Editar usuário') }}
        @else
            {{ __('Adicionar usuário') }}
        @endif
    </x-slot>

    <x-slot name="headerButton">
        <x-clean-button type="button" onclick="window.location='{{route('usuario.listagem')}}'">
            <i class="fa-solid fa-left-long mr-2"></i>{{__('Voltar')}}
        </x-clean-button>
    </x-slot>

    <div style="display: none">
        {{$idValue = $usuario->id ?? 0}}
        {{$rota = $idValue ? route('usuario.update') : route('usuario.create')}}
        {{$situacaoValue = old('situacao') ?? ($usuario->situacao ?? '')}}
        {{$isAdmin =  old('admin') ?? ($usuario->admin ?? 0)}}
    </div>

    <div class="p-6">
        <div class="p-6 text-gray-950 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <form method="post" action="{{$rota}}" class="needs-validation" novalidate>
                @if(isset($usuario))
                    @method('patch')
                @endif
                @csrf

                <input id="id" name="id" value="{{$idValue}}" type="text" class="form-control hidden">

                <div class="mb-3 d-flex">
                    <div class="w-50 px-1">
                        <label for="nome" class="form-label">Título*</label>
                        <input id="nome" name="nome" value="{{old('nome') ?? ($usuario->nome ?? '')}}" type="text" class="form-control input" placeholder="Nome completo..." required>
                    </div>

                    <div class="w-25 px-1">
                        <label for="admin" class="form-label">Administrador</label>
                        <select id="admin" name="admin" class="form-select input">
                            @if(!$isAdmin)
                                selected
                                <option selected value="0">Não</option>
                                <option value="1">Sim</option>
                            @else
                                <option value="0">Não</option>
                                <option selected value="1">Sim</option>
                            @endif
                        </select>
                    </div>

                    <div class="w-25 px-1">
                        <label for="situacao" class="form-label">Situação</label>
                        <select id="situacao" name="situacao" class="form-select input">
                            @if($situacaoValue)
                                <option value="0">Desabilitado</option>
                                <option selected value="1">Habilitado</option>
                            @else
                                <option selected value="0">Desabilitado</option>
                                <option value="1">Habilitado</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div class="mb-3 d-flex">
                    <div class="w-50 mb-3 px-1">
                        <label for="email" class="form-label">Email*</label>
                        <input id="email" name="email" type="email" value="{{old('email') ?? ($usuario->email ?? '')}}" class="form-control input" placeholder="Email..." required>
                    </div>

                    <div class="w-50 mb-3 px-1">
                        @if(isset($usuario))
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" name="password" type="password" class="form-control input" placeholder="Senha...">
                        @else
                            <label for="password" class="form-label">Senha*</label>
                            <input id="password" name="password" type="password" class="form-control input" placeholder="Senha..." required>
                        @endif
                    </div>
                </div>

                <x-success-button type="submit" class="float-right" style="width: 10rem">
                    @if(isset($usuario))
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
</x-app-layout>
