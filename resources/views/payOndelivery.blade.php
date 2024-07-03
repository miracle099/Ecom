@extends('layout.app')


@section('content')
<div class="breadcrumb_section bg_gray page-title-mini">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-title">
                    <h1>Pay On Delivery</h1>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb justify-content-md-end">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active">Pay On Delivery</li>
                </ol>
            </div>
        </div>

    </div><!-- END CONTAINER-->
</div>
<div class="main_content">
    <div class="section">
        <div class="container">

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('proceedDelivery') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-md-12 col-form-label text-md-start">{{ __('Address') }}</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="address" value="{{ old('Address') }}">
                            <span class="text-danger">@error ('address') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-md-12 col-form-label text-md-start">{{ __('Phone') }}</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                            <span class="text-danger">@error ('phone') {{ $message }} @enderror</span>
                        </div>
                    </div>

                    <button type="submit">Proced</button>

                </form>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection