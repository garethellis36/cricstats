<?php

use Phinx\Migration\AbstractMigration;

class AddVenueToMatches extends AbstractMigration
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
        $t->addColumn("venue", "string")->save();
    }
}
