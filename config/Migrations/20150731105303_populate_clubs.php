<?php

use Phinx\Migration\AbstractMigration;

class PopulateClubs extends AbstractMigration
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
        $this->query('INSERT INTO clubs (name) VALUES
          ("Kidlington C.C."),
          ("Oxford Outcomes"),
          ("Gosford All Blacks"),
          ("Iffley Village C.C."),
          ("Abingdon Vale C.C."),
          ("Taylor & Francis")
        ');
    }
}
