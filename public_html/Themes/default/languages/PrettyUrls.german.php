<?php
//	Version: 0.9; PrettyUrls

require_once(dirname(__FILE__) . '/PrettyUrls.english.php');

//	Admin chrome
$txt['pretty_chrome_install_title'] = 'Installation von Pretty URLs';
$txt['pretty_install_success'] = 'Vielen Dank für die Verwendung von <b>Pretty URLs</b>! Die Installation war erfolgreich!';
$txt['pretty_install_continue'] = 'Bitte fahren Sie fort zur Admin-Seite, wo Sie die URL-Umschreibung aktivieren können.';

//	Admin chrome
$txt['pretty_chrome_title'] = 'Pretty URLs Administration';
$txt['pretty_chrome_menu_news'] = 'Neuigkeiten';
$txt['pretty_chrome_menu_settings'] = 'Einstellungen';
$txt['pretty_chrome_menu_maintenance'] = 'Wartung';
$txt['pretty_chrome_menu_nginx'] = 'Nginx Regeln';

//	News page
$txt['pretty_chrome_caption_news'] = 'Die neuesten Nachrichten und Informationen direkt von der Projekt-Website';
$txt['pretty_chrome_page_title_news'] = 'Pretty URLs Neuigkeiten &amp; Info';
$txt['pretty_chrome_title_news'] = 'Neuigkeiten &amp; Info';
$txt['pretty_current_version'] = 'Aktuelle Version';
$txt['pretty_download'] = 'Download';
$txt['pretty_latest_version'] = 'Neueste Version';
$txt['pretty_upgrade'] = 'Jetzt upgraden!';
$txt['pretty_version'] = 'Versionsinfo';

//	Settings page
$txt['pretty_cant_write_htaccess'] = 'Vorhandene .htaccess-Datei kann nicht überschrieben werden. Bitte ändern Sie ihre Schreibrechte.';
$txt['pretty_chrome_caption_settings'] = 'Verschiedene Einstellungen';
$txt['pretty_chrome_page_title_settings'] = 'Pretty URLs Einstellungen';
$txt['pretty_core_settings'] = 'Grundeinstellungen';
$txt['pretty_enable'] = 'URL-Umschreibung aktivieren';
$txt['pretty_filters'] = 'URL-Umschreibung Filter';
$txt['pretty_save'] = 'Änderungen speichern';

$txt['pretty_root_url'] = 'Pretty Urls Stamm: ';

$txt['pretty_skipactions'] = 'Skip Actions Liste: ';
$txt['pretty_skipactions_note'] = 'Geben Sie getrennt durch Kommas die Aktionen ein, die Sie überspringen möchten';
$txt['pretty_bufferusecache'] = 'Verwenden Sie Caching statt Datenbanktabelle für PrettyUrls';
// Tests page
$txt['pretty_chrome_caption_tests'] = 'Bitte überprüfen Sie vor Aktivierung der URL-Umschreibung, ob diese neu geschriebenen Links funktionieren.';

//	Maintenance page
$txt['pretty_chrome_caption_maintenance'] = 'Führen Sie einige Wartungsaufgaben aus';
$txt['pretty_chrome_page_title_maintenance'] = 'Pretty URLs Wartung';
$txt['pretty_run_maintenance'] = 'Wartungsaufgaben ausführen';

//	Edit filters page
$txt['pretty_chrome_caption_filters'] = 'Ein Tool zum Bearbeiten des Filter-Arrays. Das Array wird hier im <a href="http://www.json.org/">JSON</a>-Format formatiert. Vorsicht, der JSON-Parser arbeitet eher streng.';
$txt['pretty_chrome_page_title_filters'] = 'Pretty URLs Filters Tool';
$txt['pretty_chrome_title_filters'] = 'Filter Tool';
$txt['pretty_no_json'] = 'Für dieses Tool wird die PHP JSON-Erweiterung benötigt. Denken Sie über ein Upgrade auf PHP 5.2 nach.';

// Board URLs interface
$txt['pretty_add_url'] = 'Hinzufügen';
$txt['pretty_add_url_description'] = 'URL hinzufügen. Beachten Sie, dass nur bestimmte Zeichen zulässig sind.';
$txt['pretty_board_url_title'] = 'Pretty URLs für: ';
$txt['pretty_deleted_board'] = 'Gelöschtes Board #';
$txt['pretty_duplicate_link'] = 'zunächst löschen.';
$txt['pretty_duplicate_warning'] = 'Diese URL wird bereits von einem anderen Board verwendet. Sie wird frei, wenn Sie ';
$txt['pretty_make_primary'] = 'Zur primären machen';
$txt['pretty_no_primary_warning'] = 'Warnung, keine primäre URL!';
$txt['pretty_numerical'] = 'Leider musste die Board-ID als Suffix hinzugefügt werden, da die URL entweder eine Zahl ist oder mit einer Forum-Aktion übereinstimmt.';
$txt['pretty_primary_url'] = 'Primäre';

$txt['pretty_chrome_menu_settings_description'] = 'Einstellungen und Konfiguration für Pretty Urls';
$txt['pretty_chrome_menu_maintenance_description'] = 'Führen Sie Wartungsaufgaben für Pretty Urls aus';

$txt['pretty_chrome_menu_nginx_description'] = 'Erzeugen Sie Nginx-Regeln für Pretty Urls. Nur notwendig, wenn Sie den Webserver Nginx verwenden!';

$txt['pretty_nginix_note'] = 'Wenn Sie Nginx als Webserver verwenden, werden hier die generierten Regeln angezeigt. Jedes Mal, wenn Sie ein neues Modul oder eine neue Aktion hinzufügen, müssen Sie Ihre Nginx-Regeln aktualisieren.';
?>