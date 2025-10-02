<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class ClassTable extends AbstractMigration
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
        if ($this->hasTable("class")) {
            return;
        }

        $this->table("class", ["id" => false, "primary_key" => "id"])
            ->addColumn("id", "integer", ["identity" => true])
            ->addColumn("description", "string", ["limit" => 250])
            ->addColumn("year", "integer", ["limit" => MysqlAdapter::INT_SMALL])
            ->addColumn("vacancies", "integer", ["limit" => MysqlAdapter::INT_SMALL])
            ->create();
    }
}
