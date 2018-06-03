<?php
set_include_path(dirname(__FILE__));
include './core/main.includes.php';
session_start();

function getUrlComponents() {
    $url        = @$_SERVER['REDIRECT_URL'] ?: $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $components = parse_url($url ?: '/');
    if ($components['path'] == '/index.php') {
        $components['path'] = '/';
    }
    return $components;
}

function render($class) {
    $class->page   = $class->page ?: 'default';
    $class->layout = $class->layout ?: 'default';

    extract(get_object_vars($class), EXTR_REFS);
    require_once(dirname(__FILE__) . '/' . "./core/pages/layouts/$layout.php");
}


$urlComponents = getUrlComponents();
$URLPATH       = $urlComponents['path'];
define("URLPATH", $URLPATH);
$route = @$ROUTES[$URLPATH];
parse_str(@$urlComponents['query'], $params);
if (!empty($route) && $route != '/errors/NotFound') {
    list($classPath, $method) = explode('@', $route);
    if (empty($method)) {
        $method = 'index';
    }

    @$class = end(explode('/', $classPath));
    $classPath = str_replace('/' . $class, '', $classPath);
    try {
        require_once(dirname(__FILE__) . "/core$classPath/$class.php");
        $class = new $class;
        $class->$method($params);
        render($class);
    } catch (Exception $exc) {
        echo $exc->getMessage();
    } finally {
        die;
    }
} elseif ($route == '/errors/NotFound') {
    require_once(dirname(__FILE__) . '/core/errors/NotFound.php');
    $class = new NotFound;
    $class->index($params);
    render($class);
    die;
} else {
    Header("location: /errors/notfound");
    die();
}