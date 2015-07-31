<?php

use Phinx\Migration\AbstractMigration;

class ModifyMatchesOvers extends AbstractMigration
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
        $t->changeColumn("bowling_overs", "decimal", [
            "null" => true,
            "precision" => 3,
            "scale" => 1
        ])->save();
    }
}
