<?php

namespace App;

use Nette;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('<module>/<presenter>/<action>', 'Api:Main:Index');
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Home:default');
		return $router;
	}
}
