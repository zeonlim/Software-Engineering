<?php
namespace app\base;

class Controller
{
	public $_params = [];

	public static function getId()
	{
		$basename = lcfirst(basename(get_called_class(), 'Controller'));
		$parts = preg_split('/(?=[A-Z])/', $basename);
		foreach ($parts as $index => $part) $parts[$index] = lcfirst($part);
		return implode('-', $parts);
	}

	public function getLayoutPath()
	{
		return PATH_ROOT . '/views/_layouts';
	}

	public function getViewPath()
	{
		return PATH_ROOT . '/views/' . static::getId();
	}

	public function render($viewFile, $data = [])
	{
		if ($data) extract($data);
		$header = require $this->getLayoutPath() . '/header.php';
		$content = require $this->getViewPath() . '/' . $viewFile . '.php';
		$footer = require $this->getLayoutPath() . '/footer.php';
		return $header . $content . $footer;
	}
}