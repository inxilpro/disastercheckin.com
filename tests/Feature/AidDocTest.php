<?php

use function Pest\Laravel\get;

describe('aid documents', function () {
    it('shows the aid doc', function () {
        $response = get(route('docs'));

        $response->assertStatus(200);
    });

    it('shows the aid doc in html', function () {
        $response = get(route('docs', ['format' => 'html']));

        $response->assertStatus(200);
    });

    it('shows the aid doc in txt', function () {
        $response = get(route('docs', ['format' => 'txt']));

        $response->assertStatus(200);
    });

    it('shows the aid doc in rtf', function () {
        $response = get(route('docs', ['format' => 'rtf']));

        $response->assertStatus(200);
    });

    it('shows the aid doc in markdown', function () {
        $response = get(route('docs', ['format' => 'md']));

        $response->assertStatus(200);
    });
});
