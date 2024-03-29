<?php
class DatabaseHelper
{
    protected $conn;

    public function __construct()
    {
        try {
            $this->conn = oci_connect(
                $_ENV["DATABASE_USERNAME"],
                $_ENV["DATABASE_PASSWORD"],
                $_ENV["DATABASE_CONNECTION_URL"]
            );
            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }

        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        @oci_close($this->conn);
    }

    public function getAllPlants()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM plant";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function getAllUsers()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM \"USER\"";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function getAllEnvironments()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM environment";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function getAllStaticSensors()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM static_sensor";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function getAllCalibratedSensors()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM calibrated_sensor";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function getAllActuators()
    {
        $sql = "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM actuator";
        $statement = @oci_parse($this->conn, $sql);
        oci_define_by_name($statement, 'NUMBER_OF_ROWS', $number_of_rows);
        @oci_execute($statement);
        @oci_fetch($statement);
        return $number_of_rows;
    }

    public function createEnvironment($name, $description)
    {
        $errorcode = 0;
        $sql = 'BEGIN INSERT_ENVIRONMENT_CALLBACK(:name, :description, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        //  Bind the parameters
        @oci_bind_by_name($statement, ':name', $name);
        @oci_bind_by_name($statement, ':description', $description);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);
        @oci_free_statement($statement);

        return $errorcode;
    }

}

$test = new DatabaseHelper();
