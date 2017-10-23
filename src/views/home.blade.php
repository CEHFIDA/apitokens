@extends('adminamazing::teamplate')

@section('pageTitle', 'API токены')
@section('content')
    <script>
    var route = '{{ route('AdminApiTokensDelete') }}';
    var message = 'Вы точно хотите удалить данный токен?';
    </script>
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">@yield('pageTitle')</h4>
                    @if(count($tokens) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Имя</th>
                                    <th>Права</th>
                                    <th>Дата создания</th>
                                    <th>IP</th>
                                    <th class="text-nowrap">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tokens as $token)
                                    <tr>
                                        <td>{{$token->id}}</td>
                                        <td>{{$token->name_token}}</td>
                                        <td>
                                            <span class="label label-info">account_information</span>
                                            @if(count($token->scope) > 0)
                                                @foreach($token->scope as $rule)
                                                    <span class="label label-info">{{$rule}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$token->created_at}}</td>
                                        <td>{{$token->ip_address}}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('AdminApiTokensEdit', $token->id) }}" data-toggle="tooltip" data-original-title="Редактировать"><i class="fa fa fa-pencil text-inverse m-r-10"></i></a>
                                            <a href="#deleteModal" class="delete_toggle" data-rel="{{ $token->id }}" data-toggle="modal"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning text-center">
                        <h4>Токенов не найдено!</h4>
                    </div>
                    @endif
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $tokens->links('vendor.pagination.bootstrap-4') }}
            </nav>            
        </div>
        <!-- Column -->    
    </div>
@endsection