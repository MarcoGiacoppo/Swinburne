<?php
class HitCounter
{
    private $dbConnect;

    function __construct($host, $username, $password, $dbname)
    {
        // Establish connection to the database
        $this->dbConnect = new mysqli($host, $username, $password, $dbname);
        if ($this->dbConnect->connect_error) {
            die("<p>Unable to connect to the database server.</p>"
                . "<p>Error code " . $this->dbConnect->connect_errno
                . ": " . $this->dbConnect->connect_error . "</p>");
        }

        // Check if the hitcounter table exists
        $this->checkTableExists();
    }

    // Function to check if the hitcounter table exists
    private function checkTableExists()
    {
        $table = "hitcounter";
        $sql = "SELECT 1 FROM $table LIMIT 1;";
        if (!$this->dbConnect->query($sql)) {
            die("<p>The hitcounter table does not exist or is inaccessible.</p>"
                . "<p>Error code " . $this->dbConnect->errno
                . ": " . $this->dbConnect->error . "</p>");
        }
    }

    // Function to retrieve the current hit count
    function getHits()
    {
        $sql = "SELECT hits FROM hitcounter LIMIT 1;";
        $result = $this->dbConnect->query($sql);
        if (!$result) {
            die("<p>Unable to execute the query.</p>"
                . "<p>Error code " . $this->dbConnect->errno
                . ": " . $this->dbConnect->error . "</p>");
        }

        $row = $result->fetch_assoc();
        return $row ? $row["hits"] : 0;
    }

    // Function to update the hit count
    function setHits($hit)
    {
        $sql = "UPDATE hitcounter SET hits = $hit WHERE id = 1;";
        if (!$this->dbConnect->query($sql)) {
            die("<p>Unable to update the hit count.</p>"
                . "<p>Error code " . $this->dbConnect->errno
                . ": " . $this->dbConnect->error . "</p>");
        }
    }

    // Function to reset the hit counter to zero
    function startOver()
    {
        $this->setHits(0);
    }

    // Function to close the database connection
    function closeConnection()
    {
        $this->dbConnect->close();
    }
}
?>