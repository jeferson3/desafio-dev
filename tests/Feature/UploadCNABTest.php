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
        $response->assertViewIs('welcome');
        $response->assertSeeTextInOrder([
            'Formulário Upload',
            'Enviar'
        ]);
    }

    /**
     * @return void
     */
    public function test_envio_arquivo_formulario()
    {
        $response = $this->post('/');

        $response->assertStatus(200);
        $response->assertRedirect('/');
        $response->assertViewHas('message', 'sucesso');
    }

}
