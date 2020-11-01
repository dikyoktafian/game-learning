<?php

namespace App\Repositories;

use App\Models\MemberTask;
use App\Repositories\BaseRepository;

/**
 * Class MemberTaskRepository
 * @package App\Repositories
 * @version September 16, 2020, 12:19 am UTC
*/

class MemberTaskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'task_id',
        'status'
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
        return MemberTask::class;
    }
}
