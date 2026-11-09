<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PageController extends Controller
{
    public function login(): View
    {
        return view('login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:40'],
            'password' => ['required', 'string', 'max:100'],
        ]);

        $usernameMatches = hash_equals(
            (string) config('services.demo_player.username'),
            $validated['username'],
        );
        $passwordMatches = Hash::check(
            $validated['password'],
            (string) config('services.demo_player.password_hash'),
        );

        if (! $usernameMatches || ! $passwordMatches) {
            return back()
                ->withErrors(['credentials' => 'Username atau password tidak sesuai.'])
                ->onlyInput('username');
        }

        $request->session()->regenerate();
        $request->session()->put('player_username', $validated['username']);

        return redirect()->route('dashboard', ['username' => $validated['username']]);
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        $username = $this->usernameOrRedirect($request);

        if ($username instanceof RedirectResponse) {
            return $username;
        }

        return view('dashboard', [
            'username' => $username,
            'player' => $this->playerDetails(),
            'stats' => [
                ['label' => 'Nomor punggung', 'value' => '10', 'detail' => 'Penyerang'],
                ['label' => 'Gol', 'value' => '8', 'detail' => 'Musim ini · demo'],
                ['label' => 'Assist', 'value' => '4', 'detail' => 'Musim ini · demo'],
            ],
            'schedule' => [
                'activity' => 'Latihan taktik',
                'date' => 'Jadwal latihan tim',
                'time' => 'Lapangan Surajaya',
                'venue' => 'Persela Lamongan',
            ],
        ]);
    }

    public function pengelolaan(Request $request): View|RedirectResponse
    {
        $username = $this->usernameOrRedirect($request);

        if ($username instanceof RedirectResponse) {
            return $username;
        }

        return view('pengelolaan', [
            'username' => $username,
            'players' => [
                ['number' => 21, 'name' => 'Ernando Ari Sutaryadi', 'position' => 'Penjaga gawang', 'status' => 'Siap bermain'],
                ['number' => 12, 'name' => 'Pratama Arhan Alif Rifai', 'position' => 'Bek sayap kiri', 'status' => 'Siap bermain'],
                ['number' => 5, 'name' => 'Rizky Ridho Ramadhani', 'position' => 'Bek tengah', 'status' => 'Pemulihan'],
                ['number' => 7, 'name' => 'Marselino Ferdinan', 'position' => 'Gelandang', 'status' => 'Siap bermain'],
                ['number' => 18, 'name' => 'Marc Klok', 'position' => 'Gelandang', 'status' => 'Siap bermain'],
                ['number' => 9, 'name' => 'Ragnar Oratmangoen', 'position' => 'Penyerang', 'status' => 'Siap bermain'],
                ['number' => 4, 'name' => 'Jay Idjes', 'position' => 'Bek tengah', 'status' => 'Siap bermain'],
                ['number' => 3, 'name' => 'Justin Hubner', 'position' => 'bek tengah', 'status' => 'Siap bermain'],
                ['number' => 2, 'name' => 'Kevin Diks', 'position' => 'Bek sayap kanan', 'status' => 'Siap bermain'],
                ['number' => 6, 'name' => 'Sandy Walsh', 'position' => 'Bek sayap kanan', 'status' => 'Siap bermain'],
                ['number' => 17, 'name' => 'Egy Maulana Vikri', 'position' => 'Gelandang', 'status' => 'Siap bermain'],
                ['number' => 8, 'name' => 'Elkan Baggot', 'position' => 'Bek Tengah', 'status' => 'Siap bermain'],
                ['number' => 10, 'name' => 'Ole Romenny', 'position' => 'Penyerang', 'status' => 'Siap bermain'],
                ['number' => 18, 'name' => 'Witan Sulaiman', 'position' => 'Sayap kanan', 'status' => 'Siap bermain'],
                ['number' => 11, 'name' => 'Rafael Struck', 'position' => 'Sayap kiri', 'status' => 'Siap bermain'],
            ],
        ]);
    }

    public function profile(Request $request): View|RedirectResponse
    {
        $username = $this->usernameOrRedirect($request);

        if ($username instanceof RedirectResponse) {
            return $username;
        }

        return view('profile', [
            'username' => $username,
            'player' => $this->playerDetails(),
            'team' => 'Persela Lamongan',
        ]);
    }

    private function playerDetails(): array
    {
        return [
            'name' => 'Rizki Ridho Ramadhani',
            'number' => 5,
            'position' => 'Bek tengah',
            'nationality' => 'Indonesia',
        ];
    }

    private function usernameOrRedirect(Request $request): string|RedirectResponse
    {
        $username = $request->query('username');
        $authenticatedUsername = $request->session()->get('player_username');
        $configuredUsername = config('services.demo_player.username');

        if (
            ! is_string($username)
            || trim($username) === ''
            || Str::length($username) > 40
            || ! is_string($authenticatedUsername)
            || ! is_string($configuredUsername)
            || ! hash_equals($configuredUsername, $authenticatedUsername)
            || ! hash_equals($authenticatedUsername, $username)
        ) {
            return redirect()->route('login');
        }

        return trim($username);
    }
}
