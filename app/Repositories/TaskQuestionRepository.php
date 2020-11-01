<?php

namespace App\Repositories;

use App\Models\TaskQuestion;
use App\Repositories\BaseRepository;

/**
 * Class TaskQuestionRepository
 * @package App\Repositories
 * @version September 6, 2020, 11:54 pm UTC
*/

class TaskQuestionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'task_id',
        'image',
        'attach',
        'question'
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
        return TaskQuestion::class;
    }
}
