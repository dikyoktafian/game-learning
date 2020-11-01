<?php

namespace App\Repositories;

use App\Models\MemberAnswer;
use App\Repositories\BaseRepository;

/**
 * Class MemberAnswerRepository
 * @package App\Repositories
 * @version September 6, 2020, 11:57 pm UTC
*/

class MemberAnswerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'task_id',
        'question_id',
        'answer_id'
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
        return MemberAnswer::class;
    }
}
