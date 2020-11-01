<?php

namespace App\Repositories;

use App\Models\ClassroomDetail;
use App\Repositories\BaseRepository;

/**
 * Class ClassroomDetailRepository
 * @package App\Repositories
 * @version September 13, 2020, 4:24 pm UTC
*/

class ClassroomDetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'classroom_id',
        'member_id'
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
        return ClassroomDetail::class;
    }
}
