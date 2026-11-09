@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <section class="login-layout">
        <div class="login-intro">
            <p class="eyebrow">PORTAL PEMAIN · LAMONGAN</p>
            <h1>Bangga biru.<br><span>Berjuang bersama.</span></h1>
            <p class="intro-copy">Ruang digital pemain Persela Lamongan untuk melihat profil, statistik, dan informasi skuad.</p>
            <div class="intro-note">
                <span class="live-dot"></span>
                <span>Laskar Joko Tingkir · Satu hati.</span>
            </div>
        </div>

        <div class="login-card">
            <p class="eyebrow">AKSES PEMAIN</p>
            <h2>Masuk portal</h2>
            <p class="muted">Gunakan akun demo pemain untuk melanjutkan.</p>

            <form action="{{ route('login.submit') }}" method="POST" class="login-form">
                @csrf
                <label for="username">Username</label>
                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username') }}"
                    placeholder="Username pemain"
                    maxlength="40"
                    autocomplete="username"
                    required
                    autofocus
                >
                @error('username')
                    <p class="field-error">{{ $message }}</p>
                @enderror

                <label for="password">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <p class="field-error">{{ $message }}</p>
                @enderror
                @error('credentials')
                    <p class="field-error" role="alert">{{ $message }}</p>
                @enderror
                <button class="button button-primary" type="submit">Masuk sebagai pemain <span aria-hidden="true">→</span></button>
            </form>

            <p class="form-hint">Akun demo: <strong>Rizki Ridho Ramadhani</strong> · Password: <strong>RizkiRidho5</strong><br>Simulasi tugas tanpa database, bukan autentikasi produksi.</p>
        </div>
    </section>
@endsection
