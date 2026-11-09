<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk()->assertSee('Masuk portal')->assertSee('Password');
    }

    public function test_valid_player_credentials_pass_username_to_dashboard_and_profile(): void
    {
        $username = 'Rizki Ridho Ramadhani';

        $this->post('/login', ['username' => $username, 'password' => 'RizkiRidho5'])
            ->assertRedirect(route('dashboard', ['username' => $username]));

        $this->get(route('dashboard', ['username' => $username]))
            ->assertOk()
            ->assertSee('Rizki Ridho Ramadhani')
            ->assertSee('Akun: Rizki Ridho Ramadhani');

        $this->get(route('profile', ['username' => $username]))
            ->assertOk()
            ->assertSee('Rizki Ridho Ramadhani')
            ->assertSee('Persela Lamongan');
    }

    public function test_pengelolaan_renders_players_from_controller_data(): void
    {
        $username = 'Rizki Ridho Ramadhani';

        $this->post('/login', ['username' => $username, 'password' => 'RizkiRidho5'])
            ->assertRedirect(route('dashboard', ['username' => $username]));

        $this->get(route('pengelolaan', ['username' => $username]))
            ->assertOk()
            ->assertSee('Ernando Ari Sutaryadi')
            ->assertSee('Rizky Ridho Ramadhani');
    }

    public function test_pages_without_username_redirect_to_login(): void
    {
        $this->get('/dashboard')->assertRedirect(route('login'));
        $this->get('/pengelolaan')->assertRedirect(route('login'));
        $this->get('/profile')->assertRedirect(route('login'));
    }

    public function test_player_pages_reject_a_username_without_a_login_session(): void
    {
        $username = 'Rizki Ridho Ramadhani';

        $this->get(route('dashboard', ['username' => $username]))->assertRedirect(route('login'));
        $this->get(route('profile', ['username' => $username]))->assertRedirect(route('login'));
    }

    public function test_player_pages_reject_a_session_with_an_outdated_username(): void
    {
        config(['services.demo_player.username' => 'Rizki Ridho Ramadhani']);

        $this->withSession(['player_username' => 'Pemain 10'])
            ->get(route('dashboard', ['username' => 'Pemain 10']))
            ->assertRedirect(route('login'));
    }

    public function test_login_requires_username_and_password(): void
    {
        $this->from('/')
            ->post('/login', ['username' => '', 'password' => ''])
            ->assertRedirect('/')
            ->assertSessionHasErrors(['username', 'password']);
    }

    public function test_login_rejects_an_incorrect_player_password(): void
    {
        config([
            'services.demo_player.username' => 'Rizki Ridho Ramadhani',
            'services.demo_player.password_hash' => Hash::make('RizkiRidho5'),
        ]);

        $this->from('/')
            ->post('/login', ['username' => 'Rizki Ridho Ramadhani', 'password' => 'salah'])
            ->assertRedirect('/')
            ->assertSessionHasErrors('credentials');
    }
}
