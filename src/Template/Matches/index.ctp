<h2>Match list</h2>

<p>
    <a href="/matches/add">Add match</a>
</p>

<div class="margin-bottom">
<?php
echo $this->Form->create("/", [
    "type" => "get"
]);

foreach ($filters as $field => $attr) {
    echo $this->Form->input($field, array_merge([
        "label" => false,
        "div" => false
    ], $attr));
}

echo $this->Form->submit("Filter", ["div" => false]);

echo $this->Form->end();
?>
</div>

<div class="margin-bottom">

    <?php if ($matches->count() == 0): ?>
        <p>No matches found.</p>
    <?php else: ?>

        <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('season') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th><?= $this->Paginator->sort('club_id', "Team") ?></th>
                <th><?= $this->Paginator->sort('opposition') ?></th>
                <th><?= $this->Paginator->sort('competition_id') ?></th>
                <th><?= $this->Paginator->sort('format_id') ?></th>
                <th><?= $this->Paginator->sort('batting_runs', "Runs") ?></th>
                <th><?= $this->Paginator->sort('dismissal_mode_id', "How out") ?></th>
                <th><?= $this->Paginator->sort('bowling_wickets', "Bowling figures") ?></th>
                <th>Econ.</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($matches as $match): ?>
            <tr>
                <td><?= h($match->season) ?></td>
                <td><?= $match->date ? h($match->date->format("D jS M Y")) : "-" ?></td>
                <td>
                    <?= $match->has('club') ? $match->club->name : '' ?>
                    <?= $match->has('team') ? $match->team->name . " XI" : '' ?>
                </td>
                <td><?= h($match->opposition . " (" . $match->venue . ")") ?></td>
                <td>
                    <?= $match->has('competition') ? $match->competition->name : '' ?>
                </td>
                <td>
                    <?= $match->has('format') ? $match->format->name : '' ?>
                </td>
                <td>
                    <?php
                    if ($match->batting_runs && !empty($match->batting_runs) && $match->batting_runs != 0) {
                        echo $match->batting_runs;
                        if ($match->has('dismissal_mode') && $match->dismissal_mode->not_out) {
                            echo "*";
                        }
                    }
                    ?>
                </td>
                <td>
                    <?= $match->has('dismissal_mode') ? $match->dismissal_mode->name : '' ?>
                </td>
                <td>
                    <?php
                    if ($match->bowling_overs && !empty($match->bowling_overs)) {
                        echo $match->bowling_overs
                                . "-" . $match->bowling_maidens
                                . "-" . $match->bowling_runs
                                . "-" . $match->bowling_wickets;
                    }
                    ?>
                </td>
                <td><?= $match->bowling_econ ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $match->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $match->id], ['confirm' => __('Are you sure you want to delete # {0}?', $match->id)]) ?>
                </td>
            </tr>

        <?php endforeach; ?>
        </tbody>
        </table>

        <?php if ($totalRuns > 0): ?>
            <h2>Batting</h2>
            <table>
                <thead>
                    <th>Innings</th>
                    <th>Not out</th>
                    <th>High score</th>
                    <th>Runs</th>
                    <th>Average</th>
                    <th>50</th>
                    <th>100</th>
                </thead>
                <tbody>
                    <td><?= $innings ?></td>
                    <td><?= $notOuts ?></td>
                    <td><?= $highScore->batting_runs . ($highScore->dismissal_mode->not_out ? "*" : "") ?></td>
                    <td><?= $totalRuns ?></td>
                    <td><?= $battingAverage ?></td>
                    <td><?= $fifties ?></td>
                    <td><?= $hundreds ?></td>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if ($totalOvers > 0): ?>
            <h2>Bowling</h2>
            <table>
                <thead>
                    <th>Overs</th>
                    <th>Maidens</th>
                    <th>Runs</th>
                    <th>Wickets</th>
                    <th>Best</th>
                    <th>5WI</th>
                    <th>Average</th>
                    <th>Econ.</th>
                </thead>
                <tbody>
                <td><?= $totalOvers ?></td>
                <td><?= $totalMaidens ?></td>
                <td><?= $totalRuns ?></td>
                <td><?= $totalWickets ?></td>
                <td><?= $bestBowling->bowling_wickets . "-" . $bestBowling->bowling_runs ?></td>
                <td><?= $fiveFors ?></td>
                <td><?= $bowlingAverage ?></td>
                <td><?= $bowlingEcon ?></td>
                </tbody>
            </table>
        <?php endif; ?>

    <?php endif; ?>

</div>