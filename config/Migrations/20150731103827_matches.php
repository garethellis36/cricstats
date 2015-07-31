<?php

use Phinx\Migration\AbstractMigration;

class Matches extends AbstractMigration
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

        $t->addColumn("season", "string")
            ->addColumn("date", "date", ["null" => true])
            ->addColumn("club_id", "integer")
            ->addColumn("team_id", "integer")
            ->addColumn("opposition", "string")
            ->addColumn("competition_id", "integer")
            ->addColumn("format_id", "integer")
            ->addColumn("batting_no", "integer", ["null" => true])
            ->addColumn("dnb", "integer", ["default" => 0])
            ->addColumn("batting_runs", "integer", ["null" => true])
            ->addColumn("dismissal_mode_id", "integer", ["null" => true])
            ->addColumn("bowling_overs", "integer", ["null" => true])
            ->addColumn("bowling_maidens", "integer", ["null" => true])
            ->addColumn("bowling_runs", "integer", ["null" => true])
            ->addColumn("bowling_wickets", "integer", ["null" => true])
            ->addColumn("bowling_econ", "decimal", [
                "null" => true,
                "precision" => 3,
                "scale" => 2
            ])
            ->create();
    }
}
