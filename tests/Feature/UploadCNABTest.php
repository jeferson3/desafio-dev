<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UploadCNABTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_retorno_da_view_com_formulario()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeTextInOrder([
            '<form method="post" enctype="multipart/form-data">',
            '<input type="file" class="upload">',
            '</form>'
        ], false);
    }
}
