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

    public function authenticate($sup, $email)
    {
        $myparams['id'] = $sup;
        $myparams['email'] = $email;
        $myparams['result'] = 0;

        $procedure_params = array(
            array(&$myparams['id'], SQLSRV_PARAM_IN),
            array(&$myparams['email'], SQLSRV_PARAM_IN),
            array(&$myparams['result'], SQLSRV_PARAM_OUT)
        );

        $sql = "EXEC stp_authenticate @id = ?, @email = ?, @result = ?";

        $this->execute($sql, $procedure_params);

        return $myparams["result"];
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