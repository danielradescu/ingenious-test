<?php

namespace App\Modules\Approval\Infrastructure\Persistence\Repositories;

use App\Domain\Enums\StatusEnum;
use App\Infrastructure\Persistence\QueryRepository;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\UuidInterface;

class ApprovalReadRepository extends QueryRepository
{
    public function getEntityStatus(UuidInterface $id, string $entity): StatusEnum
    {
        return StatusEnum::tryFrom(DB::table($entity)->find($id)->status);
    }
}
