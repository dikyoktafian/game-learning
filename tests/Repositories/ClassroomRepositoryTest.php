<?php namespace Tests\Repositories;

use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ClassroomRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassroomRepository
     */
    protected $classroomRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classroomRepo = \App::make(ClassroomRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_classroom()
    {
        $classroom = factory(Classroom::class)->make()->toArray();

        $createdClassroom = $this->classroomRepo->create($classroom);

        $createdClassroom = $createdClassroom->toArray();
        $this->assertArrayHasKey('id', $createdClassroom);
        $this->assertNotNull($createdClassroom['id'], 'Created Classroom must have id specified');
        $this->assertNotNull(Classroom::find($createdClassroom['id']), 'Classroom with given id must be in DB');
        $this->assertModelData($classroom, $createdClassroom);
    }

    /**
     * @test read
     */
    public function test_read_classroom()
    {
        $classroom = factory(Classroom::class)->create();

        $dbClassroom = $this->classroomRepo->find($classroom->id);

        $dbClassroom = $dbClassroom->toArray();
        $this->assertModelData($classroom->toArray(), $dbClassroom);
    }

    /**
     * @test update
     */
    public function test_update_classroom()
    {
        $classroom = factory(Classroom::class)->create();
        $fakeClassroom = factory(Classroom::class)->make()->toArray();

        $updatedClassroom = $this->classroomRepo->update($fakeClassroom, $classroom->id);

        $this->assertModelData($fakeClassroom, $updatedClassroom->toArray());
        $dbClassroom = $this->classroomRepo->find($classroom->id);
        $this->assertModelData($fakeClassroom, $dbClassroom->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_classroom()
    {
        $classroom = factory(Classroom::class)->create();

        $resp = $this->classroomRepo->delete($classroom->id);

        $this->assertTrue($resp);
        $this->assertNull(Classroom::find($classroom->id), 'Classroom should not exist in DB');
    }
}
