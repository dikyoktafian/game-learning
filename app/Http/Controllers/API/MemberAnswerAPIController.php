<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMemberAnswerAPIRequest;
use App\Http\Requests\API\UpdateMemberAnswerAPIRequest;
use App\Models\MemberAnswer;
use App\Repositories\MemberAnswerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MemberAnswerController
 * @package App\Http\Controllers\API
 */

class MemberAnswerAPIController extends AppBaseController
{
    /** @var  MemberAnswerRepository */
    private $memberAnswerRepository;

    public function __construct(MemberAnswerRepository $memberAnswerRepo)
    {
        $this->memberAnswerRepository = $memberAnswerRepo;
    }

    /**
     * Display a listing of the MemberAnswer.
     * GET|HEAD /memberAnswers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $memberAnswers = $this->memberAnswerRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($memberAnswers->toArray(), 'Member Answers retrieved successfully');
    }

    /**
     * Store a newly created MemberAnswer in storage.
     * POST /memberAnswers
     *
     * @param CreateMemberAnswerAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMemberAnswerAPIRequest $request)
    {
        $input = $request->all();

        $memberAnswer = $this->memberAnswerRepository->create($input);

        return $this->sendResponse($memberAnswer->toArray(), 'Member Answer saved successfully');
    }

    /**
     * Display the specified MemberAnswer.
     * GET|HEAD /memberAnswers/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MemberAnswer $memberAnswer */
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            return $this->sendError('Member Answer not found');
        }

        return $this->sendResponse($memberAnswer->toArray(), 'Member Answer retrieved successfully');
    }

    /**
     * Update the specified MemberAnswer in storage.
     * PUT/PATCH /memberAnswers/{id}
     *
     * @param int $id
     * @param UpdateMemberAnswerAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMemberAnswerAPIRequest $request)
    {
        $input = $request->all();

        /** @var MemberAnswer $memberAnswer */
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            return $this->sendError('Member Answer not found');
        }

        $memberAnswer = $this->memberAnswerRepository->update($input, $id);

        return $this->sendResponse($memberAnswer->toArray(), 'MemberAnswer updated successfully');
    }

    /**
     * Remove the specified MemberAnswer from storage.
     * DELETE /memberAnswers/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MemberAnswer $memberAnswer */
        $memberAnswer = $this->memberAnswerRepository->find($id);

        if (empty($memberAnswer)) {
            return $this->sendError('Member Answer not found');
        }

        $memberAnswer->delete();

        return $this->sendSuccess('Member Answer deleted successfully');
    }
}
