<?php
//	Version: 0.9; PrettyUrls

require_once(dirname(__FILE__) . '/PrettyUrls.english.php');

//	Admin chrome
$txt['pretty_chrome_install_title'] = 'Instalación de Pretty URLs';
$txt['pretty_install_success'] = '¡Gracias por utilizar <b>Pretty URLs</b>! ¡La instalación fue exitosa!';
$txt['pretty_install_continue'] = 'Por favor, continúa a la página de administración, donde puedes habilitar la reescritura de URL.';

//	Admin chrome
$txt['pretty_chrome_title'] = 'Administración de Pretty URLs';
$txt['pretty_chrome_menu_news'] = 'Noticias';
$txt['pretty_chrome_menu_settings'] = 'Configuración';
$txt['pretty_chrome_menu_maintenance'] = 'Mantenimiento';
$txt['pretty_chrome_menu_nginx'] = 'Reglas de Nginx';

//	Página de noticias
$txt['pretty_chrome_caption_news'] = 'Las últimas noticias e información en directo desde el sitio web del proyecto';
$txt['pretty_chrome_page_title_news'] = 'Noticias e información de Pretty URLs';
$txt['pretty_chrome_title_news'] = 'Noticias e información';
$txt['pretty_current_version'] = 'Versión actual';
$txt['pretty_download'] = 'Descargar';
$txt['pretty_latest_version'] = 'Última versión';
$txt['pretty_upgrade'] = '¡Actualizar ahora!';
$txt['pretty_version'] = 'Información de la versión';

//	Página de configuración
$txt['pretty_cant_write_htaccess'] = 'No se puede sobrescribir el archivo .htaccess existente. Por favor, cambia sus permisos de escritura.';
$txt['pretty_chrome_caption_settings'] = 'Varias configuraciones';
$txt['pretty_chrome_page_title_settings'] = 'Configuración de Pretty URLs';
$txt['pretty_core_settings'] = 'Configuraciones principales';
$txt['pretty_enable'] = 'Habilitar la reescritura de URL';
$txt['pretty_filters'] = 'Filtros de reescritura de URL';
$txt['pretty_save'] = 'Guardar cambios';

$txt['pretty_root_url'] = 'Raíz de Pretty Urls: ';

$txt['pretty_skipactions'] = 'Lista de acciones a omitir: ';
$txt['pretty_skipactions_note'] = 'Introduce cualquier acción separada por una coma para omitir la reescritura de URL';
$txt['pretty_bufferusecache'] = 'Use el caché en lugar de la tabla de la base de datos para PrettyUrls';
// Página de pruebas
$txt['pretty_chrome_caption_tests'] = 'Antes de habilitar la reescritura de URL, por favor verifica que estos enlaces reescritos funcionen.';

//	Página de mantenimiento
$txt['pretty_chrome_caption_maintenance'] = 'Ejecuta algunas tareas de mantenimiento';
$txt['pretty_chrome_page_title_maintenance'] = 'Mantenimiento de Pretty URLs';
$txt['pretty_run_maintenance'] = 'Ejecutar tareas de mantenimiento';

//	Página de edición de filtros
$txt['pretty_chrome_caption_filters'] = 'Una herramienta para editar el array de filtros. El array se formatea aquí en el formato <a href="http://www.json.org/">JSON</a>. Ten cuidado, el analizador JSON es bastante estricto.';
$txt['pretty_chrome_page_title_filters'] = 'Herramienta de Filtros de Pretty URLs';
$txt['pretty_chrome_title_filters'] = 'Herramienta de Filtros';
$txt['pretty_no_json'] = 'La extensión PHP JSON es necesaria para esta herramienta. Considera actualizarte a PHP 5.2.';

// Interfaz de URLs de los foros
$txt['pretty_add_url'] = 'Agregar';
$txt['pretty_add_url_description'] = 'Agrega una URL. Ten en cuenta que lo que introduces aquí será procesado ya que sólo se permiten ciertos caracteres.';
$txt['pretty_board_url_title'] = 'Pretty URLs para: ';
$txt['pretty_deleted_board'] = 'Foro eliminado #';
$txt['pretty_duplicate_link'] = 'elimínalo primero.';
$txt['pretty_duplicate_warning'] = 'Esa URL ya está en uso por otro foro. Estará disponible si tú ';
$txt['pretty_make_primary'] = 'Hacer principal';
$txt['pretty_no_primary_warning'] = 'Advertencia, ¡no hay URL principal!';
$txt['pretty_numerical'] = 'Lo siento, pero como esa URL es un número o lo mismo que una acción del foro, se tuvo que agregar el ID del foro como sufijo.';
$txt['pretty_primary_url'] = 'Principal';

$txt['pretty_chrome_menu_settings_description'] = 'Configuración y ajuste para Pretty Urls';
$txt['pretty_chrome_menu_maintenance_description'] = 'Ejecutar cualquier tarea de mantenimiento para Pretty Urls';

$txt['pretty_chrome_menu_nginx_description'] = 'Genera reglas Nginx para Pretty Urls. ¡Solo se usa si usas un servidor web Nginx!';

$txt['pretty_nginix_note'] = 'Si utilizas Nginx como servidor web aquí están las reglas generadas. Cada vez que añadas un nuevo mod o acción necesitarás actualizar tus reglas de Nginx.';

?>