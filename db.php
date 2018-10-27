<?php
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('components.db');
    }
}
$db = new MyDB();
?>