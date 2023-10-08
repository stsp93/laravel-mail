@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verify Your Email Address</div>

                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        A fresh verification link has been sent to your email address.
                        Before proceeding, please check your email for a verification link.
                    </div>
                    
                    @if (!session('newUser'))
                        'If you did not receive the email, <a href="/email/resend">click here to request another</a>.
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection