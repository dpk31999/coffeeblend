<h2>Thank you for using our service !</h2>
<p>Hi <b>{{ $invoice->customer->firstname }} {{ $invoice->customer->lastname }}</b></p>
<h5>You bought products: </h5>
@foreach ($invoice->hasProducts as $hasProducts)
    <div><p>{{$hasProducts->product->name}}</p> , price: {{$hasProducts->product->price}}</div>
<br>
@endforeach
<h3>total : {{ $invoice->total_price }} $</h3>