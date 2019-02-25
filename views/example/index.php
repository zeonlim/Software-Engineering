<a href="<?= URL_BASE; ?>/example/ajax">Create</a>
<ul>
	<?php foreach ($users as $user): ?>
	<li><?= $user['id']; ?> - <?= $user['name']; ?></li>
	<?php endforeach;?>
</ul>