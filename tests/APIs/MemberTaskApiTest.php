<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MemberTask;

class MemberTaskApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member_task()
    {
        $memberTask = factory(MemberTask::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/member_tasks', $memberTask
        );

        $this->assertApiResponse($memberTask);
    }

    /**
     * @test
     */
    public function test_read_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/member_tasks/'.$memberTask->id
        );

        $this->assertApiResponse($memberTask->toArray());
    }

    /**
     * @test
     */
    public function test_update_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();
        $editedMemberTask = factory(MemberTask::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/member_tasks/'.$memberTask->id,
            $editedMemberTask
        );

        $this->assertApiResponse($editedMemberTask);
    }

    /**
     * @test
     */
    public function test_delete_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/member_tasks/'.$memberTask->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/member_tasks/'.$memberTask->id
        );

        $this->response->assertStatus(404);
    }
}
