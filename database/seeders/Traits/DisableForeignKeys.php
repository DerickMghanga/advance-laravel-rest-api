<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys  // reusable in more than one class seeders
{
    protected function disableForeignKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }

    protected function enableForeignKeys()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
