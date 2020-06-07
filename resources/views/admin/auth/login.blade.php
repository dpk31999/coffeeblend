@extends('admin.layouts.app')
@section('content')
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="/png/logo.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{route('admin.make.login')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>User Name</label>
                                <input class="au-input au-input--full" type="text" name="username" placeholder="username">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                            
                        
                            </div>
                            @if(isset($error))
                                <span>
                                    <strong>{{ $error }}</strong>
                                </span>
                            @endif
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection