<?php


class Account extends Base
{
    private $googleClient;

    public function __construct(Google_Client $newGoogleClient = null)
    {
        $this->googleClient = $newGoogleClient;

        if ($this->googleClient) {
            $this->googleClient->setAuthConfig(CONFIG_PATH . "credentials.json");
            $this->googleClient->setScopes(array("openid email", "openid profile"));
        }
    }

    public function getAuthUrl()
    {
        return $this->googleClient->createAuthUrl();
    }

    public function authenticate($sup)
    {
        $reference = $this->getReference(ADMINS."/".$sup);
        try {
            return $reference->getSnapshot()->exists();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            return false;
        }
    }

    public function getAuthenticationAccounts()
    {
        $myparams['accounts'] = "";

        $procedure_params = array(
            array(&$myparams['accounts'], SQLSRV_PARAM_OUT)
        );

        $sql = "EXEC stp_getAuthAccounts @accounts = ?";

        $this->execute($sql, $procedure_params);

        return $myparams["accounts"];
    }
}