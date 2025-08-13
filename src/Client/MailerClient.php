<?php declare(strict_types=1);
namespace Budgetcontrol\Connector\Client;

use Budgetcontrol\Connector\Entities\HttpResponse;
use Budgetcontrol\Connector\Entities\Payloads\Mailer\Contact;
use Budgetcontrol\Connector\Entities\Payloads\Mailer\BudgetMailer;
use Budgetcontrol\Connector\Entities\Payloads\Mailer\RecoveryPassword;
use Budgetcontrol\Connector\Service\Interfaces\ConnectorInterface;
use Budgetcontrol\Connector\Entities\Payloads\Mailer\SharedWorkspace;
use Budgetcontrol\Connector\Entities\Payloads\Mailer\SignUp;

final class MailerClient extends Client implements ConnectorInterface {

    /**
     * Sends notification when a budget has been exceeded.
     * 
     * @param BudgetMailer $data An associative array containing budget exceeding information
     * @return HttpResponse
     */
    public function budgetExceeded(BudgetMailer $data): HttpResponse
    {
        return $this->post('/notify/email/budget/exceeded', $data);
    }

    /**
     * Send contact form email
     * 
     * @param Contact $data Contact form data
     * @return HttpResponse
     */
    public function contact(Contact $data): HttpResponse
    {
        return $this->post('/notify/email/contact', $data);
    }

    /**
     * Send workspace sharing notification
     * 
     * @param SharedWorkspace $data Workspace sharing data
     * @return HttpResponse
     */
    public function sharedWorkspace(SharedWorkspace $data): HttpResponse
    {
        return $this->post('/notify/email/workspace/share', $data);
    }

    /**
     * Send workspace sharing notification
     * 
     * @param SharedWorkspace $data Workspace sharing data
     * @return HttpResponse
     */
    public function unSharedWorkspace(SharedWorkspace $data): HttpResponse
    {
        return $this->post('/notify/email/workspace/un-share', $data);
    }

    /**
     * Send password recovery email
     * 
     * @param RecoveryPassword $data Recovery password data
     * @return HttpResponse
     */
    public function recoveryPassword(RecoveryPassword $data): HttpResponse
    {
        return $this->post('/notify/email/auth/recovery-password', $data);
    }

    /**
     * Send sign up confirmation email
     * 
     * @param SignUp $data Sign up data
     * @return HttpResponse
     */
    public function signUp(SignUp $data): HttpResponse
    {
        return $this->post('/notify/email/auth/sign-up', $data);
    }
}