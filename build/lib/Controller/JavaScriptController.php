<?php
namespace OCA\Pwk\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataDownloadResponse;
use OCP\AppFramework\Http\Response;
use OCP\IConfig;
use OCP\IRequest;
use OCA\Pwk\Config;

class JavaScriptController extends Controller
{
    /** @var \OCP\IConfig */
    protected $config;

    /**
     * constructor of the controller
     *
     * @param string $appName
     * @param IRequest $request
     * @param IConfig $config
     */
    public function __construct($appName,
        IRequest $request,
        Config $config) {
        parent::__construct($appName, $request);
        $this->config = $config;
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @PublicPage
     *
     * @return Response
     */
    public function tracking()
    {
        $options = [
            'url' => $this->config->getAppValue('url'),
            'siteId' => $this->config->getAppValue('siteId'),
            'trackDir' => $this->config->getBooleanAppValue('trackDir'),
            'trackUser' => $this->config->getBooleanAppValue('trackUser'),
        ];

        $script = "var cloudPwkOptions = '".json_encode($options)."';";
        $script = file_get_contents(__DIR__ . '/../../js/track.js');
        $script = str_replace('%OPTIONS%', json_encode($options), $script);

        return new DataDownloadResponse($script, 'tracking', 'text/javascript');
    }
}
