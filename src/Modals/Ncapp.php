<?php
namespace App\Modals;

defined('ABSPATH') OR exit('No direct script access allowed');

Class Ncapp{

    public function __construct(){
        $this->db = include_once ABSPATH.'db_connect.php';
    }
}

?>