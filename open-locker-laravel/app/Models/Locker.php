<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locker extends Model
{
    /** @use HasFactory<\Database\Factories\LockerFactory> */
    use HasFactory;

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getDesignation(): string
    {
        return $this->getAttribute('designation');
    }

    public function setDesignation(string $designation): Locker
    {
        $this->setAttribute('designation', $designation);
        return $this;
    }

    public function getLastOpenedAt(): Carbon
    {
        return $this->getAttribute('last_opened_at');
    }

    public function IsOpen(): bool
    {
        return $this->getAttribute('is_open');
    }

    public function open(): Locker
    {
        $this->setAttribute('is_open', true);
        return $this;
    }

    public function close(): Locker
    {
        $this->setAttribute('is_open', false);
        return $this;
    }

    public function setLastOpenedAt(Carbon $lastOpenedAt): Locker
    {
        $this->setAttribute('last_opened_at', $lastOpenedAt);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->getAttribute('updated_at');
    }
}
