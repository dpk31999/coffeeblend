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
                                <th>date order</th>
                                <th>name</th>
                                <th>total price</th>
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($invoices as $invoice)
                                <tr class="invoice" style="<?php if($invoice->status == 0) echo 'background-color: #ffb3b3' ?>" data-id="{{$invoice->id}}">
                                    <td>{{$invoice->created_at}}</td>
                                    <td>{{$invoice->customer->firstname}} {{$invoice->customer->lastname}}</td>
                                    <td>{{$invoice->total_price}}</td>
                                    @if ($invoice->status == 0)
                                        <td id="status{{$invoice->id}}">Waiting</td>
                                    @else
                                        <td id="status{{$invoice->id}}"">Completed</td>
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
            <a class="text-decoration-none text-dark completed-order" style="cursor: pointer" data-id="completed_order"><div class="in-setting">Completed</div></a>
            <a class="text-decoration-none text-dark info-customer" style="cursor: pointer" data-id="info_customer"><div class="in-setting">Info Customer</div></a>
            <a class="text-decoration-none text-dark info-invoice" style="cursor: pointer" data-id="info_invoice"><div class="in-setting">Info Invoice</div></a>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">Info Customer</div>
                    <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body" style="margin: 0 10px">
                    <div class="card-title">
                        <h3 class="text-center title-2">View Detail</h3>
                    </div>
                    <hr>
                    <div class="mb-2"><strong>Account</strong></div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Name</p>
                        <p style="position: absolute;right: 0px" id="name"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Country</p>
                        <p style="position: absolute;right: 0px" id="country"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Address</p>
                        <p style="position: absolute;right: 0px" id="address"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Phone</p>
                        <p style="position: absolute;right: 0px" id="phone"></p>
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Email</p>
                        <p style="position: absolute;right: 0px" id="email"></p>
                    </div>
                    <div class="mb-2 mt-2"><strong>Other Infomation</strong></div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Total orders</p>
                        <p style="position: absolute;right: 0px" id="total"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="modal-header">
                    <div class="card-header">Info Invoice</div>
                    <button type="button" id="closeEdit" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body " style="margin: 0 10px">
                    <div class="card-title">
                        <h3 class="text-center title-2">View Detail</h3>
                    </div>
                    <hr>
                    <div class="mb-2"><strong>Products</strong></div>
                    <div class="products">
                    </div>
                    <div class="d-flex" style="position: relative; border-bottom: 1px solid #ffcccc
; padding: 10px">
                        <p>Total Price</p>
                        <p style="position: absolute;right: 0px" id="total1"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection