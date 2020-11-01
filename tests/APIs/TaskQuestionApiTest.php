<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TaskQuestion;

class TaskQuestionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/task_questions', $taskQuestion
        );

        $this->assertApiResponse($taskQuestion);
    }

    /**
     * @test
     */
    public function test_read_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/task_questions/'.$taskQuestion->id
        );

        $this->assertApiResponse($taskQuestion->toArray());
    }

    /**
     * @test
     */
    public function test_update_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();
        $editedTaskQuestion = factory(TaskQuestion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/task_questions/'.$taskQuestion->id,
            $editedTaskQuestion
        );

        $this->assertApiResponse($editedTaskQuestion);
    }

    /**
     * @test
     */
    public function test_delete_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/task_questions/'.$taskQuestion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/task_questions/'.$taskQuestion->id
        );

        $this->response->assertStatus(404);
    }
}
