@extends('admin.layouts.app')

@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
        <div class="d-flex" style="margin-bottom: 50px; position: relative">
            <h3>Table Admin</h3>
            @if (Auth::guard('admin')->user()->hasRole('author'))
            <a href="{{route('admin.post.add')}}" class="au-btn au-btn-load" style="position: absolute;right: 0px">Add Post</a>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>Date create</th>
                                <th>Admin create</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Views</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($posts as $post)
                                <tr class="post" data-id="{{$post->id}}" @if($post->status ==1) style="background-color :#ffb3b3" @endif>
                                    <td>{{$post->created_at}}</td>
                                    <td>{{$post->admin->username}}</td>
                                    <td>{{$post->comments->count()}}</td>
                                    @if ($post->status == 0)
                                    <td id="status{{$post->id}}">Unavaiable</td>
                                    @else
                                    <td id="status{{$post->id}}">Avaiable</td>
                                    @endif
                                    <td>{{$post->view}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content content">
        @if (Auth::guard('admin')->user()->hasRoles(['superadmin','admin']))
        <a class="text-decoration-none text-dark allow-post" style="cursor: pointer" data-id="allow-post"><div class="in-setting">UnBlock/Block</div></a>
        <a class="text-decoration-none text-dark delete-post" style="cursor: pointer" data-id="delete_post"><div class="in-setting">Delete</div></a>
        @endif
        <a href="" class="text-decoration-none text-dark edit-post" style="cursor: pointer" data-id="edit_post"><div class="in-setting">Edit</div></a>
        <a class="text-decoration-none text-dark detail-post" style="cursor: pointer" data-id="view_post"><div class="in-setting">View Detail</div></a>
    </div>
</div>
@endsection