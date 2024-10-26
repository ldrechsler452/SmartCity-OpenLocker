<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): User
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->getAttribute('email_verified_at');
    }

    public function setEmailVerifiedAt(?Carbon $email_verified_at): User
    {
        $this->setAttribute('email_verified_at', $email_verified_at);
        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->getAttribute('is_admin');
    }

    public function grantAdmin(): User
    {
        $this->setAttribute('is_admin', true);
        return $this;
    }

    public function revokeAdmin(): User
    {
        $this->setAttribute('is_admin', false);
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
