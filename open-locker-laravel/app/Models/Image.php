<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Uid\UuidV4;

class Image extends Model
{
    const IMAGE_DIRECTORY = '/var/www/html/storage/images';

    /** @use HasFactory<\Database\Factories\ImageFactory> */
    use HasFactory;

    public function store(string $originalName): Image
    {
        $uuid = Uuid::uuid4()->toString();
        $this->setAttribute('uuid', $uuid);
        $this->setAttribute(
            key: 'file_path',
            value: self::IMAGE_DIRECTORY . '/' . $uuid
        );
        $this->setAttribute('original_name', $originalName);

        // TODO: Store file

        return $this;
    }

    public function remove(): void
    {
        // TODO: Delete file from storage

        $this->delete();
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getFilePath(): string
    {
        return $this->getAttribute('file_path');
    }

    public function getUuid(): string
    {
        return $this->getAttribute('uuid');
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
