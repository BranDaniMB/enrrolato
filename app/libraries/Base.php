<?php


class Base
{
    protected $conn;

    protected function connect()
    {
        // Puesto que no se han especificado UID ni PWD en el array  $connectionInfo,
        // La conexión se intentará utilizando la autenticación Windows.
        $connectionInfo = array("Database" => DB_NAME);
        $this->conn = sqlsrv_connect(DB_HOST, $connectionInfo);

        if ($this->conn) {
            echo "Conexión establecida.<br />";
        } else {
            echo "Conexión no se pudo establecer.<br />";
            die(print_r(sqlsrv_errors(), true));
        }
    }

    protected function disconnect()
    {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }

    protected function execute($sql, $procedureParams)
    {
        $this->connect();
        $stmt = sqlsrv_prepare($this->conn, $sql, $procedureParams);

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            while ($res = sqlsrv_next_result($stmt)) {
                // make sure all result sets are stepped through, since the output params may not be set until this happens
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }
    }
}