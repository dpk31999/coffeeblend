@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="d-flex" style="margin-bottom: 50px; position: relative">
            <h3>Table Admin</h3>
            <button class="au-btn au-btn-load" style="position: absolute;right: 0px" data-toggle="modal" data-target="#exampleModalCenter">Add Product</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>date create</th>
                                <th>name</th>
                                <th>price</th>
                                <th>category</th>
                                <th>image</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($products as $product)
                                <tr class="product" data-id="{{$product->id}}">
                                    <td>{{$product->created_at}}</td>
                                    <td id="nameproduct{{$product->id}}">{{$product->name}}</td>
                                    <td id="priceproduct{{$product->id}}">{{$product->price}}</td>
                                    <td id="cateproduct{{$product->id}}">{{$product->category->name}}</td>
                                    <td><img id="imageproduct{{$product->id}}" src="/storage/{{$product->url_image}}" width="50px" height="50px" alt=""></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
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
                    <form id="form_add_product" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Name Product</label>
                            <input id="nameproduct" name="name" type="text" class="form-control" placeholder="name category" required>
                            <div id="errorname"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Price</label>
                            <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input id="priceproduct" name="price" type="number" value="1" min="0" data-number-to-fixed="2" class="form-control currency" />
                            </div> 
                            <div id="errorprice"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Select Category</label>
                            <select name="selectcate" id="select" name="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Description</label>
                            <textarea placeholder="description." name="description" class="form-control" id="description" rows="5" required></textarea>
                            <div id="errordescription"></div>
                        </div>
                        <div class="form-group">
                            <label for="url_image" class="control-label mb-1">Image</label>
                            <input name="url_image" class="form-control-file" type='file' id="url_image" />
                            <img id="blah" src="" alt="" />
                            <div id="errorimage"></div>
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
                <div class="card-body modal-body">
                    <div class="card-title">
                        <h3 class="text-center title-2">Edit Product</h3>
                    </div>
                    <hr>
                    <form class="form_edit_product" method="post">
                        @csrf
                        <div class="form-group">
                            <label class="control-label mb-1">Name Product</label>
                            <input id="nameproductedit" name="name" type="text" class="form-control" placeholder="name category" required>
                            <div id="errornameedit"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Price</label>
                            <div class="input-group"> 
                                <span class="input-group-addon">$</span>
                                <input id="priceproductedit" name="price" type="number" value="1" min="0" data-number-to-fixed="2" class="form-control currency" />
                            </div> 
                            <div id="errorpriceedit"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Select Category</label>
                            <select name="selectcate" id="selectedit" name="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{$category->name}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-1">Description</label>
                            <textarea placeholder="description." name="description" class="form-control" id="descriptionedit" rows="2" required></textarea>
                            <div id="errordescriptionedit"></div>
                        </div>
                        <div class="form-group">
                            <label for="url_image" class="control-label mb-1">Image</label>
                            <input name="url_image" class="form-control-file" type='file' id="url_image_edit" />
                            <img id="editimage" src="" alt="" />
                            <div id="errorimageedit"></div>
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
        <a class="text-decoration-none text-dark delete-product" style="cursor: pointer" data-id="delete_product"><div class="in-setting">Delete</div></a>
        <a class="text-decoration-none text-dark edit-product" style="cursor: pointer" data-id="edit_product"><div class="in-setting">Edit</div></a>
        <a class="text-decoration-none text-dark detail-product" style="cursor: pointer" data-id="view_product"><div class="in-setting">View Detail</div></a>
    </div>
</div>
@endsection