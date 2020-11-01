<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TaskAnswer;

class TaskAnswerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/task_answers', $taskAnswer
        );

        $this->assertApiResponse($taskAnswer);
    }

    /**
     * @test
     */
    public function test_read_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/task_answers/'.$taskAnswer->id
        );

        $this->assertApiResponse($taskAnswer->toArray());
    }

    /**
     * @test
     */
    public function test_update_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();
        $editedTaskAnswer = factory(TaskAnswer::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/task_answers/'.$taskAnswer->id,
            $editedTaskAnswer
        );

        $this->assertApiResponse($editedTaskAnswer);
    }

    /**
     * @test
     */
    public function test_delete_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/task_answers/'.$taskAnswer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/task_answers/'.$taskAnswer->id
        );

        $this->response->assertStatus(404);
    }
}
