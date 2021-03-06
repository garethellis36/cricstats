<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Dismissal Mode'), ['action' => 'edit', $dismissalMode->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dismissal Mode'), ['action' => 'delete', $dismissalMode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dismissalMode->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dismissal Modes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dismissal Mode'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Matches'), ['controller' => 'Matches', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Match'), ['controller' => 'Matches', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="dismissalModes view large-10 medium-9 columns">
    <h2><?= h($dismissalMode->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($dismissalMode->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($dismissalMode->id) ?></p>
            <h6 class="subheader"><?= __('Not Out') ?></h6>
            <p><?= $this->Number->format($dismissalMode->not_out) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Matches') ?></h4>
    <?php if (!empty($dismissalMode->matches)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Season') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Club Id') ?></th>
            <th><?= __('Team Id') ?></th>
            <th><?= __('Opposition') ?></th>
            <th><?= __('Competition Id') ?></th>
            <th><?= __('Format Id') ?></th>
            <th><?= __('Batting No') ?></th>
            <th><?= __('Dnb') ?></th>
            <th><?= __('Batting Runs') ?></th>
            <th><?= __('Dismissal Mode Id') ?></th>
            <th><?= __('Bowling Overs') ?></th>
            <th><?= __('Bowling Maidens') ?></th>
            <th><?= __('Bowling Runs') ?></th>
            <th><?= __('Bowling Wickets') ?></th>
            <th><?= __('Bowling Econ') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($dismissalMode->matches as $matches): ?>
        <tr>
            <td><?= h($matches->id) ?></td>
            <td><?= h($matches->season) ?></td>
            <td><?= h($matches->date) ?></td>
            <td><?= h($matches->club_id) ?></td>
            <td><?= h($matches->team_id) ?></td>
            <td><?= h($matches->opposition) ?></td>
            <td><?= h($matches->competition_id) ?></td>
            <td><?= h($matches->format_id) ?></td>
            <td><?= h($matches->batting_no) ?></td>
            <td><?= h($matches->dnb) ?></td>
            <td><?= h($matches->batting_runs) ?></td>
            <td><?= h($matches->dismissal_mode_id) ?></td>
            <td><?= h($matches->bowling_overs) ?></td>
            <td><?= h($matches->bowling_maidens) ?></td>
            <td><?= h($matches->bowling_runs) ?></td>
            <td><?= h($matches->bowling_wickets) ?></td>
            <td><?= h($matches->bowling_econ) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Matches', 'action' => 'view', $matches->id]) ?>

                <?= $this->Html->link(__('Edit'), ['controller' => 'Matches', 'action' => 'edit', $matches->id]) ?>

                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Matches', 'action' => 'delete', $matches->id], ['confirm' => __('Are you sure you want to delete # {0}?', $matches->id)]) ?>

            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
