<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MemberPoint;

class MemberPointApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/member_points', $memberPoint
        );

        $this->assertApiResponse($memberPoint);
    }

    /**
     * @test
     */
    public function test_read_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/member_points/'.$memberPoint->id
        );

        $this->assertApiResponse($memberPoint->toArray());
    }

    /**
     * @test
     */
    public function test_update_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();
        $editedMemberPoint = factory(MemberPoint::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/member_points/'.$memberPoint->id,
            $editedMemberPoint
        );

        $this->assertApiResponse($editedMemberPoint);
    }

    /**
     * @test
     */
    public function test_delete_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/member_points/'.$memberPoint->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/member_points/'.$memberPoint->id
        );

        $this->response->assertStatus(404);
    }
}
