<?php

namespace App\Services;

use App\Models\Locker;

class ScriptService
{
    /**
     * Executes a python script that physically opens the specified locker.
     *
     * @param Locker $locker
     * @return void
     */
    public static function openLocker(Locker $locker): void
    {
        $result_code = null;
        $result = [];
        // TODO: For presentation purposes, the locker id is static.
        exec("python3 /var/scripts/opendoor.py " . escapeshellarg('1'), $result, $result_code );
    }
}
