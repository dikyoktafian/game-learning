<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Classroom;

class ClassroomApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_classroom()
    {
        $classroom = factory(Classroom::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/classrooms', $classroom
        );

        $this->assertApiResponse($classroom);
    }

    /**
     * @test
     */
    public function test_read_classroom()
    {
        $classroom = factory(Classroom::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/classrooms/'.$classroom->id
        );

        $this->assertApiResponse($classroom->toArray());
    }

    /**
     * @test
     */
    public function test_update_classroom()
    {
        $classroom = factory(Classroom::class)->create();
        $editedClassroom = factory(Classroom::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/classrooms/'.$classroom->id,
            $editedClassroom
        );

        $this->assertApiResponse($editedClassroom);
    }

    /**
     * @test
     */
    public function test_delete_classroom()
    {
        $classroom = factory(Classroom::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/classrooms/'.$classroom->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/classrooms/'.$classroom->id
        );

        $this->response->assertStatus(404);
    }
}
