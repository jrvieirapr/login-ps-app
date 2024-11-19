<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_um_evento()
    {
        // Preparação
        $dados = [
            'name' => 'Evento de Teste',
            'date' => now()->addDays(10),
            'location' => 'Local de Teste',
            'description' => 'Descrição de Teste',
        ];

        // Ação
        $resposta = $this->post(route('events.store'), $dados);

        // Verificação
        $resposta->assertRedirect(route('events.index'));
        $resposta->assertSessionHas('success', 'Evento criado com sucesso!');
        $this->assertDatabaseHas('events', $dados);
    }

    /** @test */
    public function pode_listar_eventos()
    {
        // Preparação
        $eventos = Event::factory()->count(3)->create();

        // Ação
        $resposta = $this->get(route('events.index'));

        // Verificação
        $resposta->assertStatus(200);
        $resposta->assertViewIs('events.index');
        $resposta->assertViewHas('events', function ($eventosView) use ($eventos) {
            return $eventosView->count() === $eventos->count();
        });
    }

    /** @test */
    public function pode_atualizar_um_evento()
    {
        // Preparação
        $evento = Event::factory()->create();
        $dadosAtualizados = [
            'name' => 'Evento Atualizado',
            'date' => now()->addDays(15),
            'location' => 'Local Atualizado',
            'description' => 'Descrição Atualizada',
        ];

        // Ação
        $resposta = $this->put(route('events.update', $evento), $dadosAtualizados);

        // Verificação
        $resposta->assertRedirect(route('events.index'));
        $resposta->assertSessionHas('success', 'Evento atualizado com sucesso!');
        $this->assertDatabaseHas('events', $dadosAtualizados);
    }

    /** @test */
    public function pode_excluir_um_evento()
    {
        // Preparação
        $evento = Event::factory()->create();

        // Ação
        $resposta = $this->delete(route('events.destroy', $evento));

        // Verificação
        $resposta->assertRedirect(route('events.index'));
        $resposta->assertSessionHas('success', 'Evento excluído com sucesso!');
        $this->assertDatabaseMissing('events', ['id' => $evento->id]);
    }
}
