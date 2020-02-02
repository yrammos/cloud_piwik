<?php
namespace OCA\Pwk\Migration;

use OCP\IConfig;
use OCP\Migration\IOutput;
use OCP\Migration\IRepairStep;

class Settings implements IRepairStep
{

    /**
     * @var IConfig
     */
    private $config;

    public function __construct(IConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Returns the step's name
     */
    public function getName()
    {
        return 'Update Pwk/Matomo settings format';
    }

    /**
     * @param IOutput $output
     */
    public function run(IOutput $output)
    {
        $config = $this->config;
        $oldPwkConfig = $config->getAppValue('pwk', 'pwk');

        if (!empty($oldPwkConfig)) {
            $oldPwkConfig = json_decode($oldPwkConfig);
            $trackDir = $oldPwkConfig->trackDir;

            $config->setAppValue('pwk', 'url', $oldPwkConfig->url);
            $config->setAppValue('pwk', 'siteId', $oldPwkConfig->siteId);
            $config->setAppValue('pwk', 'trackDir', $trackDir === 'on');

            $config->deleteAppValue('pwk', 'pwk');
        } else {
            $output->info("Migration already executed");
        }
    }
}
