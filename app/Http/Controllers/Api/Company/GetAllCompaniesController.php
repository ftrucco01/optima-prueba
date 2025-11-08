<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use OptimaCultura\Company\Application\GetAllCompanies;

class GetAllCompaniesController extends Controller
{
    private GetAllCompanies $service;

    public function __construct(GetAllCompanies $service)
    {
        $this->service = $service;
    }

    public function __invoke(): JsonResponse
    {
        $companies = $this->service->handle();

        return response()->json($companies);
    }
}