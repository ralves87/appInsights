<?php
namespace AbInbev\ApplicationInsights\Model;

use ApplicationInsights\Telemetry_Client as TelemetryClient;
use MyProject\ApplicationInsights\Helper\Data as HelperData;
use MyProject\ApplicationInsights\Api\ApplicationInsights as ApplicationInsightsInterface;

class Config implements ApplicationInsightsInterface
{
    /**
     * @var MyProject\ApplicationInsights\Helper\Data
     */
    protected $helperData;
    
    /**
     * @var ApplicationInsights\Telemetry_Client
     */
    protected $telemetryClient;
    
    /**
     * @param HelperData $helperData
     * @param TelemetryClient $telemetryClient
     */
    public function __construct(
        HelperData $helperData,
        TelemetryClient $telemetryClient
    ) {
        $this->helperData = $helperData;
        $this->TelemetryClient = $telemetryClient;
    }
    
    /**
     * @Initializing the client and setting the instrumentation key
     */
    public function applicationInsights()
    {
        $context = $this->TelemetryClient->getContext();
        $context->setInstrumentationKey($this->helperData->getInstrumentalKey());
        return $this->TelemetryClient;
    }

}
