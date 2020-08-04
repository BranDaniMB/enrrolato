<?php

use Firebase\JWT\JWT;

/**
 * MVC - Model
 * Class Account
 * Database user data management
 */
class Account extends Base
{
    /**
     * @var Google_Client|null
     */
    private ?Google_Client $googleClient;

    /**
     * Account constructor.
     * @param Google_Client|null $newGoogleClient
     * @throws Google_Exception
     */
    public function __construct(Google_Client $newGoogleClient = null)
    {
        parent::__construct();
        JWT::$leeway = 60;
        $this->googleClient = $newGoogleClient;

        if ($this->googleClient) {
            $this->googleClient->setAuthConfig(CONFIG_PATH . "credentials.json");
            $this->googleClient->setScopes(array("openid email", "openid profile"));
        }
    }

    /**
     * Get the url to authenticate
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->googleClient->createAuthUrl();
    }

    /**
     * Verify that the account is among those authorized or to be authenticated
     * @param $sup
     * @param $email
     * @return bool
     */
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

    /**
     * Returns list of authorized accounts
     * @return mixed|null
     */
    public function getAuthenticationAccounts()
    {
        $reference = $this->getReference(ADMINS);
        try {
            $accounts = $reference->getSnapshot()->getValue();
            $result = "";
            foreach ($accounts as $key => $value) {
                $result .= '<li class="list-group-item">' . $value . ' <a class="delete-button" onclick="deleteModal(\'account\',\'' . $value . '\')"><i class="material-icons">delete</i></a></li>';
            }
            return $result;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            return 'No hay cuentas en el sistema.';
        }
    }

    /**
     * Returns list of accounts to authenticate
     * @return mixed|null
     */
    public function getTempAccounts()
    {
        $reference = $this->getReference(TEMP_ADMINS);
        $result = "";
        try {
            if ($reference->getSnapshot()->exists()) {
                $accounts = $reference->getSnapshot()->getValue();
                foreach ($accounts as $key => $value) {
                    $result .= '<li class="list-group-item">' . $value . ' <a class="delete-button" onclick="deleteModal(\'temp_account\',\'' . $value . '\')"><i class="material-icons">delete</i></a></li>';
                }
            } else {
                $result .= 'No hay cuentas por autentificar';
            }
            return $result;
        } catch (\Kreait\Firebase\Exception\DatabaseException $e) {
            $result .= 'No hay cuentas por autentificar';
            return $result;
        }
    }
}