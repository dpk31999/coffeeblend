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
                                <th>name</th>
                                <th>total products</th>
                                <th>create by</th>
                                <th>role</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($categories as $category)
                                <tr class="cate" data-id="{{$category->id}}">
                                    <td>{{$category->created_at}}</td>
                                    <td id="namecate{{$category->id}}">{{$category->name}}</td>
                                    <td>{{$category->products->count()}}</td>
                                    <td>{{$category->admin->username}}</td>
                                    <td>{{$category->admin->get_role()->name}}</td>
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
                    <div class="card-header">Admin</div>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Create Category</h3>
                    </div>
                    <hr>
                    <form id="form_add_cate" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Name Category</label>
                            <input id="namecate" name="name" type="text" class="form-control" placeholder="name category" required>
                            <p id="errorname" style="color: red" class="help is-danger"></p>
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">Admin</div>
                    <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Edit Category</h3>
                    </div>
                    <hr>
                    <form class="form_edit_cate" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Name Category</label>
                            <input id="namecateedit" name="name" type="text" class="form-control" placeholder="name category">
                            <p id="errornameedit" style="color: red" class="help is-danger">{{ $errors->first('namecate') }}</p>
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
<div class="modal fade" id="modalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content content">
        <a class="text-decoration-none text-dark delete" style="cursor: pointer" data-id="delete"><div class="in-setting">Delete</div></a>
        <a class="text-decoration-none text-dark edit" style="cursor: pointer" data-id="edit"><div class="in-setting">Edit</div></a>
        <a class="text-decoration-none text-dark view" style="cursor: pointer" data-id="view"><div class="in-setting">View Products</div></a>
    </div>
</div>
@endsection