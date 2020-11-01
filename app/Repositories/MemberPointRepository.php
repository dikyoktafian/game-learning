<?php

namespace App\Repositories;

use App\Models\MemberPoint;
use App\Repositories\BaseRepository;

/**
 * Class MemberPointRepository
 * @package App\Repositories
 * @version September 19, 2020, 4:20 am UTC
*/

class MemberPointRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'member_id',
        'model_type',
        'model_id',
        'point'
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
        return MemberPoint::class;
    }
}
