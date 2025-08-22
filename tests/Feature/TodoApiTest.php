<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_lists_todos()
    {
        Todo::factory()->count(3)->create();
        $resp = $this->getJson('/api/todos');
        $resp->assertOk()->assertJsonStructure(['data']);
    }

    /** @test */
    public function it_creates_a_todo()
    {
        $payload = ['title' => 'Acheter du pain', 'description' => 'Boulangerie du coin'];
        $resp = $this->postJson('/api/todos', $payload);
        $resp->assertCreated()->assertJsonFragment(['title' => 'Acheter du pain']);
        $this->assertDatabaseHas('todos', ['title' => 'Acheter du pain']);
    }

    /** @test */
    public function it_updates_a_todo()
    {
        $todo = Todo::factory()->create(['is_done' => false]);
        $resp = $this->putJson("/api/todos/{$todo->id}", ['is_done' => true]);
        $resp->assertOk()->assertJsonFragment(['is_done' => true]);
    }

    /** @test */
    public function it_deletes_a_todo()
    {
        $todo = Todo::factory()->create();
        $resp = $this->deleteJson("/api/todos/{$todo->id}");
        $resp->assertNoContent();
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
