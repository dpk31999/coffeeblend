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
                                <th>date booking</th>
                                <th>time</th>
                                <th>name</th>
                                <th>phone</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($books as $book)
                                <tr <?php if($book->status == 0) echo 'class="book"' ?> style="<?php if($book->status == 0) echo 'background-color: #ffb3b3' ?>" data-id="{{$book->id}}">
                                    <td>{{$book->date}}</td>
                                    <td>{{$book->time}}</td>
                                    <td>{{$book->firstname}} {{$book->lastname}}</td>
                                    <td>{{$book->phone}}</td>
                                    @if ($book->status == 0)
                                        <td id="status{{$book->id}}">Waiting</td>
                                    @elseif($book->status == 1)
                                        <td id="status{{$book->id}}"">Confirm</td>
                                    @elseif($book->status == 2)
                                        <td id="status{{$book->id}}"">Refuse</td>
                                    @endif
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
        <a class="text-decoration-none text-dark refuse-booking" style="cursor: pointer" data-id="refuse_booking"><div class="in-setting">Refuse</div></a>
        <a class="text-decoration-none text-dark confirm-booking" style="cursor: pointer" data-id="confirm_booking"><div class="in-setting">Confirm</div></a>
    </div>
</div>
@endsection