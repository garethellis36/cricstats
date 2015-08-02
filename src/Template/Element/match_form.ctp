<fieldset>
    <legend><?= __('Edit Match') ?></legend>
    <?php
    $years = [];
    $y = 2007;
    while ($y <= date("Y")) {
        $years[$y] = $y;
        $y++;
    }

    $venues = [
        "H" => "H",
        "A" => "A",
        "N" => "N"
    ];

    echo $this->Form->input('season', ["type" => "select", "options" => $years, "default" => date("Y")]);
    echo $this->Form->input('date', ['empty' => true, 'default' => '']);
    echo $this->Form->input('club_id', ['options' => $clubs]);
    echo $this->Form->input('team_id', ['options' => $teams]);
    echo $this->Form->input('opposition');
    echo $this->Form->input('venue', ['options' => $venues]);
    echo $this->Form->input('competition_id', ['options' => $competitions]);
    echo $this->Form->input('format_id', ['options' => $formats]);
    echo $this->Form->input('batting_no');
    echo $this->Form->input('dnb', ["type" => "checkbox", "required" => false]);
    echo $this->Form->input('batting_runs');
    echo $this->Form->input('dismissal_mode_id', ['options' => $dismissalModes, 'empty' => false]);
    echo $this->Form->input('bowling_overs');
    echo $this->Form->input('bowling_maidens');
    echo $this->Form->input('bowling_runs');
    echo $this->Form->input('bowling_wickets');
    echo $this->Form->input('catches');
    echo $this->Form->input('dropped_catches');
    echo $this->Form->input('run_outs');
    echo $this->Form->input('stumpings');
    echo $this->Form->input('notes');
    ?>
</fieldset>