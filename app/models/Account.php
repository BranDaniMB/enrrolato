<?php


class Account extends Base
{
    private $googleClient;

    public function __construct(Google_Client $newGoogleClient = null)
    {
        parent::__construct();
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

    public function authenticate($sup, $email)
    {
        try {
            $reference = $this->getReference(ADMINS."/".$sup);
            if (!$reference->getSnapshot()->exists()) {
                $reference = $this->getReference(TEMP_ADMINS."/".md5($email));
                if ($reference->getSnapshot()->exists()) {
                    $reference->set(null);
                    $reference = $this->getReference(ADMINS."/".$sup);
                    $reference->set($email);
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            return false;
        }
    }

    public function getAuthenticationAccounts()
    {
        $reference = $this->getReference(ADMINS);
        try {
            return $reference->getSnapshot()->getValue();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            return null;
        }
    }

    public function getTempAccounts()
    {
        $reference = $this->getReference(TEMP_ADMINS);
        try {
            return $reference->getSnapshot()->getValue();
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            return null;
        }
    }
}