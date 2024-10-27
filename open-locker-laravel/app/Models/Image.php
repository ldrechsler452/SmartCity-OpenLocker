<?php

namespace App\Models;

use App\Services\ImageService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Uid\UuidV4;

class Image extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $uuid = Uuid::uuid4()->toString();
        $this->setAttribute('uuid', $uuid);
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getFilePath(): string
    {
        return $this->getAttribute('file_path');
    }

    public function setFilePath(string $filePath): Image
    {
        $this->setAttribute('file_path', $filePath);
        return $this;
    }

    public function getUuid(): string
    {
        return $this->getAttribute('uuid');
    }

    public function getOriginalName(): string
    {
        return $this->getAttribute('original_name');
    }

    public function setOriginalName(string $originalName): Image
    {
        $this->setAttribute('original_name', $originalName);
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
