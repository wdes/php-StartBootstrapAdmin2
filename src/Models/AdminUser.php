<?php

declare(strict_types = 1);

namespace WdesAdmin\Models;

use WdesAdmin\AbstractModel;

class AdminUser extends AbstractModel
{
    /**
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * {@inheritDoc}
     */
    protected $primaryKey = 'username';

    public static function create(
        string $username,
        ?string $firstName,
        ?string $lastName,
        string $password
    ): self {
        $instance = new static();
        $instance->setData(
            [
                'username' => $username,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => $password
            ]
        );

        return $instance;
    }

    public static function findByUsername(
        string $username
    ): ?self {
        return parent::findWhere(
            [
                'username' => $username,
            ]
        );
    }

    public function getUsername(): string
    {
        return $this->data['username'];
    }

    public function getFirstName(): ?string
    {
        return $this->data['first_name'];
    }

    public function getLastName(): ?string
    {
        return $this->data['last_name'];
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

}
