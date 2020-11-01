<?php namespace Tests\Repositories;

use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SubjectRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SubjectRepository
     */
    protected $subjectRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->subjectRepo = \App::make(SubjectRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_subject()
    {
        $subject = factory(Subject::class)->make()->toArray();

        $createdSubject = $this->subjectRepo->create($subject);

        $createdSubject = $createdSubject->toArray();
        $this->assertArrayHasKey('id', $createdSubject);
        $this->assertNotNull($createdSubject['id'], 'Created Subject must have id specified');
        $this->assertNotNull(Subject::find($createdSubject['id']), 'Subject with given id must be in DB');
        $this->assertModelData($subject, $createdSubject);
    }

    /**
     * @test read
     */
    public function test_read_subject()
    {
        $subject = factory(Subject::class)->create();

        $dbSubject = $this->subjectRepo->find($subject->id);

        $dbSubject = $dbSubject->toArray();
        $this->assertModelData($subject->toArray(), $dbSubject);
    }

    /**
     * @test update
     */
    public function test_update_subject()
    {
        $subject = factory(Subject::class)->create();
        $fakeSubject = factory(Subject::class)->make()->toArray();

        $updatedSubject = $this->subjectRepo->update($fakeSubject, $subject->id);

        $this->assertModelData($fakeSubject, $updatedSubject->toArray());
        $dbSubject = $this->subjectRepo->find($subject->id);
        $this->assertModelData($fakeSubject, $dbSubject->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_subject()
    {
        $subject = factory(Subject::class)->create();

        $resp = $this->subjectRepo->delete($subject->id);

        $this->assertTrue($resp);
        $this->assertNull(Subject::find($subject->id), 'Subject should not exist in DB');
    }
}
