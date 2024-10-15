<?php

declare(strict_types = 1);

namespace DP;

class Config
{
	/**
	 * @var string
	 */
	protected static $dir = '';

	/**
	 * @var array <string, array<string, mixed>>
	 */
	protected static $data = [];

	/**
	 * @return string
	 */
	public static function get_dir()
	{
		return self::$dir;
	}

	/**
	 * @param string $dir
	 */
	public static function set_dir(string $dir): void
	{
		$_dir = \realpath($dir);
		if ($_dir === false) {
			throw new \Exception('dir doesn\'t exist');
		}
		self::$dir = $_dir;
	}

	/**
	 * @param string $config
	 * @param string|null $key
	 * @return mixed
	 */
	public static function get(string $config, string $key = null)
	{
		$path = self::$dir . "/$config.php";
		if (!isset(self::$data[$path])) {
			self::$data[$path] = require $path;
		}
		return $key === null ? self::$data[$path] : self::$data[$path][$key];
	}
}
