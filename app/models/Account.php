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

    public function getAuthUrl() {
        return $this->googleClient->createAuthUrl();
    }

    public function authenticate($sup, $email) {
        $this->connect();

        $myparams['id'] = $sup;
        $myparams['email'] = $email;
        $myparams['result'] = 0;

        $procedure_params = array(
            array(&$myparams['id'], SQLSRV_PARAM_IN),
            array(&$myparams['email'], SQLSRV_PARAM_IN),
            array(&$myparams['result'], SQLSRV_PARAM_OUT)
        );

        $sql = "EXEC stp_authenticate @id = ?, @email = ?";

        $stmt = sqlsrv_prepare($this->conn, $sql, $procedure_params);

        if( !$stmt ) {
            die( print_r( sqlsrv_errors(), true));
        }

        if(sqlsrv_execute($stmt)){
            while($res = sqlsrv_next_result($stmt)){
                // make sure all result sets are stepped through, since the output params may not be set until this happens
            }
            // Output params are now set,
            print_r($myparams);
        }else{
            die( print_r( sqlsrv_errors(), true));
        }

        $this->disconnect();

        return $myparams["result"];
    }
}