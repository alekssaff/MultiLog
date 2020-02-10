<?php

namespace App\Logging;


use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class MultiLog {

	private $logs = [];
	protected static $maxLoggers = 10;

	/**
	 * @param  string  $path
	 * @param  int  $days
	 * @return \Monolog\Logger
	 */
	public static function channel($path, $days=120){
		$loggers = resolve(self::class);
		$log = data_get($loggers->logs, $path, null);
		if ($log) return $log;
		array_splice($loggers->logs, 0, self::$maxLoggers-1);
		$log = new Logger($path);
		$log->pushHandler(
			$handler = new RotatingFileHandler(storage_path("logs/{$path}.log"), $days, 'debug')
		);
		$handler->setFormatter(new LineFormatter(null, null, true, true));
		$loggers->logs[$path] = $log;
		return $log;
	}

}
