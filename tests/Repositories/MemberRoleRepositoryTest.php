<?php namespace Tests\Repositories;

use App\Models\MemberRole;
use App\Repositories\MemberRoleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MemberRoleRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MemberRoleRepository
     */
    protected $memberRoleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->memberRoleRepo = \App::make(MemberRoleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_member_role()
    {
        $memberRole = factory(MemberRole::class)->make()->toArray();

        $createdMemberRole = $this->memberRoleRepo->create($memberRole);

        $createdMemberRole = $createdMemberRole->toArray();
        $this->assertArrayHasKey('id', $createdMemberRole);
        $this->assertNotNull($createdMemberRole['id'], 'Created MemberRole must have id specified');
        $this->assertNotNull(MemberRole::find($createdMemberRole['id']), 'MemberRole with given id must be in DB');
        $this->assertModelData($memberRole, $createdMemberRole);
    }

    /**
     * @test read
     */
    public function test_read_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();

        $dbMemberRole = $this->memberRoleRepo->find($memberRole->id);

        $dbMemberRole = $dbMemberRole->toArray();
        $this->assertModelData($memberRole->toArray(), $dbMemberRole);
    }

    /**
     * @test update
     */
    public function test_update_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();
        $fakeMemberRole = factory(MemberRole::class)->make()->toArray();

        $updatedMemberRole = $this->memberRoleRepo->update($fakeMemberRole, $memberRole->id);

        $this->assertModelData($fakeMemberRole, $updatedMemberRole->toArray());
        $dbMemberRole = $this->memberRoleRepo->find($memberRole->id);
        $this->assertModelData($fakeMemberRole, $dbMemberRole->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_member_role()
    {
        $memberRole = factory(MemberRole::class)->create();

        $resp = $this->memberRoleRepo->delete($memberRole->id);

        $this->assertTrue($resp);
        $this->assertNull(MemberRole::find($memberRole->id), 'MemberRole should not exist in DB');
    }
}
