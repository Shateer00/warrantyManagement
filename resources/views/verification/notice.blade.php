@extends('layouts.app')
@section('title')
Notice
@endsection

@section('content')
<div class="bg-gradient p-5 rounded">
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        A fresh verification link has been sent to your email address.
    </div>
    @endif

    <p>Before proceeding, please check your email for a verification link. If you did not receive the email,</p>
    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="d-inline btn btn-link p-0">
            click here to request another
        </button>
    </form>
</div>
@endsection
