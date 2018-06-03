<?php




abstract class AppController {

    public $page   = 'default';
    public $layout = 'default';
    public $db     = '';

    public function __construct() {
        $this->db = new Database();
    }

    public function redirect($url) {
        header('Location: ' . $url);
        die;
    }

    public function index() {

    }

}
