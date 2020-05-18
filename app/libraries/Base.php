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

        if (!$this->conn) {
            $_SESSION["ERROR_TITLE"] = "Error en la base de datos";
            $_SESSION["ERROR_MESSAGE"] = "No sé ha logrado conectar a la base de datos.";
            header('Location: /enrrolato/systemerror');
        }
    }

    protected function disconnect()
    {
        if ($this->conn) {
            sqlsrv_close($this->conn);
        }
    }

    protected function execute($sql, $procedureParams = Null)
    {
        $this->connect();

        if (isset($procedureParams)) {
            $stmt = sqlsrv_prepare($this->conn, $sql, $procedureParams);
        } else {
            $stmt = sqlsrv_prepare($this->conn, $sql);
        }

        if (!$stmt) {
            die(print_r(sqlsrv_errors(), true));
        }

        if (sqlsrv_execute($stmt)) {
            $count = 0;
            $result = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $result[$count] = $row;
                $count++;
            }
        } else {
            die(print_r(sqlsrv_errors(), true));
        }

        $this->disconnect();

        return $result;
    }
}