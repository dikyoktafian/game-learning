<?php namespace Tests\Repositories;

use App\Models\MemberPoint;
use App\Repositories\MemberPointRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MemberPointRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MemberPointRepository
     */
    protected $memberPointRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->memberPointRepo = \App::make(MemberPointRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->make()->toArray();

        $createdMemberPoint = $this->memberPointRepo->create($memberPoint);

        $createdMemberPoint = $createdMemberPoint->toArray();
        $this->assertArrayHasKey('id', $createdMemberPoint);
        $this->assertNotNull($createdMemberPoint['id'], 'Created MemberPoint must have id specified');
        $this->assertNotNull(MemberPoint::find($createdMemberPoint['id']), 'MemberPoint with given id must be in DB');
        $this->assertModelData($memberPoint, $createdMemberPoint);
    }

    /**
     * @test read
     */
    public function test_read_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();

        $dbMemberPoint = $this->memberPointRepo->find($memberPoint->id);

        $dbMemberPoint = $dbMemberPoint->toArray();
        $this->assertModelData($memberPoint->toArray(), $dbMemberPoint);
    }

    /**
     * @test update
     */
    public function test_update_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();
        $fakeMemberPoint = factory(MemberPoint::class)->make()->toArray();

        $updatedMemberPoint = $this->memberPointRepo->update($fakeMemberPoint, $memberPoint->id);

        $this->assertModelData($fakeMemberPoint, $updatedMemberPoint->toArray());
        $dbMemberPoint = $this->memberPointRepo->find($memberPoint->id);
        $this->assertModelData($fakeMemberPoint, $dbMemberPoint->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_member_point()
    {
        $memberPoint = factory(MemberPoint::class)->create();

        $resp = $this->memberPointRepo->delete($memberPoint->id);

        $this->assertTrue($resp);
        $this->assertNull(MemberPoint::find($memberPoint->id), 'MemberPoint should not exist in DB');
    }
}
