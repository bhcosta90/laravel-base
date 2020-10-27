<?php

namespace App\Http\Controllers\Api\Admin;

use App\Forms\CompanyForm;
use App\Http\Controllers\Controller;
use BRCas\Package\Traits\Controller\Api\Create;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use Create;

    public function form()
    {
        return CompanyForm::class;
    }
}
