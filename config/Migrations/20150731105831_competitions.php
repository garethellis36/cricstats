<?php

use Phinx\Migration\AbstractMigration;

class Competitions extends AbstractMigration
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
        $t = $this->table("competitions");
        $t->addColumn("name", "string")
            ->addColumn("competitive", "integer")
            ->create();

        $this->query('INSERT into competitions (name, competitive) VALUES
            ("Cherwell League Div 9", 1),
            ("Cherwell League Div 8", 1),
            ("Cherwell League Div 7", 1),
            ("Cherwell League Div 5", 1),
            ("OCA Div 10", 1),
            ("OCA Div 9", 1),
            ("OCA Div 7", 1),
            ("OCA Cup - 1st XI", 1),
            ("OCA Cup - 2nd XI", 1),
            ("Friendly", 0)
        ');
    }
}
