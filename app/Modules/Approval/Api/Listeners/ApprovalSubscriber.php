<?php

namespace App\Modules\Approval\Api\Listeners;


use App\Modules\Approval\Infrastructure\Persistence\Command\SetApproveStatusForAnEntity;
use App\Modules\Approval\Infrastructure\Persistence\Command\SetRejectStatusForAnEntity;
use App\Modules\Approval\Infrastructure\Persistence\Repositories\ApprovalWriteRepository;

class ApprovalSubscriber
{

    public function __construct(
        private ApprovalWriteRepository $repository,
    )
    {
    }

    public function handleApprove($event): void
    {
        $approvalRepository = new SetApproveStatusForAnEntity($this->repository, $event->approvalDto);
        $approvalRepository->execute();
    }

    public function handleReject($event): void
    {
        $approvalRepository = new SetRejectStatusForAnEntity($this->repository, $event->approvalDto);
        $approvalRepository->execute();
    }
}
