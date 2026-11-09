@extends('layouts.app')

@section('title', 'Pengelolaan Skuad')

@section('content')
    <div class="roster-page">
        <section class="page-heading">
            <div>
                <p class="eyebrow">SKUAD PERSELA LAMONGAN</p>
                <h1>Setia Bersamamu
                </h1>
                <p class="muted">Pemain Laskar Joko Tingkir musim ini.</p>
            </div>
            <span class="roster-count">{{ count($players) }} pemain</span>
        </section>

        <section class="panel roster-panel">
            <div class="roster-intro">
                <div>
                    <p class="eyebrow">LASKAR JOKO TINGKIR</p>
                    <h2>Skuad pemain Persela</h2>
                </div>
                <span class="status-pill">DATA PEMAIN</span>
            </div>

            <div class="roster-list">
                @foreach ($players as $player)
                    <article class="player-row">
                        <span class="player-number">{{ str_pad((string) $player['number'], 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="player-info">
                            <strong>{{ $player['name'] }}</strong>
                            <span>{{ $player['position'] }}</span>
                        </div>
                        <span class="player-status {{ $player['status'] === 'Pemulihan' ? 'is-recovering' : '' }}">
                            <span></span>{{ $player['status'] }}
                        </span>
                    </article>
                @endforeach
            </div>
            <p class="form-hint">Daftar nama dan status ini merupakan data contoh untuk demonstrasi array di Controller.</p>
        </section>
    </div>
@endsection
