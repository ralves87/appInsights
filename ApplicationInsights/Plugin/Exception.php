<?php
namespace MyProject\ApplicationInsights\Plugin;

use MyProject\ApplicationInsights\Helper\Data as HelperData;
use MyProject\ApplicationInsights\Model\Config;
use Magento\Framework\Webapi\ErrorProcessor as ErrorProcessor;
use Magento\Framework\HTTP\PhpEnvironment\Request;

class Exception
{
    /**
     * @var MyProject\ApplicationInsights\Helper\Data
     */
    private $helperData;

    /**
     * @var MyProject\ApplicationInsights\Model\ApplicationInsights
     */
    private $telemetryClient;

    /**
     * @var Magento\Framework\HTTP\PhpEnvironment\Request
     */
    private $request;

    private function __construct(
        HelperData $helperData,
        Config $telemetryClient,
        Request $request
    )
    {
        $this->helperData = $helperData;
        $this->telemetryClient = $telemetryClient;
        $this->request = $request;
    }

    private function afterMaskException(ErrorProcessor $subject, $result)
    {        
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            static $loop = false;

            if(!empty($result) && !$loop) {
                $startTime = microtime(true);
                $this->trackException($result);
                $this->trackRequest($result, $startTime);

                $this->telemetryClient->applicationInsights()->flush();
                $loop = true;
            }
        }

        return $result;
    }
    
    private function trackException($e)
    {
        $this->telemetryClient->applicationInsights()->trackException($e, 
            [
                'Message'  => $e->getMessage(),
                'Error'    => $e->getCode(),
                'httpCode' => $e->getHttpCode(),
                'File'     => $e->getFile(),
                'Line'     => $e->getLine()
            ]
        );
    }
    
    private function trackRequest($e, $startTime)
    {
        $serverValue = $this->request->getServerValue();
        $time = str_replace(".", null, $startTime - $serverValue["REQUEST_TIME_FLOAT"]);
        
        $this->telemetryClient->applicationInsights()->trackRequest(
            $serverValue["SERVER_NAME"],
            $serverValue["REDIRECT_URL"],
            time(),
            substr($time, 0, 4),
            $e->getHttpCode(),
            false
        );
    }
}
    