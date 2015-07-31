<?php

use Phinx\Migration\AbstractMigration;

class Formats extends AbstractMigration
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
        $t = $this->table("formats");
        $t->addColumn("name", "string")
            ->create();

        $this->query('INSERT into formats (name) VALUES
            ("50 overs"),
            ("45 overs"),
            ("40 overs"),
            ("35 overs"),
            ("30 overs"),
            ("20 overs")
        ');
    }
}
