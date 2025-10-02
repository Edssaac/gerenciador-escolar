<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Registration extends AbstractMigration
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
        if ($this->hasTable("registration")) {
            return;
        }

        $this->table("registration", ["id" => false, "primary_key" => "id"])
            ->addColumn("id", "integer", ["identity" => true])
            ->addColumn("id_student", "integer")
            ->addColumn("id_class", "integer")
            ->addColumn("registration_date", "date")
            ->addForeignKey("id_student", "student", "id", ["delete"=> "NO_ACTION", "update"=> "NO_ACTION"])
            ->addForeignKey("id_class", "class", "id", ["delete"=> "NO_ACTION", "update"=> "NO_ACTION"])
            ->create();
    }
}
