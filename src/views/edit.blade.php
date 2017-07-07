@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование/Просмотр токена')
@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-xlg-8 col-md-8"> 
            <div class="card">
                <div class="card-block">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <form action="{{route('AdminApiTokenUpdate', $tokenInfo->id)}}" method="POST" class="form-horizontal form-material">
                        <div class="form-group">
                            <label for="name_token" class="col-md-12">Имя</label>
                            <div class="col-md-12">
                                <input type="text" name="name_token" id="name_token" value="{{$tokenInfo->name_token}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ip_address" class="col-md-12">IP доступа</label>
                            <div class="col-md-12">
                                <input type="text" name="ip_address" id="ip_address" value="{{$tokenInfo->ip_address}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="token" class="col-md-12">Токен</label>
                            <div class="col-md-12">
                                <input type="text" name="token" id="token" value="{{$tokenInfo->token}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12">Права</label>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-primary">
                                            <input id="checkbox1" type="checkbox" checked disabled>
                                            <label for="checkbox1">
                                                Информация о аккаунте
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-primary">
                                            <input id="checkbox2" type="checkbox" 
                                                @if(count($tokenInfo->scope_view)> 0 && in_array("create_address", $tokenInfo->scope_view))
                                                    checked
                                                @endif 
                                                name="scope[]" 
                                                value="create_address">
                                            <label for="checkbox2">
                                                Создание адресов
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-primary">
                                            <input id="checkbox3" type="checkbox"
                                                @if(count($tokenInfo->scope_view)> 0 && in_array("history_transaction", $tokenInfo->scope_view))
                                                    checked
                                                @endif
                                                name="scope[]" 
                                                value="history_transaction">
                                            <label for="checkbox3">
                                                История транзакций
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-primary">
                                            <input id="checkbox4" type="checkbox" 
                                                @if(count($tokenInfo->scope_view)> 0 && in_array("sending_funds", $tokenInfo->scope_view))
                                                    checked
                                                @endif
                                                name="scope[]" value="sending_funds">
                                            <label for="checkbox4">
                                                Отправка средств
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Обновить профиль</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xlg-4 col-md-4"> 
            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <label for="new_password" class="col-md-12">URL уведомлений ({{$tokenInfo->notiffication_status->method }})</label>
                        <div class="col-md-12">
                            <input type="text" disabled id="new_password" value="{{$tokenInfo->notiffication_status->url }}" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="col-md-12">URL ошибка при оплате ({{$tokenInfo->notiffication_fail->method }})</label>
                        <div class="col-md-12">
                            <input type="text" disabled id="new_password" value="{{$tokenInfo->notiffication_fail->url }}" class="form-control form-control-line">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_password" class="col-md-12">URL возрата после оплаты ({{$tokenInfo->notiffication_success->method }})</label>
                        <div class="col-md-12">
                            <input type="text" disabled id="new_password" value="{{$tokenInfo->notiffication_success->url }}" class="form-control form-control-line">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection