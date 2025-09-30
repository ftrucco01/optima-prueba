<?php

namespace App\Http\Controllers\Api\Company;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CreateCompanyRequest;
use OptimaCultura\Company\Application\CompanyCreator;

class PostCreateCompanyController extends Controller
{
    /**
     * Create new company
     */
    public function __invoke(CreateCompanyRequest $request, CompanyCreator $service)
    {
        DB::beginTransaction();
        try {
            $company = $service->handle(Str::uuid(), $request->name);
            DB::commit();
            return response($company, 201);
        } catch (\Throwable $error) {
            DB::rollback();
            throw $error;
        }
    }
}
