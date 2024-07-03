@extends('layout.app')

@section('content')



<div class="main_content">

    <!-- START LOGIN SECTION -->
    <div class="login_register_wrap section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-6 col-md-10">
                    <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <h3>Enter Password</h3>
                                <p>A code has been sent to <span style="color: red;">{{ $email }}</span></p>
                            </div>
                            <form method="POST" action="{{ route('submitCode') }}">
                            @csrf

                            <div class="row mb-3">
                            <input type="text" class="form-control" value="{{ $email }}" hidden name="user_email">
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required  autofocus>

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="code-not-received">
                                <p id="resendLink" >
                                    Did't Receive code? <button href="{{ route('resend_code', $email) }}" id="start-btn" >Resend Code</button>
                                </p>
                                <div>
                                    <p >Resend code in <span id="countdown"> 01:00</span> </p>
                                </div>
                            <button id="submit-btn" style="display: inline-block;" type="submit" >register</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGIN SECTION -->

</div>
<!-- END MAIN CONTENT -->



@endsection