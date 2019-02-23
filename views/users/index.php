<h2>User List</h2>
<a href="<?= URL_BASE;?>/users/create">Create</a>
<ul>
<?php foreach ($users as $user):?>
	<li><?= $user['id']?><?= $user['name']?></li>
<?php endforeach?>
</ul>








