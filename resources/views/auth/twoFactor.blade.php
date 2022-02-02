@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card-group">
            <div class="card p-4">
                <div class="card-body">
                    @if(session()->has('message'))
                        <p class="alert alert-info">
                            {{ session()->get('message') }}
                        </p>
                    @endif


                        @csrf
                        <h1>{{ __('global.two_factor.title_checkmail') }}</h1>
                        <p class="text-muted">
                            {!! __('global.two_factor.sub_title', ['minutes' => 15]) !!}
                        </p>





                        <div class="row">
                            <div class="col-6">

                                <a class="btn btn-secondary px-4" href="{{ route('twoFactor.resend') }}">{{ __('global.two_factor.resend') }}</a>
                            </div>
                            <div class="col-6 text-right">



                                <a class="hide btn btn-success px-4" href="#" onclick="closeWindow();">
                                    {{ trans('global.close_this_window') }}
                                </a>
                            </div>
                        </div>


                </div>
                <a class="small text-danger  px-4" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    {{ trans('global.logout') }}
                </a>
            </div>
        </div>
    </div>
</div>

<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<script type="text/javascript">
    function closeWindow() {

        // Open the new window
        // with the URL replacing the
        // current page using the
        // _self value
        let new_window =
            open(location, '_self');

        // Close this window
        new_window.close();

        return false;
    }
</script>

@endsection
