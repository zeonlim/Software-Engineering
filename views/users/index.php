<h2>User List</h2>
<a href="<?= URL_BASE;?>/users/create">Create</a>
<ul>
<?php foreach ($testings as $testing):?>
	<li><?= $testing['id']?><?= $testing['name']?></li>
<?php endforeach?>
</ul>








