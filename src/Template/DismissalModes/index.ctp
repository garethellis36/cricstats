<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Dismissal Mode'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Matches'), ['controller' => 'Matches', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Match'), ['controller' => 'Matches', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="dismissalModes index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('not_out') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($dismissalModes as $dismissalMode): ?>
        <tr>
            <td><?= $this->Number->format($dismissalMode->id) ?></td>
            <td><?= h($dismissalMode->name) ?></td>
            <td><?= $this->Number->format($dismissalMode->not_out) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $dismissalMode->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dismissalMode->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dismissalMode->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dismissalMode->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
