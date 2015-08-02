<?php

use Phinx\Migration\AbstractMigration;

class FieldingStats extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $t = $this->table("matches");
        $t->addColumn("catches", "integer", ["default" => 0])
            ->addColumn("dropped_catches", "integer", ["default" => 0])
            ->addColumn("run_outs", "integer", ["default" => 0])
            ->addColumn("stumpings", "integer", ["default" => 0]);
    }
}
