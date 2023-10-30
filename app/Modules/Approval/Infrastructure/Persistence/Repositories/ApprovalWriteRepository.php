<?php

namespace App\Modules\Approval\Infrastructure\Persistence\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Persistence\CommandRepository;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Illuminate\Support\Facades\DB;

class ApprovalWriteRepository extends CommandRepository
{
    public function approve(ApprovalDto $approvalDto): int
    {
        return DB::connection($this->getConnection())
            ->table($approvalDto->entity)
            ->where('id', $approvalDto->id)
            ->update(['status' => StatusEnum::APPROVED]);
    }

    public function reject(ApprovalDto $approvalDto): int
    {
        return DB::connection($this->getConnection())
            ->table($approvalDto->entity)
            ->where('id', $approvalDto->id)
            ->update(['status' => StatusEnum::REJECTED]);
    }
}
