<?php

class Validator
{
    // Validacion de llenado de menu
    public static function validateMenuForm($data)
    {
        $errors = [];

        if (empty(trim($data['name']))) {
            $errors[] = 'El campo "Nombre" no debe deestar vacio.';
        }
        
        if (strlen(trim($data['description'])) < 7) {
            $errors[] = 'El campo "Descripción" debe superar los 7 caracteres.';
        }
        
        if (strlen(trim($data['description'])) > 150) {
            $errors[] = 'El campo "Descripción" no debe superar los 150 caracteres.';
        }
        

        return $errors;
    }

    // Validacion de borrado de menu sin hijos
    public static function validateMenuDeletion($children) {
        return empty($children)
        ? []
        : ["No se puede eliminar el menú porque tiene submenús asignados."];
    }

}
