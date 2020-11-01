<?php namespace Tests\Repositories;

use App\Models\MemberAnswer;
use App\Repositories\MemberAnswerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MemberAnswerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MemberAnswerRepository
     */
    protected $memberAnswerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->memberAnswerRepo = \App::make(MemberAnswerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->make()->toArray();

        $createdMemberAnswer = $this->memberAnswerRepo->create($memberAnswer);

        $createdMemberAnswer = $createdMemberAnswer->toArray();
        $this->assertArrayHasKey('id', $createdMemberAnswer);
        $this->assertNotNull($createdMemberAnswer['id'], 'Created MemberAnswer must have id specified');
        $this->assertNotNull(MemberAnswer::find($createdMemberAnswer['id']), 'MemberAnswer with given id must be in DB');
        $this->assertModelData($memberAnswer, $createdMemberAnswer);
    }

    /**
     * @test read
     */
    public function test_read_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();

        $dbMemberAnswer = $this->memberAnswerRepo->find($memberAnswer->id);

        $dbMemberAnswer = $dbMemberAnswer->toArray();
        $this->assertModelData($memberAnswer->toArray(), $dbMemberAnswer);
    }

    /**
     * @test update
     */
    public function test_update_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();
        $fakeMemberAnswer = factory(MemberAnswer::class)->make()->toArray();

        $updatedMemberAnswer = $this->memberAnswerRepo->update($fakeMemberAnswer, $memberAnswer->id);

        $this->assertModelData($fakeMemberAnswer, $updatedMemberAnswer->toArray());
        $dbMemberAnswer = $this->memberAnswerRepo->find($memberAnswer->id);
        $this->assertModelData($fakeMemberAnswer, $dbMemberAnswer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_member_answer()
    {
        $memberAnswer = factory(MemberAnswer::class)->create();

        $resp = $this->memberAnswerRepo->delete($memberAnswer->id);

        $this->assertTrue($resp);
        $this->assertNull(MemberAnswer::find($memberAnswer->id), 'MemberAnswer should not exist in DB');
    }
}
