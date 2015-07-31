<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\CricketUtility;
use \Cake\ORM\Query;
use Cake\ORM\TableRegistry;


/**
 * Matches Controller
 *
 * @property \App\Model\Table\MatchesTable $Matches
 */
class MatchesController extends AppController
{

    private $filters = [];

    private $sortField;

    private $sortDirection;

    private function processFilters()
    {
        $this->filters = [];

        foreach ($this->request->query as $model => $conditions) {

            if ($model == "sort") {
                $this->sortField = $conditions;
                continue;
            }

            if ($model == "direction") {
                $this->sortDirection = $conditions;
                continue;
            }

            foreach ($conditions as $field => $value) {
                if ($value == "") {
                    continue;
                }

                $key = $model . "." . $field;

                if ($key == "Competitions.competitive" && $value == 0) {
                    continue;
                }

                $this->request->data[$model][$field] = $this->filters[$key] = $value;
            }

        }
    }

    private $contain = ['Clubs', 'Teams', 'Competitions', 'Formats', 'DismissalModes'];

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->processFilters();

        $this->layout = "matches";

        $order = ["Matches.season DESC", "Matches.date DESC", "Matches.id DESC"];

        if ($this->sortDirection && $this->sortField) {
            $order = [
                $this->sortField . " " . strtoupper($this->sortDirection)
            ];
        }

        $matches = $this->Matches->find("all", [
            'contain' => $this->contain
        ])->where($this->filters)->order($order);

        $this->set('matches', $matches->map(function ($row) {
            $row->bowling_econ = CricketUtility::calculateBowlingEconomy($row->bowling_overs, $row->bowling_runs);
            return $row;
        }));

        $this->setBattingStats($matches);
        $this->setBowlingStats($matches);

        $this->set('_serialize', ['matches']);

        $this->populateFilters();
    }

    private function populateFilters()
    {
        $this->set("filters", [
            "Matches.season" => [
                "type" => "select",
                "empty" => "All seasons"
            ],
            "Matches.club_id" => [
                "type" => "select",
                "empty" => "All clubs"
            ],
            "Matches.team_id" => [
                "type" => "select",
                "empty" => "All teams"
            ],
            "Matches.competition_id" => [
                "type" => "select",
                "empty" => "All competitions"
            ],
            "Matches.format_id" => [
                "type" => "select",
                "empty" => "All formats"
            ],
            "Competitions.competitive" => [
                "type" => "checkbox",
                "label" => "Competitive fixtures only",
                "hiddenField" => false
            ]
        ]);

        $this->populateFilterDropdowns();
    }

    private function populateFilterDropdowns()
    {
        $seasons = [];
        $y = 2007;
        while ($y <= date("Y")) {
            $seasons[$y] = $y;
            $y++;
        }

        $clubs = TableRegistry::get("clubs");
        $clubs = $clubs->find("all")->combine("id", "name");

        $teams = TableRegistry::get("teams");
        $teams = $teams->find("all")->combine("id", "name");

        $competitions = TableRegistry::get("competitions");
        $competitions = $competitions->find("all")->combine("id", "name");

        $formats = TableRegistry::get("formats");
        $formats = $formats->find("all")->combine("id", "name");

        $this->set(compact(
           "seasons",
            "clubs",
            "teams",
            "competitions",
            "formats"
        ));
    }

    private function setBattingStats(Query $matches)
    {
        $totalRuns = $this->calculateTotal($matches, "batting_runs");
        $innings = $this->getTotalInnings();
        $notOuts = $this->getTotalNotOuts();

        $battingAverage = CricketUtility::calculateBattingAverage($totalRuns, $innings, $notOuts);

        $highScore = $this->getHighestScore($matches);
        $fifties = $this->getNumberFifties();
        $hundreds = $this->getNumberHundreds();

        $this->set(compact(
            "totalRuns",
            "innings",
            "notOuts",
            "battingAverage",
            "highScore",
            "fifties",
            "hundreds"
        ));
    }

    private function setBowlingStats(Query $matches)
    {
        $totalOvers = $this->calculateTotalOvers($matches);
        $totalMaidens = $this->calculateTotal($matches, "bowling_maidens");
        $totalRunsConceded = $this->calculateTotal($matches, "bowling_runs");
        $totalWickets = $this->calculateTotal($matches, "bowling_wickets");

        $bowlingEcon = CricketUtility::calculateBowlingEconomy($totalOvers, $totalRunsConceded);
        $bowlingAverage = CricketUtility::calculateBowlingAverage($totalRunsConceded, $totalWickets);

        $fiveFors = $this->calculateNumberFiveFors();

        $bestBowling = $this->getBestBowling($matches);

        $this->set(compact(
            "totalOvers",
            "totalMaidens",
            "totalRunsConceded",
            "totalWickets",
            "bowlingEcon",
            "bowlingAverage",
            "fiveFors",
            "bestBowling"
        ));
    }

    private function getBestBowling(Query $matches)
    {
        return $this->Matches
            ->find("all", ["contain" => $this->contain])
            ->where($this->filters)
            ->order(["Matches.bowling_wickets DESC", "Matches.bowling_runs ASC"])
            ->first();
    }

    private function calculateTotalOvers(Query $matches)
    {
        $totalBalls = 0;
        foreach ($matches as $match) {
            if (empty($match->bowling_overs)) {
                continue;
            }
            $totalBalls += CricketUtility::convertOversToBalls($match->bowling_overs);
        }
        return CricketUtility::convertBallsToOvers($totalBalls);
    }

    private function calculateTotal(Query $matches, $field)
    {
        $total = 0;
        foreach ($matches as $match) {
            $total += $match->$field;
        }
        return $total;
    }

    private function calculateNumberFiveFors()
    {
        return $this->Matches->find("all", ["contain" => $this->contain])->where(array_merge($this->filters, [
            "Matches.bowling_wickets >= 5"
        ]))->count();
    }

    private function getNumberFifties()
    {
        return $this->Matches->find("all", ["contain" => $this->contain])->where(array_merge($this->filters, [
            "Matches.batting_runs >= 50",
            "Matches.batting_runs < 100"
        ]))->count();
    }

    private function getNumberHundreds()
    {
        return $this->Matches->find("all", ["contain" => $this->contain])->where(array_merge($this->filters, [
            "Matches.batting_runs >= 100"
        ]))->count();
    }

    private function getHighestScore(Query $matches)
    {
        return $this->Matches
            ->find("all", ["contain" => $this->contain])
            ->order(["Matches.batting_runs DESC"])
            ->where($this->filters)
            ->first();
    }

    private function getTotalInnings()
    {
        return $this->Matches->find("all", ["contain" => $this->contain])->where(array_merge($this->filters, ["Matches.dnb" => 0]))->count();
    }

    private function getTotalNotOuts()
    {
        return $this->Matches
            ->find("all", ["contain" => $this->contain])
            ->contain(["DismissalModes"])
            ->where(array_merge($this->filters, ["DismissalModes.not_out" => 1]))->count();
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $match = $this->Matches->newEntity();
        if ($this->request->is('post')) {
            $match = $this->Matches->patchEntity($match, $this->request->data);
            if ($this->Matches->save($match)) {
                $this->Flash->success(__('The match has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The match could not be saved. Please, try again.'));
            }
        }
        $clubs = $this->Matches->Clubs->find('list', ['limit' => 200]);
        $teams = $this->Matches->Teams->find('list', ['limit' => 200]);
        $competitions = $this->Matches->Competitions->find('list', ['limit' => 200]);
        $formats = $this->Matches->Formats->find('list', ['limit' => 200]);
        $dismissalModes = $this->Matches->DismissalModes->find('list', ['limit' => 200]);
        $this->set(compact('match', 'clubs', 'teams', 'competitions', 'formats', 'dismissalModes'));
        $this->set('_serialize', ['match']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Match id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $match = $this->Matches->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $match = $this->Matches->patchEntity($match, $this->request->data);
            if ($this->Matches->save($match)) {
                $this->Flash->success(__('The match has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The match could not be saved. Please, try again.'));
            }
        }
        $clubs = $this->Matches->Clubs->find('list', ['limit' => 200]);
        $teams = $this->Matches->Teams->find('list', ['limit' => 200]);
        $competitions = $this->Matches->Competitions->find('list', ['limit' => 200]);
        $formats = $this->Matches->Formats->find('list', ['limit' => 200]);
        $dismissalModes = $this->Matches->DismissalModes->find('list', ['limit' => 200]);
        $this->set(compact('match', 'clubs', 'teams', 'competitions', 'formats', 'dismissalModes'));
        $this->set('_serialize', ['match']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Match id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $match = $this->Matches->get($id);
        if ($this->Matches->delete($match)) {
            $this->Flash->success(__('The match has been deleted.'));
        } else {
            $this->Flash->error(__('The match could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
