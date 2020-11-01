<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ClassroomDetail;

class ClassroomDetailApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/classroom_details', $classroomDetail
        );

        $this->assertApiResponse($classroomDetail);
    }

    /**
     * @test
     */
    public function test_read_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/classroom_details/'.$classroomDetail->id
        );

        $this->assertApiResponse($classroomDetail->toArray());
    }

    /**
     * @test
     */
    public function test_update_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();
        $editedClassroomDetail = factory(ClassroomDetail::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/classroom_details/'.$classroomDetail->id,
            $editedClassroomDetail
        );

        $this->assertApiResponse($editedClassroomDetail);
    }

    /**
     * @test
     */
    public function test_delete_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/classroom_details/'.$classroomDetail->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/classroom_details/'.$classroomDetail->id
        );

        $this->response->assertStatus(404);
    }
}
