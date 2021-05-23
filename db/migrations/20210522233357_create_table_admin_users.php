<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTableAdminUsers extends AbstractMigration
{

    public function up(): void
    {
        $table = $this->table(
            'admin_users',
            [
                'id' => false,
                'primary_key' => ['username'],
                'comment' => 'The admin users',
            ]
        );

        $table
            ->addColumn(
                'username',
                'string',
                [
                    'comment' => 'The username',
                    'limit' => 255,
                ]
            )
            ->addColumn(
                'password',
                'string',
                [
                    'comment' => 'The password',
                    'limit' => 255,
                ]
            )
            ->addColumn(
                'first_name',
                'string',
                [
                    'comment' => 'The first name',
                    'limit' => 255,
                    'null' => true,
                ]
            )
            ->addColumn(
                'last_name',
                'string',
                [
                    'comment' => 'The last name',
                    'limit' => 255,
                    'null' => true,
                ]
            )
            ->addColumn(
                'created_at',
                'timestamp',
                [
                    'comment' => 'The user creation timestamp',
                    'update' => null,
                    'default' => 'CURRENT_TIMESTAMP',
                    'null' => true,// Seems that without null it decides to use default values
                ]
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                [
                    'comment' => 'The user update timestamp',
                    'update' => 'CURRENT_TIMESTAMP',
                    'default' => null,
                    'null' => true,// Seems that without null it decides to use default values
                ]
            )
            ->create();
    }

    public function down(): void
    {
        $this->table('admin_users')->drop()->save();
    }
}
