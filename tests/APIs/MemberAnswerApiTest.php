<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MemberAnswer;

class MemberAnswerApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/member_answers', $memberAnswer
        );

        $this->assertApiResponse($memberAnswer);
    }

    /**
     * @test
     */
    public function test_read_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/member_answers/'.$memberAnswer->id
        );

        $this->assertApiResponse($memberAnswer->toArray());
    }

    /**
     * @test
     */
    public function test_update_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();
        $editedMemberAnswer = factory(MemberAnswer::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/member_answers/'.$memberAnswer->id,
            $editedMemberAnswer
        );

        $this->assertApiResponse($editedMemberAnswer);
    }

    /**
     * @test
     */
    public function test_delete_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/member_answers/'.$memberAnswer->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/member_answers/'.$memberAnswer->id
        );

        $this->response->assertStatus(404);
    }
}
