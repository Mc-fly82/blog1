<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * @test
     * @group TodosTest
     */
    public function peut_create_un_todo_de_la_page_acceuil()
    {
        $this->postJson('todos/create', [
            "tache" => "aller a l'ecole",
        ])->assertStatus(302);

        $this->assertDatabaseCount('todos', 1);
        $this->assertDatabaseHas('todos', [
            "tache" => "aller a l'ecole",
        ]);

    }

    /**
     * @test
     * @group TodosTest
     */
    public function peut_mettre_a_jour_un_todo()
    {

        $todo = Todo::factory([
            "tache" => "aller au marche",
        ])->create();

        $this->postJson('todos/update', [
            "tache" => "aller a l'ecole",
            "id" => $todo->id,
        ])->assertStatus(200);

        $this->assertDatabaseCount('todos', 1);
        $this->assertDatabaseHas('todos', [
            "tache" => "aller a l'ecole",
        ]);
    }

    /**
     * @test
     * @group TodosTest
     */
    public function peut_supprimer_un_todo()
    {

        $todo = Todo::factory([
            "tache" => "aller au marche",
        ])
                    ->create();

        $this->postJson('todos/delete', [
            "id" => $todo->id,
        ])
             ->assertStatus(200);

        $this->assertDatabaseCount('todos', 0);
    }
}
