<?php

namespace App\Modules\Approval\Application\Controllers;

use App\Infrastructure\Controller;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Application\ApprovalService;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class ApproveController extends Controller
{
    public function update(Request $request, ApprovalFacadeInterface $approvalFacade, ApprovalService $approvalService): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $entity = $request->get('entity');

        $approveDTO = new ApprovalDto(
            Uuid::fromString($request->get('id')),
            $approvalService->getEntityStatus(Uuid::fromString($request->get('id')), $entity),
            $entity
        );

        if ($approvalFacade->approve($approveDTO)) {
            return response('Success', 200);
        }

        return response('Cannot change status', 422);
    }
}
