<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MemberRole;

class MemberRoleApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member_role()
    {
        $memberRole = factory(MemberRole::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/member_roles', $memberRole
        );

        $this->assertApiResponse($memberRole);
    }

    /**
     * @test
     */
    public function test_read_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/member_roles/'.$memberRole->id
        );

        $this->assertApiResponse($memberRole->toArray());
    }

    /**
     * @test
     */
    public function test_update_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();
        $editedMemberRole = factory(MemberRole::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/member_roles/'.$memberRole->id,
            $editedMemberRole
        );

        $this->assertApiResponse($editedMemberRole);
    }

    /**
     * @test
     */
    public function test_delete_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/member_roles/'.$memberRole->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/member_roles/'.$memberRole->id
        );

        $this->response->assertStatus(404);
    }
}
