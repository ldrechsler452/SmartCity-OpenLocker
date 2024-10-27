<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Station extends Model
{
    /** @use HasFactory<\Database\Factories\StationFactory> */
    use HasFactory;

    // Relations

    public function lockers(): HasMany
    {
        return $this->hasMany(Locker::class);
    }

    public function getLockers(): Collection
    {
        return $this->getAttribute('lockers');
    }

    public function image(): HasOne
    {
        return $this->hasOne(Image::class);
    }

    public function getImage(): Image
    {
        return $this->getAttribute('image');
    }

    public function setImage(Image $image): Station
    {
        $this->setAttribute('image_id', $image->getId());
        return $this;
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

    public function setName(string $name): Station
    {
        $this->setAttribute('name', $name);
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

    public function getAddress(): string
    {
        return $this->getAttribute('address');
    }

    public function setAddress(string $address): Station
    {
        $this->setAttribute('address', $address);
        return $this;
    }

    public function getDistance(): float
    {
        return $this->getAttribute('distance');
    }

    public function setDistance(string $distance): Station
    {
        $this->setAttribute('distance', $distance);
        return $this;
    }
}
