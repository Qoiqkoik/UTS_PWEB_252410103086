@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="dashboard-page">
        <section class="page-heading">
            <div>
                <p class="eyebrow">DASHBOARD PEMAIN · PERSELA LAMONGAN</p>
                <h1>Siap berjuang, {{ $player['name'] }} <span aria-hidden="true">👋</span></h1>
                <p class="muted">Pantau perjalananmu bersama Laskar Joko Tingkir.</p>
            </div>
            <a class="button button-outline" href="{{ route('pengelolaan', ['username' => $username]) }}">Lihat skuad <span aria-hidden="true">→</span></a>
        </section>

        <section class="stats-grid" aria-label="Statistik pemain">
            @foreach ($stats as $stat)
                <article class="stat-card">
                    <span class="stat-label">{{ $stat['label'] }}</span>
                    <strong class="stat-value">{{ $stat['value'] }}</strong>
                    <span class="stat-detail">{{ $stat['detail'] }}</span>
                </article>
            @endforeach
        </section>

        <section class="dashboard-grid">
            <article class="panel next-match">
                <div class="panel-heading">
                    <div>
                        <p class="eyebrow">AGENDA PEMAIN</p>
                        <h2>{{ $schedule['activity'] }}</h2>
                    </div>
                    <span class="status-pill">INFO DEMO</span>
                </div>
                <div class="matchup">
                    <div class="team-badge">P</div>
                    <div class="player-avatar-small">{{ $player['number'] }}</div>
                </div>
                <div class="match-names player-match-names">
                    <strong>Persela Lamongan</strong>
                    <strong>{{ $player['name'] }} · {{ $player['position'] }}</strong>
                </div>
                <div class="match-details">
                    <span>{{ $schedule['date'] }}</span>
                    <span>{{ $schedule['time'] }}</span>
                </div>
            </article>

            <aside class="panel team-message">
                <span class="message-icon" aria-hidden="true">✦</span>
                <p class="eyebrow">PROFIL PEMAIN</p>
                <h2>Nomor {{ $player['number'] }} · {{ $player['position'] }}</h2>
                <p class="muted">Terus kerja keras, jaga kekompakan, dan berikan yang terbaik untuk Lamongan.</p>
                <span class="message-signature">Akun: {{ $username }}</span>
            </aside>
        </section>
    </div>
@endsection
