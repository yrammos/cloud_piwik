<?php
namespace OCA\Pwk\AppInfo;

use OCA\Pwk\Config;
use OCA\Pwk\Controller\SettingsController;
use OCA\Pwk\Controller\JavaScriptController;
use OCA\Pwk\Migration\Settings as SettingsMigration;
use OCP\AppFramework\App;
use OCP\IContainer;

class Application extends App
{

    public function __construct(array $urlParams = array())
    {
        parent::__construct('pwk', $urlParams);

        $container = $this->getContainer();

        $container->registerService('OCA\Pwk\Config', function (IContainer $c) {
            return new Config(
                $c->query('AppName'),
                $c->query('OCP\IConfig')
            );
        });

        /**
         * Controllers
         */
        $container->registerService('SettingsController', function (IContainer $c) {
            return new SettingsController(
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('OCA\Pwk\Config')
            );
        });

        $container->registerService('JavaScriptController', function (IContainer $c) {
            return new JavaScriptController(
                $c->query('AppName'),
                $c->query('Request'),
                $c->query('OCA\Pwk\Config')
            );
        });

        /**
         * Migrations
         */
        $container->registerService('OCA\Pwk\Migration\Settings', function (IContainer $c) {
            return new SettingsMigration(
                $c->query('OCP\IConfig')
            );
        });
    }
}
