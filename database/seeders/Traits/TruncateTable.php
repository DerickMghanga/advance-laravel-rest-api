<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable  // reusable in more than one classes seeders
{
    protected function truncate($table)
    {
        DB::table($table)->truncate();
    }
}
