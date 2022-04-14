@extends('layouts.guest')
@section('title')
Notice
@endsection

@section('content')
<div class="bg-gradient p-5 rounded">
    @if (session('resent'))
    <div class="alert alert-success" role="alert">
        {{-- A fresh verification link has been sent to your email address. --}}
        Link Verifikasi sudah dikirimkan ke Alamat Email Anda.
        {{-- Link Verifikasi sudah dikirimkan ke Email Admin mohon menunggu Feedback dari Admin. --}}
    </div>
    @endif

    <p>
        Sebelum mulai harap melakukan pengecekan Alamat Email anda untuk Link Verifikasi.
        {{-- Before proceeding, please check your email for a verification link. If you did not receive the email, --}}
        {{-- Sebelum melanjutkan mohon menunggu Verifikasi dari Admin. --}}
    </p>
    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="d-inline btn btn-link p-0">
            {{-- click here to request another --}}
            Klik disini untuk Kirim ulang.
        </button>
    </form>
</div>
@endsection
