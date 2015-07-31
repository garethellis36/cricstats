<?php
/**
 * Created by PhpStorm.
 * User: EllisG
 * Date: 31/07/2015
 * Time: 15:05
 */

namespace App\Shell;

use Cake\Console\Shell;
Use League\Csv\Reader;

class ImporterShell extends Shell
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Matches');
        $this->loadModel('Clubs');
        $this->loadModel('Teams');
        $this->loadModel('Competitions');
        $this->loadModel('Formats');
        $this->loadModel('DismissalModes');
    }

    public function main()
    {

        $this->out("Importing...");

        $csv = Reader::createFromPath('stats.csv');
        $rows = $csv->fetchAll();

        $data = [];

        foreach ($rows as $k => $row) {

            try {
                $club = $this->Clubs->findByName($row[2])->firstOrFail();
                $team = $this->Teams->findByName($row[3])->firstOrFail();
                $competition = $this->Competitions->findByName($row[6])->firstOrFail();
                $format = $this->Formats->findByName($row[7])->firstOrFail();
                $dismissalMode = ($row[9] != "dnb" ? $this->DismissalModes->findByName($row[10])->firstOrFail() : null);
            } catch (\Exception $e) {
                $rowNum = $k+1;
                $this->out("Row " . $rowNum .": " . $e->getMessage());
            }

            $data[] = [
                "season" => $row[0],
                "date" => (empty($row[1]) ? null : $row[1]),
                "club_id" => ($club ? $club->id : null),
                "team_id" => ($team ? $team->id : null),
                "venue" => $row[5],
                "opposition" => trim($row[4]),
                "competition_id" => ($competition ? $competition->id : null),
                "format_id" => ($format ? $format->id : null),
                "dnb" => ($row[9] == "dnb" ? 1 : 0),
                "batting_runs" => ($row[9] == "dnb" ? null : $row[9]),
                "batting_no" => $row[8],
                "dismissal_mode_id" => ($dismissalMode ? $dismissalMode->id : null),
                "bowling_overs" => $this->nullOrEmpty($row[11]),
                "bowling_maidens" => $this->nullOrEmpty($row[12]),
                "bowling_runs" => $this->nullOrEmpty($row[13]),
                "bowling_wickets" => $this->nullOrEmpty($row[14]),
                "notes" => ""
            ];

        }

        $matches = $this->Matches->newEntities($data, ["validate" => false]);
        foreach ($matches as $k => $match ) {
            try {
                if ($this->Matches->save($match)) {
                    $this->out($match->season . " - " . $match->opposition . " saved");
                    continue;
                }
            } catch (\Exception $e) {
                $this->err("Row " . $k . $match->season . " - " . $match->opposition . " not saved");
            }
        }


    }

    private function nullOrEmpty($var)
    {
        if (empty($var) && $var != 0) {
            return null;
        }
        return $var;
    }

}