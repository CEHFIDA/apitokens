@extends('adminamazing::teamplate')

@section('pageTitle', 'API токены')
@section('content')
    <div class="modal fade" id="deleteModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('AdminApiTokensDelete') }}" method="POST" class="form-horizontal">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">Вы точно хотите удалить данный токен?</div>
                    <div class="modal-footer">
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="id" value="">
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Column -->
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">@yield('pageTitle')</h4>
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
                                            @if($token->scope)
                                                @foreach($token->scope as $rule)
                                                    <span class="label label-info">{{$rule}}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{$token->created_at}}</td>
                                        <td>{{$token->ip_address}}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('AdminApiTokensAbout', $token->id) }}" data-toggle="tooltip" data-original-title="Редактировать"><i class="fa fa fa-pencil text-inverse m-r-10"></i></a>
                                            <a href="#deleteModal" class="delete_toggle" data-rel="{{ $token->id }}" data-toggle="modal"><i class="fa fa-close text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach                                
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $tokens->links('vendor.pagination.bootstrap-4') }}
            </nav>            
        </div>
        <!-- Column -->    
    </div>
@endsection