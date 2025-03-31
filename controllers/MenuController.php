<?php
require_once './models/Menu.php';
require_once './helpers/Formatter.php';
require_once './helpers/Validator.php';

class MenuController {
    private $menuModel;

    public function __construct() {
        $this->menuModel = new Menu();
    }

    // Lista todos los menús
    public function index() {
        $menu = $this->menuModel->getAllMenus();
        include './views/home.php';
    }

    // Muestra detalles de menu seleccionado 
    public function menu($id) {
        $menu = $this->menuModel->getById($id);
        $menuFather = $this->menuModel->getMenusWithChildren();
        $children = $this->menuModel->getChildrenByParent($menu['parent_menu_id'] ?? $id);

        include './views/details.php';
    }

    // Muestra el formulario de creación
    public function create() {
        $menuList = $this->menuModel->getRootMenus();
        $menu = [
            'id' => '',
            'name' => '',
            'description' => '',
            'parent_menu_id' => ''
        ];
        include './views/form.php';
    }

    // Muestra el formulario de edición
    public function edit($id) {
        $menu = $this->menuModel->getById($id);
        $menuList = $this->menuModel->getRootMenusExcluding($id);
        include './views/form.php';
    }

    // Guarda un nuevo menú
    public function store() {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $parent = $_POST['parent_menu_id'] ?: null;

        $errors = Validator::validateMenuForm($_POST);

        if (!empty($errors)) {
            $menu = [
                'id' => null,
                'name' => $name,
                'description' => $description,
                'parent_menu_id' => $parent
            ];
            $menuList = $this->menuModel->getRootMenus();
            include './views/form.php';
            return;
        }

        $this->menuModel->addNewMenu($name, $description, $parent);
        header('Location: index.php');
        exit;
    }

    // Actualiza un menú existente
    public function update() {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $parent = $_POST['parent_menu_id'] ?: null;

        $errors = Validator::validateMenuForm($_POST);

        if (!empty($errors)) {
            $menu = [
                'id' => '',
                'name' => $name,
                'description' => $description,
                'parent_menu_id' => $parent
            ];
            $menuList = $this->menuModel->getRootMenus();
            include './views/form.php';
            return;
        }

        $this->menuModel->updateMenu($id, $name, $description, $parent);
        header('Location: index.php');
        exit;
    }

    // Elimina un menú si no tiene submenús
    public function delete($id) {
        $children = $this->menuModel->getChildrenByParent($id);
        $errors = Validator::validateMenuDeletion($children);

        if (!empty($errors)) {
            $menu = $this->menuModel->getAllMenus();
            include './views/home.php';
            return;
        }

        $this->menuModel->deleteMenu($id);
        header('Location: index.php');
        exit;
    }
}
