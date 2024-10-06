<?php

use App\Models\PhoneNumber;
use App\Events\BarrelDeployed;
use Thunk\Verbs\Facades\Verbs;
use function Pest\Laravel\post;

use function Pest\Laravel\assertDatabaseHas;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    Verbs::commitImmediately();
});

it('creates a Barrel when the event is fired', function () {
    $e = BarrelDeployed::fire(
        code: '12345',
        address_street: '12 Erwin Hills Rd.',
        address_city: 'Asheville',
        address_state: 'NC',
        address_zip: '28806',
    );

    assertDatabaseHas(
        'barrels',
        [
            'id' => $e->barrel_id,
            'code' => '12345',
            'address_street' => '12 Erwin Hills Rd.',
            'address_city' => 'Asheville',
            'address_state' => 'NC',
            'zip' => '28806',
            'refill_requested_at' => null,
            'refill_requested_by' => null,
        ]
    );
});

it('allows requesting a refill via sms', function () {
    $e = BarrelDeployed::fire(
        code: '12345',
        address_street: '12 Erwin Hills Rd.',
        address_city: 'Asheville',
        address_state: 'NC',
        address_zip: '28806',
    );

    $response = post(route('webhooks.twilio'), [
        'From' => '+12024561111',
        'Body' => 'refill: 12345',
    ]);

    $response->assertStatus(200);
    $response->assertSeeHtml('<Response>');
    $response->assertSeeHtml('<Message>');
    $response->assertSee('Your refill request has been passed on to our volunteers! We will text you when your barrel is refilled.');
});
