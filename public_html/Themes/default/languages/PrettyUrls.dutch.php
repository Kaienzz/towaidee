<?php
//	Version: 0.9; PrettyUrls

require_once(dirname(__FILE__) . '/PrettyUrls.english.php');

//	Admin chrome
$txt['pretty_chrome_install_title'] = 'Installeren van Mooie URLs';
$txt['pretty_install_success'] = 'Bedankt voor het gebruiken van <b>Mooie URLs</b>! De installatie was succesvol!';
$txt['pretty_install_continue'] = 'Ga verder naar de beheerderspagina, waar je URL herschrijven kunt inschakelen.';

//	Admin chrome
$txt['pretty_chrome_title'] = 'Mooie URLs Beheer';
$txt['pretty_chrome_menu_news'] = 'Nieuws';
$txt['pretty_chrome_menu_settings'] = 'Instellingen';
$txt['pretty_chrome_menu_maintenance'] = 'Onderhoud';
$txt['pretty_chrome_menu_nginx'] = 'Nginx Regels';

//	News page
$txt['pretty_chrome_caption_news'] = 'Het laatste nieuws en informatie live vanaf de projectwebsite';
$txt['pretty_chrome_page_title_news'] = 'Mooie URLs Nieuws &amp; Info';
$txt['pretty_chrome_title_news'] = 'Nieuws &amp; Info';
$txt['pretty_current_version'] = 'Huidige versie';
$txt['pretty_download'] = 'Downloaden';
$txt['pretty_latest_version'] = 'Laatste versie';
$txt['pretty_upgrade'] = 'Upgrade nu!';
$txt['pretty_version'] = 'Versie info';

//	Settings page
$txt['pretty_cant_write_htaccess'] = 'Kan bestaande .htaccess bestand niet overschrijven. Verander a.u.b. zijn schrijfrechten.';
$txt['pretty_chrome_caption_settings'] = 'Verschillende instellingen';
$txt['pretty_chrome_page_title_settings'] = 'Mooie URLs Instellingen';
$txt['pretty_core_settings'] = 'Kerninstellingen';
$txt['pretty_enable'] = 'Schakel URL herschrijven in';
$txt['pretty_filters'] = 'URL herschrijf filters';
$txt['pretty_save'] = 'Wijzigingen opslaan';

$txt['pretty_root_url'] = 'Mooie URLs Root: ';

$txt['pretty_skipactions'] = 'Lijst met te overslaan acties: ';
$txt['pretty_skipactions_note'] = 'Voer acties gescheiden door een komma in om URL herschrijven te overslaan';
$txt['pretty_bufferusecache'] = 'Gebruik caching in plaats van database tabel voor Mooie URLs';
// Tests page
$txt['pretty_chrome_caption_tests'] = 'Controleer voor het inschakelen van URL herschrijven of deze herschreven links werken.';

//	Maintenance page
$txt['pretty_chrome_caption_maintenance'] = 'Voer enkele onderhoudstaken uit';
$txt['pretty_chrome_page_title_maintenance'] = 'Mooie URLs Onderhoud';
$txt['pretty_run_maintenance'] = 'Voer onderhoudstaken uit';

//	Edit filters page
$txt['pretty_chrome_caption_filters'] = 'Een tool om het filters-array te bewerken. Het array is hier geformatteerd in het <a href="http://www.json.org/">JSON</a> formaat. Wees voorzichtig, de JSON-parser is vrij strikt.';
$txt['pretty_chrome_page_title_filters'] = 'Mooie URLs Filterhulpmiddel';
$txt['pretty_chrome_title_filters'] = 'Filterhulpmiddel';
$txt['pretty_no_json'] = 'De PHP JSON-extensie is vereist voor dit hulpmiddel. Overweeg om te upgraden naar PHP 5.2.';

// Board URLs interface
$txt['pretty_add_url'] = 'Toevoegen';
$txt['pretty_add_url_description'] = 'Voeg een URL toe. Merk op dat wat je hier invoert zal worden verwerkt omdat alleen bepaalde tekens zijn toegestaan.';
$txt['pretty_board_url_title'] = 'Mooie URLs voor: ';
$txt['pretty_deleted_board'] = 'Verwijderd bord #';
$txt['pretty_duplicate_link'] = 'verwijder het eerst.';
$txt['pretty_duplicate_warning'] = 'Die URL wordt al gebruikt door een ander bord. Het zal beschikbaar zijn als je ';
$txt['pretty_make_primary'] = 'Maak primair';
$txt['pretty_no_primary_warning'] = 'Waarschuwing, geen primaire URL!';
$txt['pretty_numerical'] = 'Sorry, maar omdat die URL ofwel een nummer is of hetzelfde als een forumactie moest de bord-ID worden toegevoegd als een achtervoegsel.';
$txt['pretty_primary_url'] = 'Primair';

$txt['pretty_chrome_menu_settings_description'] = 'Instellingen en configuratie voor Mooie URLs';
$txt['pretty_chrome_menu_maintenance_description'] = 'Voer onderhoudstaken uit voor Mooie URLs';

$txt['pretty_chrome_menu_nginx_description'] = 'Genereer Nginx-regels voor Mooie URLs. Alleen gebruikt als je Nginx-webserver gebruikt!';

$txt['pretty_nginix_note'] = 'Als je Nginx als een webserver gebruikt, hier zijn de gegenereerde regels. Elke keer als je een nieuwe mod of actie toevoegt, moet je je Nginx-regels bijwerken.';
?>