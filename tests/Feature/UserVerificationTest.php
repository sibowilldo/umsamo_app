<?php

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this->user = User::factory()->hasProfile(1)->create();

});

it('redirects to email verify page when user is not verified', function () {
    $this->user->email_verified_at = null;
    $this->user->save();

    $response = $this->actingAs($this->user)->get('/');

    $response->assertStatus(302);
    $response->assertRedirectToRoute('verification.notice');
});

it('redirects to cell number verification page when user cell number is not verified', function(){
    $this->user->profile->cell_number_verified_at = null;
    $this->user->profile->save();

    $response = $this->actingAs($this->user)->get('/');

    $response->assertStatus(302);
    $response->assertRedirectToRoute('auth.cell.verified');
});

it('redirects to dashboard when user is email verified, profile verified and is logged in', function () {
    $this->user->markEmailAsVerified();
    $this->user->profile->update([ 'profile_completed_at' => now(), 'cell_number_verified_at' => now()]);

    $response = $this->actingAs($this->user)->get('/');

    $response->assertOk();
    $response->assertSee('Dashboard');
});

it('redirects to unlock account page when user account is locked', function () {
    $this->user->update(['is_locked' => true]);

    dd($this->user);

    $response = $this->actingAs($this->user)->get('/');

    $response->assertOk();
    $response->assertLocation(route('auth.locked.account'));
    $response->assertSee('Unlock Account');
});
