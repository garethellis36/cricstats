<?php

use Phinx\Migration\AbstractMigration;

class DismissalModes extends AbstractMigration
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
        $t = $this->table("dismissal_modes");
        $t->addColumn("name", "string")
            ->addColumn("not_out", "integer", ["default" => 0])
            ->create();

        $this->query('INSERT into dismissal_modes (name) VALUES
            ("Bowled"),
            ("Caught"),
            ("Caught & bowled"),
            ("LBW"),
            ("Run out"),
            ("Stumped"),
            ("Timed out"),
            ("Hit wicket"),
            ("Obstructing the field"),
            ("Retired out")
        ');

        $this->query('INSERT into dismissal_modes (name, not_out) VALUES
            ("Not out",1),
            ("Retired not out", 1),
            ("Retired hurt", 1)
        ');
    }
}
