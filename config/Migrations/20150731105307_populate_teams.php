<?php

use Phinx\Migration\AbstractMigration;

class PopulateTeams extends AbstractMigration
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
        $this->query('INSERT INTO teams (name) VALUES
          ("1st"),
          ("2nd"),
          ("3rd"),
          ("4th"),
          ("Midweek"),
          ("Sunday")
        ');
    }
}
