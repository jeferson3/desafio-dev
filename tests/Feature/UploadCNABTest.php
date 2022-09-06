<?php

namespace Tests\Feature;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
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
        // ignorando a validação
        $this->mock(UploadFileRequest::class, function ($mock) {
            $mock->shouldReceive('passes')->andReturn(true);
        });

        $response = $this->post('/', [
            'file' => new UploadedFile(public_path() . '/CNAB.txt', 'CNAB.txt')
        ]
        );
        $response->assertStatus(201);
        $response->assertRedirect('/');
        $response->assertSessionHas('message', 'Success!');
    }

}
