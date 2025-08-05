<?php
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Service\HttpClientService;
use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Entities\HttpResponse;

/**
 * Class to connect to the Budget Control API of the microservice.
 */
class Client extends HttpClientService implements ConnectorInterface {

    public function __construct(string $domain, string $apiSecret)
    {
        parent::__construct($domain, $apiSecret);
    }
    
}