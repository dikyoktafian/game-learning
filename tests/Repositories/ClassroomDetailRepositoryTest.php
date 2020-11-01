<?php namespace Tests\Repositories;

use App\Models\ClassroomDetail;
use App\Repositories\ClassroomDetailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClassroomDetailRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassroomDetailRepository
     */
    protected $classroomDetailRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classroomDetailRepo = \App::make(ClassroomDetailRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->make()->toArray();

        $createdClassroomDetail = $this->classroomDetailRepo->create($classroomDetail);

        $createdClassroomDetail = $createdClassroomDetail->toArray();
        $this->assertArrayHasKey('id', $createdClassroomDetail);
        $this->assertNotNull($createdClassroomDetail['id'], 'Created ClassroomDetail must have id specified');
        $this->assertNotNull(ClassroomDetail::find($createdClassroomDetail['id']), 'ClassroomDetail with given id must be in DB');
        $this->assertModelData($classroomDetail, $createdClassroomDetail);
    }

    /**
     * @test read
     */
    public function test_read_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();

        $dbClassroomDetail = $this->classroomDetailRepo->find($classroomDetail->id);

        $dbClassroomDetail = $dbClassroomDetail->toArray();
        $this->assertModelData($classroomDetail->toArray(), $dbClassroomDetail);
    }

    /**
     * @test update
     */
    public function test_update_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();
        $fakeClassroomDetail = factory(ClassroomDetail::class)->make()->toArray();

        $updatedClassroomDetail = $this->classroomDetailRepo->update($fakeClassroomDetail, $classroomDetail->id);

        $this->assertModelData($fakeClassroomDetail, $updatedClassroomDetail->toArray());
        $dbClassroomDetail = $this->classroomDetailRepo->find($classroomDetail->id);
        $this->assertModelData($fakeClassroomDetail, $dbClassroomDetail->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_classroom_detail()
    {
        $classroomDetail = factory(ClassroomDetail::class)->create();

        $resp = $this->classroomDetailRepo->delete($classroomDetail->id);

        $this->assertTrue($resp);
        $this->assertNull(ClassroomDetail::find($classroomDetail->id), 'ClassroomDetail should not exist in DB');
    }
}
