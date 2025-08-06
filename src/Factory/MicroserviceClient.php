<?php
declare(strict_types=1);

namespace Budgetcontrol\Connector\Factory;

use Psr\Log\LoggerInterface;
use Budgetcontrol\Connector\Client\EntryClient;
use Budgetcontrol\Connector\Client\StatsClient;
use Budgetcontrol\Connector\Client\BudgetClient;
use Budgetcontrol\Connector\Client\SavingClient;
use Budgetcontrol\Connector\Client\WalletClient;
use Budgetcontrol\Connector\Client\WorkspaceClient;
use Budgetcontrol\Connector\Client\MailerClient;
use Budgetcontrol\Connector\Client\PushNotificationClient;
use Budgetcontrol\Connector\Client\AuthenticationClient;
use Budgetcontrol\Connector\Entities\MsDomains;

final class MicroserviceClient {

    private array $domains;
    private string $apiSecret;
    private array $clients = [];

    public function __construct(array $domains, string $apiSecret)
    {
        $this->domains = $domains;
        $this->apiSecret = $apiSecret;
    }

    /**
     * Get Entry microservice client
     */
    // public function entry(): EntryClient
    // {
    //     return $this->getClient('entry', EntryClient::class);
    // }

    // /**
    //  * Get Stats microservice client
    //  */
    // public function stats(): StatsClient
    // {
    //     return $this->getClient('stats', StatsClient::class);
    // }

    // /**
    //  * Get Budget microservice client
    //  */
    // public function budget(): BudgetClient
    // {
    //     return $this->getClient('budget', BudgetClient::class);
    // }

    // /**
    //  * Get Saving microservice client
    //  */
    // public function saving(): SavingClient
    // {
    //     return $this->getClient('saving', SavingClient::class);
    // }

    // /**
    //  * Get Wallet microservice client
    //  */
    // public function wallet(): WalletClient
    // {
    //     return $this->getClient('wallet', WalletClient::class);
    // }

    // /**
    //  * Get Workspace microservice client
    //  */
    // public function workspace(): WorkspaceClient
    // {
    //     return $this->getClient('workspace', WorkspaceClient::class);
    // }

    /**
     * Get Mailer microservice client
     */
    public function mailer(): MailerClient
    {
        return $this->getClient('mailer', MailerClient::class);
    }

    /**
     * Get Push Notification microservice client
     */
    public function pushNotification(): PushNotificationClient
    {
        return $this->getClient('notification', PushNotificationClient::class);
    }

    /**
     * Get Authentication microservice client
     */
    // public function authentication(): AuthenticationClient
    // {
    //     return $this->getClient('authentication', AuthenticationClient::class);
    // }

    /**
     * Generic method to get or create a client instance
     */
    private function getClient(string $serviceName, string $clientClass): object
    {
        if (!isset($this->clients[$serviceName])) {
            $domain = $this->getDomain($serviceName);
            $this->clients[$serviceName] = new $clientClass($domain, $this->apiSecret);
        }

        return $this->clients[$serviceName];
    }

    /**
     * Get domain URL for a specific service
     */
    private function getDomain(string $serviceName): string
    {
        if (isset($this->domains[$serviceName])) {
            return $this->domains[$serviceName];
        }

        // Fallback to MsDomains if available
        if (class_exists(MsDomains::class)) {
            $reflection = new \ReflectionClass(MsDomains::class);
            $constants = $reflection->getConstants();
            
            $constantName = strtoupper($serviceName);
            if (isset($constants[$constantName])) {
                return $constants[$constantName];
            }
        }

        throw new \InvalidArgumentException("Domain not found for service: {$serviceName}");
    }

    /**
     * Set domain for a specific service
     */
    public function setDomain(string $serviceName, string $domain): self
    {
        $this->domains[$serviceName] = $domain;
        
        // Clear cached client if exists
        if (isset($this->clients[$serviceName])) {
            unset($this->clients[$serviceName]);
        }

        return $this;
    }

    /**
     * Set authentication token for all clients
     */
    public function setAuthToken(string $token): self
    {
        foreach ($this->clients as $client) {
            if (method_exists($client, 'setAuthToken')) {
                $client->setAuthToken($token);
            }
        }

        return $this;
    }

    /**
     * Set debug mode for all clients
     */
    public function setDebug(bool $debug): self
    {
        foreach ($this->clients as $client) {
            if (method_exists($client, 'setDebug')) {
                $client->setDebug($debug);
            }
        }

        return $this;
    }

    /**
     * Set timeout for all clients
     */
    public function setTimeout(int $seconds): self
    {
        foreach ($this->clients as $client) {
            if (method_exists($client, 'setTimeout')) {
                $client->setTimeout($seconds);
            }
        }

        return $this;
    }

    /**
     * Get all available service names
     */
    public function getAvailableServices(): array
    {
        return [
            'entry',
            'stats', 
            'budget',
            'saving',
            'wallet',
            'workspace',
            'mailer',
            'notification',
            'authentication'
        ];
    }
}
