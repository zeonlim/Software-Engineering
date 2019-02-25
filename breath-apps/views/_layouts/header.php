<?php 
$bodyClass = isset($this->_params['bodyClass']) ? $this->_params['bodyClass'] : null;
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="<?= URL_BASE ?>/static/jquery-3.3.1.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body<?=$bodyClass ? ' class="' . implode(' ', $bodyClass) . '"' : null?>>