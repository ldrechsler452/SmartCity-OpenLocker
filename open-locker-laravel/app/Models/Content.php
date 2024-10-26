<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Content extends Model
{
    /** @use HasFactory<\Database\Factories\ContentFactory> */
    use HasFactory;

    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->getAttribute('user');
    }

    public function setUser(?User $user): Content
    {
        $this->setAttribute('user_id', $user->getId());
        return $this;
    }

    public function locker(): HasOne
    {
        return $this->hasOne(Locker::class);
    }

    public function getLocker(): Locker
    {
        return $this->getAttribute('locker');
    }

    // Attributes

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): Content
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    public function getTakenAt(): ?Carbon
    {
        return $this->getAttribute('taken_at');
    }

    public function setTakenAt(?Carbon $takenAt): Content
    {
        $this->setAttribute('taken_at', $takenAt);
        return $this;
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
