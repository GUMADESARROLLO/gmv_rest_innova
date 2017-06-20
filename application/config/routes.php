<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'servicio_controllers';
$route['ARTICULOS'] = 'Servicio_controllers/articulos';
$route['ClientesMora'] = 'Servicio_controllers/ClientesMora';
$route['ClientesIndicadores'] = 'Servicio_controllers/ClientesIndicadores';
$route['Clientes'] = 'Servicio_controllers/Clientes';
$route['Puntos'] = 'Servicio_controllers/Puntos';
$route['InsertCobros'] = 'Servicio_controllers/InsertCobros';
$route['inVisitas'] = 'Servicio_controllers/InsertVisitas';
$route['Login'] = 'Servicio_controllers/LoginUsuario';
$route['url_pedidos'] = 'Servicio_controllers/insertPedidos';
$route['updatePedidos'] = 'Servicio_controllers/updatePedidos';
$route['Actividades'] = 'Servicio_controllers/Actividades';
$route['pruebaJson'] = 'Servicio_controllers/pruebaJson';
$route['unAgenda'] = 'Servicio_controllers/InsertAgenda';
$route['Agenda'] = 'Servicio_controllers/Agenda';
$route['Historial'] = 'Servicio_controllers/Historial';
$route['insertRazones'] = 'Servicio_controllers/insertRazones';
$route['CONSECUTIVO'] = 'Servicio_controllers/CONSECUTIVO';

$route['LOTES'] = 'Servicio_controllers/lotes';

$route['uCumple'] = 'Servicio_controllers/cumple';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['prueba'] = 'Servicio_controllers/prueba';