@extends('layouts.app')

@section('content')
<div class="container is-fluid">
    <div class="columns is-mobile is-12">

        <div class="column is-half is-offset-one-quarter">
            @if ($errors->has('email'))
                <div class="notification is-warning">
                   {{ $errors->first('email') }}
                </div>
            @endif

            @if ($errors->has('password'))
                <div class="notification is-warning">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="field">
              <p class="control has-icons-left">

                <input id="email" type="email" class="input is-medium {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                  <i class="fas fa-check"></i>
                </span>
              </p>
            </div>

            <div class="field">
              <p class="control has-icons-left">
                <input id="password" type="password" class="input is-medium {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>
                <span class="icon is-small is-left">
                  <i class="fas fa-lock"></i>
                </span>
              </p>
            </div>

            <div class="field">
              <p class="control">
                <button class="button is-success is-medium">
                  Login
                </button>
                </form>
              </p>
            </div>
        </div>

    </div>
</div>
@endsection
