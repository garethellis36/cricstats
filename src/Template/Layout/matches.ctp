<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        CricStats:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('cricstats.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="container">

    <div id="content">
        <?= $this->Flash->render() ?>

        <div class="row">
            <?= $this->fetch('content') ?>
        </div>

        <h3>CMS</h3>
        <ul>
            <li><a href="/clubs">Clubs</a></li>
            <li><a href="/clubs">Teams</a></li>
            <li><a href="/clubs">Competitions</a></li>
            <li><a href="/clubs">Formats</a></li>
            <li><a href="/clubs">Dismissal modes</a></li>
        </ul>
    </div>
    <footer>
    </footer>
</div>
</body>
</html>
