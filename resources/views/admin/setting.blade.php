@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="d-flex" style="margin-bottom: 50px; position: relative">
            <h3>Table Admin</h3>
            <button class="au-btn au-btn-load" style="position: absolute;right: 0px" data-toggle="modal" data-target="#exampleModalCenter">Add admin</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>date create</th>
                                <th>username</th>
                                <th>name</th>
                                <th>role</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($admins as $admin)
                                <tr 
                                <?php
                                if($admin->get_role()->name != 'superadmin'){
                                    echo 'class="admin"';
                                }
                                ?>
                                data-id="{{$admin->id}}">
                                    <td id="create{{$admin->id}}" >{{$admin->created_at}}</td>
                                    <td id="username{{$admin->id}}" >{{$admin->username}}</td>
                                    <td id="name{{$admin->id}}" >{{$admin->name}}</td>
                                    <td id="role{{$admin->id}}" >{{$admin->get_role()->name}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">Admin Setting</div>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Create Admin</h3>
                    </div>
                    <hr>
                    <form action="{{route('admin.addadmin')}}" id="form_add_admin" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Username</label>
                            <input id="username" name="username" type="text" class="form-control" placeholder="username">
                            <div id="errorusername"></div>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder="full name">
                            <div id="errorname"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Email</label>
                            <input id="email" name="email" type="text" class="form-control" placeholder="email">
                            <div id="erroremail"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Select Role</label>
                            <select name="selectrole" id="select" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Password</label>
                            <input id="password" name="password" type="password" class="form-control" value="" placeholder="password" required autocomplete="new-password">
                            <div id="errorpassword"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Confirm Password</label>
                            <input id="confirmpassword" name="password_confirmation" type="password" class="form-control" value=""  placeholder="confirm password" required autocomplete="new-password">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dropdown-menu dropdown-menu-sm" id="context-menu">
    <a class="dropdown-item" style="cursor: pointer" id="delete">Delete</a>
    <a class="dropdown-item edit" data-id="edit" style="cursor: pointer" id="" >Edit</a>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">Admin Setting</div>
                    <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Edit Admin</h3>
                    </div>
                    <hr>
                    <form id="" class="form_edit_admin" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Username</label>
                            <input id="usernameedit" name="username" type="text" class="form-control" placeholder="username">
                            <p id="errorusername" style="color: red" class="help is-danger">{{ $errors->first('username') }}</p>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input id="nameedit" class="form-control" type="text" name="name" placeholder="full name">
                            <p id="errorname" style="color: red" class="help is-danger">{{ $errors->first('name') }}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Email</label>
                            <input id="emailedit" name="email" type="text" class="form-control" placeholder="email">
                            <p id="erroremail" style="color: red" class="help is-danger">{{ $errors->first('email') }}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Select Role</label>
                            <select name="selectrole" id="selectedit" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Password</label>
                            <input id="passwordedit" name="password" type="password" class="form-control" value="" placeholder="password" required autocomplete="new-password">
                            <p id="errorpassword" style="color: red" class="help is-danger">{{ $errors->first('password') }}</p>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Confirm Password</label>
                            <input id="confirmpasswordedit" name="password_confirmation" type="password" class="form-control" value=""  placeholder="confirm password" required autocomplete="new-password">
                            <p id="errorconfirmpassword" style="color: red" class="help is-danger">{{ $errors->first('password_confirmation') }}</p>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-info btn-block">
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection