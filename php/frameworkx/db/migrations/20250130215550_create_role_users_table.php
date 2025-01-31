<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRoleUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('role_users', ['id' => false, 'primary_key' => ['user_id', 'role_id']]);

        $table->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('role_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('created_at', 'timestamp', ['null' => true, 'default' => null])
            ->addColumn('updated_at', 'timestamp', ['null' => true, 'default' => null])
            ->create();
    }
}
