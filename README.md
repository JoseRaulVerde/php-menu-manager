📌 Descripción

Este proyecto es un sistema de gestión de menús desarrollado en PHP puro, utilizando una arquitectura básica MVC (Modelo - Vista - Controlador). Permite crear, editar y eliminar menús y submenús, con la posibilidad de asignar un menú padre para estructurar jerárquicamente la información.

El enfoque está en mantener una estructura limpia, validaciones robustas y una interfaz amigable utilizando únicamente PHP, HTML y CSS, junto con Font Awesome para los íconos y modales personalizados para mostrar errores.

📁 Estructura del Proyecto

project-root/
├── config/
│   └── database.php         # Configuración de la conexión PDO
├── controllers/
│   └── MenuController.php   # Lógica del controlador para operaciones CRUD
├── helpers/
│   ├── Formatter.php        # Funciones de ayuda para formato (ej. truncar texto)
│   └── Validator.php        # Validaciones del formulario
├── models/
│   └── Menu.php             # Modelo del menú con consultas SQL (CRUD, joins)
├── views/
│   ├── form.php             # Formulario de creación/edición
│   ├── home.php             # Vista principal de listado de menús
│   └── menu.php             # Vista de detalles del menú con hijos
├── assets/
│   └── css/
│       ├── style.css        # Estilos generales
│       ├── modalError.css   # Estilos para modales de error
│       └── menuView.css     # Estilos de visualización con tabs
├── index.php                # Punto de entrada y enrutador principal
└── README.md                # Documentación del proyecto

🚀 Funcionalidades

Crear, editar y eliminar menús

Cada menú puede tener un menú padre (opcional)

Modal para mostrar errores de validación

Validaciones de campos requeridos y longitudes

Celdas clicables para ver detalles del menú y submenús

Pestañas para mostrar los menús con submenús

Resalta el menú/submenú activo

Todo el flujo funciona con PHP puro (sin JavaScript obligatorio)

🧠 Detalles Técnicos

Lenguaje: PHP (con enfoque OOP)

Base de Datos: MySQL (exportable desde phpMyAdmin)

Estilos: CSS + Font Awesome para iconos

Validaciones: Lado del servidor (helpers en Validator.php)

Enrutamiento: Vía index.php?action=...

✅ Validaciones Incluidas

Archivo: helpers/Validator.php

required($valor, $campo)

maxLength($valor, $max, $campo)

isNullOrNumeric($valor, $campo)

validateMenuForm($datos) – Validación general del formulario

validateMenuDeletion($hijos) – Evita eliminar menús con submenús asignados

🗃️ Estructura de la Base de Datos

CREATE TABLE menus (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT NOT NULL,
  parent_menu_id INT DEFAULT NULL,
  FOREIGN KEY (parent_menu_id) REFERENCES menus(id) ON DELETE SET NULL
);

Para exportar: ve a phpMyAdmin > selecciona base de datos > Exportar > Formato SQL

💡 Consejos de Uso

Haz clic en Nombre o Descripción para ver submenús del menú seleccionado.

Si intentas borrar un menú con hijos, se mostrará un modal de error.

El campo descripción tiene mínimo 10 y máximo 150 caracteres.

Puedes extender funcionalidades agregando validaciones o helpers personalizados.
