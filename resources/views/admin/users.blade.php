@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>date create</th>
                                <th>name</th>
                                <th>email</th>
                                <th>status</th>
                                <th>provider</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($users as $user)
                                <tr class="user" style="<?php if($user->status == 1) echo 'background-color: #ffb3b3' ?>" data-id="{{$user->id}}">
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    @if ($user->status == 0)
                                    <td id="status{{$user->id}}">Active</td>
                                    @else
                                    <td id="status{{$user->id}}"">Block</td>
                                    @endif
                                    <td>{{$user->provider}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
    <a class="dropdown-item block" data-id="block" style="cursor: pointer" id="">Block/Unblock</a>
</div>
@endsection