<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Match'), ['action' => 'edit', $match->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Match'), ['action' => 'delete', $match->id], ['confirm' => __('Are you sure you want to delete # {0}?', $match->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Matches'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Match'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clubs'), ['controller' => 'Clubs', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Club'), ['controller' => 'Clubs', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Teams'), ['controller' => 'Teams', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Team'), ['controller' => 'Teams', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Competitions'), ['controller' => 'Competitions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Competition'), ['controller' => 'Competitions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Formats'), ['controller' => 'Formats', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Format'), ['controller' => 'Formats', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dismissal Modes'), ['controller' => 'DismissalModes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dismissal Mode'), ['controller' => 'DismissalModes', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="matches view large-10 medium-9 columns">
    <h2><?= h($match->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Season') ?></h6>
            <p><?= h($match->season) ?></p>
            <h6 class="subheader"><?= __('Club') ?></h6>
            <p><?= $match->has('club') ? $this->Html->link($match->club->name, ['controller' => 'Clubs', 'action' => 'view', $match->club->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Team') ?></h6>
            <p><?= $match->has('team') ? $this->Html->link($match->team->name, ['controller' => 'Teams', 'action' => 'view', $match->team->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Opposition') ?></h6>
            <p><?= h($match->opposition) ?></p>
            <h6 class="subheader"><?= __('Competition') ?></h6>
            <p><?= $match->has('competition') ? $this->Html->link($match->competition->name, ['controller' => 'Competitions', 'action' => 'view', $match->competition->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Format') ?></h6>
            <p><?= $match->has('format') ? $this->Html->link($match->format->name, ['controller' => 'Formats', 'action' => 'view', $match->format->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Dismissal Mode') ?></h6>
            <p><?= $match->has('dismissal_mode') ? $this->Html->link($match->dismissal_mode->name, ['controller' => 'DismissalModes', 'action' => 'view', $match->dismissal_mode->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Venue') ?></h6>
            <p><?= h($match->venue) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($match->id) ?></p>
            <h6 class="subheader"><?= __('Batting No') ?></h6>
            <p><?= $this->Number->format($match->batting_no) ?></p>
            <h6 class="subheader"><?= __('Dnb') ?></h6>
            <p><?= $this->Number->format($match->dnb) ?></p>
            <h6 class="subheader"><?= __('Batting Runs') ?></h6>
            <p><?= $this->Number->format($match->batting_runs) ?></p>
            <h6 class="subheader"><?= __('Bowling Overs') ?></h6>
            <p><?= $this->Number->format($match->bowling_overs) ?></p>
            <h6 class="subheader"><?= __('Bowling Maidens') ?></h6>
            <p><?= $this->Number->format($match->bowling_maidens) ?></p>
            <h6 class="subheader"><?= __('Bowling Runs') ?></h6>
            <p><?= $this->Number->format($match->bowling_runs) ?></p>
            <h6 class="subheader"><?= __('Bowling Wickets') ?></h6>
            <p><?= $this->Number->format($match->bowling_wickets) ?></p>
            <h6 class="subheader"><?= __('Bowling Econ') ?></h6>
            <p><?= $this->Number->format($match->bowling_econ) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?= h($match->date) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Notes') ?></h6>
            <?= $this->Text->autoParagraph(h($match->notes)) ?>
        </div>
    </div>
</div>
