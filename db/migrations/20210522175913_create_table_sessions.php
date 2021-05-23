<?php

declare(strict_types = 1);

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class CreateTableSessions extends AbstractMigration
{

    public function up(): void
    {
        $table = $this->table(
            'sessions',
            [
                'id' => false,
                'primary_key' => ['session_id', 'session_name'],
                'comment' => 'The sessions',
            ]
        );

        $table
            // Example: 3672ed03323a1af19a6ca5079a1e408e
            ->addColumn(
                'session_id',
                'string',
                [
                    'comment' => 'The session Id',
                    'limit' => 32,
                ]
            )
            // Example: admin-1
            ->addColumn(
                'session_name',
                'string',
                [
                    'comment' => 'The session name',
                    'limit' => 255,
                ]
            )
            ->addColumn(
                'created_at',
                'timestamp',
                [
                    'comment' => 'The session creation timestamp',
                    'update' => null,
                    'default' => null,
                    'null' => true,// Seems that without null it decides to use default values
                ]
            )
            ->addColumn(
                'updated_at',
                'timestamp',
                [
                    'comment' => 'The session update timestamp',
                    'update' => null,
                    'default' => null,
                    'null' => true,// Seems that without null it decides to use default values
                ]
            )
            ->addColumn(
                'session_data',
                'text',
                [
                    'comment' => 'The session data',
                    'limit' => MysqlAdapter::TEXT_MEDIUM,
                ]
            )
            ->create();
    }

    public function down(): void
    {
        $this->table('sessions')->drop()->save();
    }

}
