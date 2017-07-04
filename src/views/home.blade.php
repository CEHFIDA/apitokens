@extends('adminamazing::teamplate')

@section('pageTitle', 'Api токены')
@section('content')
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
                                    <th>Название токена</th>
                                    <th>Права</th>
                                    <th>Дата создания</th>
                                    <th>IP</th>
                                    <th class="text-nowrap">Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ApiTokens as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name_token}}</td>
                                        <td>
                                        	@if($user->scope_view)
	                                        	@foreach($user->scope_view as $row)
	                                        		<span class="label label-info">{{$row}}</span>
	                                        	@endforeach
                                        	@endif
                                        </td>
                                        <td>{{$user->created_at}}</td>  
                                        <td>{{$user->ip_address}}</td>      
                                        <td class="text-nowrap">                                            
                                            <form action="{{ route('AdminUsersDeleted', $user->id) }}" method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                 <a href="{{ route('AdminUsersEdit', $user->id) }}" data-toggle="tooltip" data-original-title="Редактировать"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                <button class="btn btn-link" data-toggle="tooltip" data-original-title="Удалить"><i class="fa fa-close text-danger"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div>
            <nav aria-label="Page navigation example" class="m-t-40">
                {{ $ApiTokens->links('vendor.pagination.bootstrap-4') }}
            </nav>
        </div>
        <!-- Column -->    
    </div>
@endsection