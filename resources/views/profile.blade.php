@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="profile-page">
        <section class="page-heading">
            <div>
                <p class="eyebrow">PROFIL PEMAIN PERSELA</p>
                <h1>Profil pemain</h1>
                <p class="muted">Informasi akun demo pemain yang sedang aktif.</p>
            </div>
        </section>

        <section class="panel profile-card">
            <div class="profile-avatar">{{ $player['number'] }}</div>
            <div class="profile-details">
                <p class="eyebrow">LASKAR JOKO TINGKIR</p>
                <h2>{{ $player['name'] }}</h2>
                <dl class="profile-list">
                    <div><dt>Username</dt><dd>{{ $username }}</dd></div>
                    <div><dt>Posisi</dt><dd>{{ $player['position'] }}</dd></div>
                    <div><dt>Nomor punggung</dt><dd>{{ $player['number'] }}</dd></div>
                    <div><dt>Tim</dt><dd>{{ $team }}</dd></div>
                    <div><dt>Kewarganegaraan</dt><dd>{{ $player['nationality'] }}</dd></div>
                </dl>
                <a class="button button-outline" href="{{ route('dashboard', ['username' => $username]) }}">Kembali ke dashboard</a>
            </div>
        </section>
    </div>
@endsection
