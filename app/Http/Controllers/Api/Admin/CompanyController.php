<?php

namespace App\Http\Controllers\Api\Admin;

use App\Forms\CompanyForm;
use App\Http\Controllers\Controller;
use App\Services\CompanyService;
use BRCas\Package\Traits\Controller\Api\Store;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use Store;

    public function messageRegister()
    {
        return __('Company registered with sucessfully');
    }

    public function form()
    {
        return CompanyForm::class;
    }

    public function service()
    {
        return CompanyService::class;
    }
}
