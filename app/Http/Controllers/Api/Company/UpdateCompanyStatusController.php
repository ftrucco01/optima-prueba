<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OptimaCultura\Company\Application\UpdateCompanyStatus;
use OptimaCultura\Company\Domain\ValueObject\CompanyId;
use OptimaCultura\Company\Domain\ValueObject\CompanyStatus;

class UpdateCompanyStatusController extends Controller
{
    private UpdateCompanyStatus $updater;

    public function __construct(UpdateCompanyStatus $updater)
    {
        $this->updater = $updater;
    }

    public function __invoke(string $id, Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:active,inactive'
        ]);

        $companyId = new CompanyId($id);
        $status = CompanyStatus::fromName($request->input('status'));

        $this->updater->handle($companyId, $status);

        return response()->json(['message' => 'Company status updated successfully.']);
    }
}