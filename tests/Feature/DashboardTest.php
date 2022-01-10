<?php

namespace Tests\Feature;

use App\Models\Country;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
	use RefreshDatabase;

	public function test_dashboard_page_is_rendered_when_user_is_logged_in()
	{
		$user = User::factory()->create();
		$user->email_verified_at = now();
		$response = $this->actingAs($user)->get(route('dashboard', 'en'));

		$response->assertSuccessful();
		$response->assertSee('Worldwide Statistics');
	}

	public function test_unauthorized_user_can_not_see_dashboard_page()
	{
		$response = $this->get(route('dashboard', 'en'));

		$response->assertDontSee('Worldwide Statistics');
		$response->assertRedirect(route('login', 'en'));
	}

	public function test_dashboard_page_renders_correct_covid_numebrs()
	{
		$user = User::factory()->create();

		$countryOne = Country::create([
			'name'           => 'Georgia',
			'countryCode'    => 'GE',
			'confirmed'      => 99,
			'recovered'      => 198,
			'critical'       => 297,
			'deaths'         => 396,
		]);

		$countryTwo = Country::create([
			'name'           => 'Armenia',
			'countryCode'    => 'AM',
			'confirmed'      => 1,
			'recovered'      => 2,
			'critical'       => 3,
			'deaths'         => 4,
		]);

		$user->email_verified_at = now();

		$response = $this->actingAs($user)->get(route('dashboard', 'en'));

		$response->assertSuccessful();
		$response->assertSee(100);
		$response->assertSee(200);
		$response->assertSee(300);
		$response->assertSee(400);
	}
}
