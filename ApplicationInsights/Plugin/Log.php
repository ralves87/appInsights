<?php
namespace AbInbev\ApplicationInsights\Plugin;

use MyProject\ApplicationInsights\Helper\Data as HelperData;
use MyProject\ApplicationInsights\Model\Config;
use Magento\Framework\Logger\Handler\Base as LoggerInterface;

class Log
{    
    /**
     * @var MyProject\ApplicationInsights\Helper\Data
     */
    private $helperData;

    /**
     * @var MyProject\ApplicationInsights\Model\Config
     */
    private $telemetryClient;
    
    private function __construct(
        HelperData $helperData,
        Config $telemetryClient
    )
    {
        $this->helperData = $helperData;
        $this->telemetryClient = $telemetryClient;
    }   

    private function afterEmergency(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::INFORMATION, 
                ['Type' => 'Emergency']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterAlert(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::INFORMATION, 
                ['Type' => 'Alert']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterCritical(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::CRITICAL, 
                ['Type' => 'Alert']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterError(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::ERROR, 
                ['Type' => 'Error']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterWarning(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::WARNING, 
                ['Type' => 'Warning']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterNotice(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::INFORMATION, 
                ['Type' => 'Notice']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterInfo(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::INFORMATION, 
                ['Type' => 'Info']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }

    private function afterDebug(LoggerInterface $subject, $message, array $context = array())
    {
        if($this->helperData->isEnabled() && !empty($this->helperData->getInstrumentalKey())) {
            $this->telemetryClient->applicationInsights()->trackMessage(
                $context, 
                \ApplicationInsights\Channel\Contracts\Message_Severity_Level::VERBOSE, 
                ['Type' => 'Debug']
            );

            $this->telemetryClient->applicationInsights()->flush();

            return array($message, $context);
        }
    }
    
}
