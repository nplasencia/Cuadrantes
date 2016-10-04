<?php

return [

    'title'        => 'Usuarios',
	'data_title'   => 'Datos del usuario',
    'name'         => 'Nombre',
    'surname'      => 'Apellidos',
	'role'         => 'Tipo de usuario',
    'telephone'    => 'Teléfono',
    'email'        => 'E-mail',
	'new_button'   => 'Nuevo usuario',

	'select_role'   => 'Selecciona el tipo de usuario',
    'select_center' => 'Selecciona el centro del usuario',

	// Success messages
    'store_success'      => 'El usuario :Name ha sido creado exitosamente. Se ha enviado correctamente un email al usuario con sus credenciales de acceso.',
    'update_success'     => 'El usuario :Name ha sido actualizado exitosamente',
    'delete_success'     => 'El usuario :Name ha sido eliminado exitosamente',

	// Problem messages
    'store_exists'       => 'El usuario :Name ya existe',
    'update_exists'      => 'Ya existe un usuario con el email :Email',
    'search_no_found'    => 'No se han encontrado centros que sigan este criterio de búsqueda',

];