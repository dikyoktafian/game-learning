<?php namespace Tests\Repositories;

use App\Models\MemberTask;
use App\Repositories\MemberTaskRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MemberTaskRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MemberTaskRepository
     */
    protected $memberTaskRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->memberTaskRepo = \App::make(MemberTaskRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_member_task()
    {
        $memberTask = factory(MemberTask::class)->make()->toArray();

        $createdMemberTask = $this->memberTaskRepo->create($memberTask);

        $createdMemberTask = $createdMemberTask->toArray();
        $this->assertArrayHasKey('id', $createdMemberTask);
        $this->assertNotNull($createdMemberTask['id'], 'Created MemberTask must have id specified');
        $this->assertNotNull(MemberTask::find($createdMemberTask['id']), 'MemberTask with given id must be in DB');
        $this->assertModelData($memberTask, $createdMemberTask);
    }

    /**
     * @test read
     */
    public function test_read_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();

        $dbMemberTask = $this->memberTaskRepo->find($memberTask->id);

        $dbMemberTask = $dbMemberTask->toArray();
        $this->assertModelData($memberTask->toArray(), $dbMemberTask);
    }

    /**
     * @test update
     */
    public function test_update_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();
        $fakeMemberTask = factory(MemberTask::class)->make()->toArray();

        $updatedMemberTask = $this->memberTaskRepo->update($fakeMemberTask, $memberTask->id);

        $this->assertModelData($fakeMemberTask, $updatedMemberTask->toArray());
        $dbMemberTask = $this->memberTaskRepo->find($memberTask->id);
        $this->assertModelData($fakeMemberTask, $dbMemberTask->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_member_task()
    {
        $memberTask = factory(MemberTask::class)->create();

        $resp = $this->memberTaskRepo->delete($memberTask->id);

        $this->assertTrue($resp);
        $this->assertNull(MemberTask::find($memberTask->id), 'MemberTask should not exist in DB');
    }
}
