<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    /** @use HasFactory<\Database\Factories\LockerFactory> */
    use HasFactory;

    public function getDesignation(): string
    {
        return $this->getAttribute('designation');
    }

    public function setDesignation(string $designation): Locker
    {
        $this->setAttribute('designation', $designation);
        return $this;
    }
}
