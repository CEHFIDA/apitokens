@extends('adminamazing::teamplate')

@section('pageTitle', 'Редактирование токена')
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
                    <form action="{{route('AdminApiTokensUpdate', $token->id)}}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="name_token" class="col-md-12">Имя</label>
                            <div class="col-md-12">
                                <input type="text" name="name_token" id="name_token" value="{{$token->name_token}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ip_address" class="col-md-12">IP доступа</label>
                            <div class="col-md-12">
                                <input type="text" name="ip_address" id="ip_address" value="{{$token->ip_address}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="token" class="col-md-12">Токен</label>
                            <div class="col-md-12">
                                <input type="text" name="token" id="token" value="{{$token->token}}" placeholder="" class="form-control form-control-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="commission" class="col-md-12">Комиссия</label>
                            <div class="col-md-12">
                                <div style="width:10%">
                                    <input type="number" size="1" name="commission" id="commission" min="0" max="100" step="0.1" value="{{$commission}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Права</label>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-success">
                                            <input id="checkbox1" type="checkbox" checked disabled>
                                            <label for="checkbox1">
                                                Информация о аккаунте
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkbox checkbox-inline checkbox-success">
                                            <input id="checkbox2" type="checkbox" 
                                                @if(in_array("create_address", $token->scope))
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
                                        <div class="checkbox checkbox-inline checkbox-success">
                                            <input id="checkbox3" type="checkbox"
                                                @if(in_array("history_transaction", $token->scope))
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
                                        <div class="checkbox checkbox-inline checkbox-success">
                                            <input id="checkbox4" type="checkbox" 
                                                @if(in_array("sending_funds", $token->scope))
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

                        <div class="form-group">
                            <label class="col-md-12">Создатель: {{$creator['name']}} (<a href="{{ route('AdminUsersEdit', $creator['id']) }}">{{$creator['email']}}</a>)</label>
                        </div>

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Обновить токен</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xlg-4 col-md-4"> 
            <div class="card">
                <div class="card-block">
                    <div class="form-group">
                        <label for="notify" class="col-md-12">URL уведомлений</label>
                        <div class="col-md-12">
                            <input type="text" name="notiffication_status_url" id="notify" value="{{$token->notiffication_status->url }}" class="form-control form-control-line">
                            <select class="custom-select col-12" name="notiffication_status_method">
                                <option 
                                value="GET"
                                @if($token->notiffication_status->method == "GET")
                                    selected
                                @endif
                                >GET</option>
                                <option 
                                value="POST"
                                @if($token->notiffication_status->method == "POST")
                                    selected
                                @endif
                                >POST</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="before_payment" class="col-md-12">URL ошибка при оплате</label>
                        <div class="col-md-12">
                            <input type="text" name="notiffication_fail_url" id="before_payment" value="{{$token->notiffication_fail->url }}" class="form-control form-control-line">
                            <select class="custom-select col-12" name="notiffication_fail_method">
                                <option 
                                value="GET"
                                @if($token->notiffication_fail->method == "GET")
                                    selected
                                @endif
                                >GET</option>
                                <option 
                                value="POST"
                                @if($token->notiffication_fail->method == "POST")
                                    selected
                                @endif
                                >POST</option>
                            </select>                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="after_payment" class="col-md-12">URL возрата после оплаты</label>
                        <div class="col-md-12">
                            <input type="text" name="notiffication_success_url" id="after_payment" value="{{$token->notiffication_success->url }}" class="form-control form-control-line">
                            <select class="custom-select col-12" name="notiffication_success_method">
                                <option 
                                value="GET"
                                @if($token->notiffication_success->method == "GET")
                                    selected
                                @endif
                                >GET</option>
                                <option 
                                value="POST"
                                @if($token->notiffication_success->method == "POST")
                                    selected
                                @endif
                                >POST</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- Column -->
    </div>
@endsection