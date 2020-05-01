<?php


class Account
{
    private $db;
    private $googleClient;
    public function __construct(Google_Client $newGoogleClient = null)
    {
        $this->googleClient = $newGoogleClient;
        $this->db = new Base;

        if ($this->googleClient) {
            $this->googleClient->setAuthConfig(CONFIG_PATH . "credentials.json");
            $this->googleClient->setScopes(array("openid email", "openid profile"));
        }
    }

    public function getAuthUrl() {
        return $this->googleClient->createAuthUrl();
    }
}