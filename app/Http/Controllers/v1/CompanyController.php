<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\BaseController;
use App\Models\Company;

class CompanyController extends BaseController
{
    public function show(Company $company)
    {
        return $company->users()->get();
    }
}
