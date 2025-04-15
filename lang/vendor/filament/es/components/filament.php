<?php

return [
    'actions' => [
        'create' => 'Crear',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'view' => 'Ver',
        'save' => 'Guardar',
        'cancel' => 'Cancelar',
    ],

    'fields' => [
        'name' => 'Nombre',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'role' => 'Rol',
    ],

    'messages' => [
        'no_records' => 'No hay registros aún',
        'create_success' => 'Creado correctamente.',
        'update_success' => 'Actualizado correctamente.',
        'delete_success' => 'Eliminado correctamente.',
    ],

    'table' => [
        'actions' => 'Acciones',
        'columns' => [
            'name' => 'Nombre',
            'email' => 'Correo',
        ],
    ],

    'form' => [
        'create' => 'Crear :label',
        'edit' => 'Editar :label',
    ],
];
