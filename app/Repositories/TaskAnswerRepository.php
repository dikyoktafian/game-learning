<?php

namespace App\Repositories;

use App\Models\TaskAnswer;
use App\Repositories\BaseRepository;

/**
 * Class TaskAnswerRepository
 * @package App\Repositories
 * @version September 6, 2020, 11:55 pm UTC
*/

class TaskAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'question_id',
        'answer',
        'label'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TaskAnswer::class;
    }
}
