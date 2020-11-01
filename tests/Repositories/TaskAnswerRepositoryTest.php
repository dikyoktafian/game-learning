<?php namespace Tests\Repositories;

use App\Models\TaskAnswer;
use App\Repositories\TaskAnswerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TaskAnswerRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TaskAnswerRepository
     */
    protected $taskAnswerRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->taskAnswerRepo = \App::make(TaskAnswerRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->make()->toArray();

        $createdTaskAnswer = $this->taskAnswerRepo->create($taskAnswer);

        $createdTaskAnswer = $createdTaskAnswer->toArray();
        $this->assertArrayHasKey('id', $createdTaskAnswer);
        $this->assertNotNull($createdTaskAnswer['id'], 'Created TaskAnswer must have id specified');
        $this->assertNotNull(TaskAnswer::find($createdTaskAnswer['id']), 'TaskAnswer with given id must be in DB');
        $this->assertModelData($taskAnswer, $createdTaskAnswer);
    }

    /**
     * @test read
     */
    public function test_read_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();

        $dbTaskAnswer = $this->taskAnswerRepo->find($taskAnswer->id);

        $dbTaskAnswer = $dbTaskAnswer->toArray();
        $this->assertModelData($taskAnswer->toArray(), $dbTaskAnswer);
    }

    /**
     * @test update
     */
    public function test_update_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();
        $fakeTaskAnswer = factory(TaskAnswer::class)->make()->toArray();

        $updatedTaskAnswer = $this->taskAnswerRepo->update($fakeTaskAnswer, $taskAnswer->id);

        $this->assertModelData($fakeTaskAnswer, $updatedTaskAnswer->toArray());
        $dbTaskAnswer = $this->taskAnswerRepo->find($taskAnswer->id);
        $this->assertModelData($fakeTaskAnswer, $dbTaskAnswer->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_task_answer()
    {
        $taskAnswer = factory(TaskAnswer::class)->create();

        $resp = $this->taskAnswerRepo->delete($taskAnswer->id);

        $this->assertTrue($resp);
        $this->assertNull(TaskAnswer::find($taskAnswer->id), 'TaskAnswer should not exist in DB');
    }
}
