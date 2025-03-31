<?php
require_once './controllers/MenuController.php';

$controller = new MenuController();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'store':
        $controller->store();
        break;
    case 'update':
        $controller->update();
        break;
    case 'menu':
        $fatherId = $_GET['father'] ?? null;
        $controller->menu($id, $fatherId);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}
