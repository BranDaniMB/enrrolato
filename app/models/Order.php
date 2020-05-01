<?php

class Order extends Base
{
    public function __construct()
    {

    }

    public function getOrdersInQueue() {
        $this->connect();

        $myparams['orderStatus'] = 1;

        $procedure_params = array(
            array(&$myparams['orderStatus'], SQLSRV_PARAM_IN),
        );

        $sql = "EXEC stp_getOrders @orderStatus = ?";

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
    }
}