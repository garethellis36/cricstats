<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dismissalMode->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dismissalMode->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dismissal Modes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Matches'), ['controller' => 'Matches', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Match'), ['controller' => 'Matches', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="dismissalModes form large-10 medium-9 columns">
    <?= $this->Form->create($dismissalMode) ?>
    <fieldset>
        <legend><?= __('Edit Dismissal Mode') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('not_out', ["type" => "checkbox"]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
