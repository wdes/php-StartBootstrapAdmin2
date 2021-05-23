<?php

declare(strict_types = 1);

namespace examples;

use SimplePhpModelSystem\AbstractModel;

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
        string $password
    ): self {
        $instance = new static();
        $instance->setData(
            [
                'username' => $username,
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


}
