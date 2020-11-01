<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Task;

class TaskApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_task()
    {
        $task = factory(Task::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/tasks', $task
        );

        $this->assertApiResponse($task);
    }

    /**
     * @test
     */
    public function test_read_task()
    {
        $task = factory(Task::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/tasks/'.$task->id
        );

        $this->assertApiResponse($task->toArray());
    }

    /**
     * @test
     */
    public function test_update_task()
    {
        $task = factory(Task::class)->create();
        $editedTask = factory(Task::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/tasks/'.$task->id,
            $editedTask
        );

        $this->assertApiResponse($editedTask);
    }

    /**
     * @test
     */
    public function test_delete_task()
    {
        $task = factory(Task::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/tasks/'.$task->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/tasks/'.$task->id
        );

        $this->response->assertStatus(404);
    }
}
