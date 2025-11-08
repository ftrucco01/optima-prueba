<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use OptimaCultura\Company\Application\UpdateCompanyStatus;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;
use App\Http\Requests\Company\UpdateCompanyStatusRequest;

class UpdateCompanyStatusController extends Controller
{
    private UpdateCompanyStatus $updater;

    public function __construct(UpdateCompanyStatus $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, UpdateCompanyStatusRequest $request)
    {
        $companyId = new CompanyId($id);
        $status = CompanyStatus::fromName($request->status);

        $this->updater->handle($companyId, $status);

        return response()->json(['message' => 'Company status updated successfully.']);
    }
}