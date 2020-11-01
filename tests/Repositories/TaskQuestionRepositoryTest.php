<?php namespace Tests\Repositories;

use App\Models\TaskQuestion;
use App\Repositories\TaskQuestionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TaskQuestionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TaskQuestionRepository
     */
    protected $taskQuestionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->taskQuestionRepo = \App::make(TaskQuestionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->make()->toArray();

        $createdTaskQuestion = $this->taskQuestionRepo->create($taskQuestion);

        $createdTaskQuestion = $createdTaskQuestion->toArray();
        $this->assertArrayHasKey('id', $createdTaskQuestion);
        $this->assertNotNull($createdTaskQuestion['id'], 'Created TaskQuestion must have id specified');
        $this->assertNotNull(TaskQuestion::find($createdTaskQuestion['id']), 'TaskQuestion with given id must be in DB');
        $this->assertModelData($taskQuestion, $createdTaskQuestion);
    }

    /**
     * @test read
     */
    public function test_read_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();

        $dbTaskQuestion = $this->taskQuestionRepo->find($taskQuestion->id);

        $dbTaskQuestion = $dbTaskQuestion->toArray();
        $this->assertModelData($taskQuestion->toArray(), $dbTaskQuestion);
    }

    /**
     * @test update
     */
    public function test_update_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();
        $fakeTaskQuestion = factory(TaskQuestion::class)->make()->toArray();

        $updatedTaskQuestion = $this->taskQuestionRepo->update($fakeTaskQuestion, $taskQuestion->id);

        $this->assertModelData($fakeTaskQuestion, $updatedTaskQuestion->toArray());
        $dbTaskQuestion = $this->taskQuestionRepo->find($taskQuestion->id);
        $this->assertModelData($fakeTaskQuestion, $dbTaskQuestion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_task_question()
    {
        $taskQuestion = factory(TaskQuestion::class)->create();

        $resp = $this->taskQuestionRepo->delete($taskQuestion->id);

        $this->assertTrue($resp);
        $this->assertNull(TaskQuestion::find($taskQuestion->id), 'TaskQuestion should not exist in DB');
    }
}
