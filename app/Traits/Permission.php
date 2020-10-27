<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait Permission{
    public abstract function permissions(): array;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        foreach($this->permissions() as $permission){
            DB::table($tableNames['permissions'])->insert([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        DB::table($tableNames['permissions'])->whereIn('name', $this->permissions())->delete();
    }
}