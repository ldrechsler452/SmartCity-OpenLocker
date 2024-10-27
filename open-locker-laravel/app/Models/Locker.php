<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Cache\Lock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Locker extends Model
{
    /** @use HasFactory<\Database\Factories\LockerFactory> */
    use HasFactory;

    // Relations

    public function station(): BelongsTo
    {
        return $this->belongsTo(Station::class);
    }

    public function getStation(): Station
    {
        return $this->getAttribute('station');
    }

    public function setStation(Station $station): Locker
    {
        $this->setAttribute('station_id', $station->getId());
        return $this;
    }

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function getContent(): ?Content
    {
        return $this->getAttribute('content');
    }

    public function setContent(?Content $content): Locker
    {
        return $this->setAttribute('content_id', $content?->getId());
    }

    // Attributes
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

    public function getLastOpenedAt(): ?Carbon
    {
        return $this->getAttribute('last_opened_at');
    }

    public function setLastOpenedAt(Carbon $lastOpenedAt): Locker
    {
        $this->setAttribute('last_opened_at', $lastOpenedAt);
        return $this;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute('updated_at');
    }
}
