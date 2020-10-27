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
    public $fillable = [
        'name',
        'migrated',
        'bd_hostname',
        'bd_database',
        'bd_username',
        'domain',
    ];

    public static function booted()
    {
        static::created(function($obj){
            if(!app()->environment('testing')) app(CompanyService::class)->createDatabase($obj->bd_database);
            Artisan::call('company:migrate', ['--id' => $obj->id]);
        });
    }
}
