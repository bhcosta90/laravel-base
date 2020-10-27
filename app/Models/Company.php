<?php

namespace App\Models;

use App\Services\CompanyService;
use BRCas\Package\Traits\Models\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Company extends Model
{
    use HasFactory;

    public $connection = 'central';

    public $fillable = [
        'name',
        'migrated',
        'bd_hostname',
        'bd_database',
        'bd_username',
        'domain',
    ];
}
