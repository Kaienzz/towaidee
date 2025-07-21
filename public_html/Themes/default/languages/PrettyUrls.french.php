<?php
//	Version: 0.9; PrettyUrls

require_once(dirname(__FILE__) . '/PrettyUrls.english.php');

//	Admin chrome
$txt['pretty_chrome_install_title'] = 'Installation de Pretty URLs';
$txt['pretty_install_success'] = 'Merci d\'utiliser <b>Pretty URLs</b>! L\'installation a réussi!';
$txt['pretty_install_continue'] = 'Veuillez continuer vers la page d\'administration, où vous pouvez activer la réécriture d\'URL.';
//	Admin chrome
$txt['pretty_chrome_title'] = 'Administration de Pretty URLs';
$txt['pretty_chrome_menu_news'] = 'Nouvelles';
$txt['pretty_chrome_menu_settings'] = 'Param&egrave;tres';
$txt['pretty_chrome_menu_maintenance'] = 'Maintenance';
$txt['pretty_chrome_menu_nginx'] = 'Règles Nginx';

//	News page
$txt['pretty_chrome_caption_news'] = 'Les dernières nouvelles et informations en direct du site du projet';
$txt['pretty_chrome_page_title_news'] = 'Nouvelles &amp; Info de Pretty URLs';
$txt['pretty_chrome_title_news'] = 'Nouvelles &amp; Info';
$txt['pretty_current_version'] = 'Version actuelle';
$txt['pretty_download'] = 'Télécharger';
$txt['pretty_latest_version'] = 'Dernière version';
$txt['pretty_upgrade'] = 'Mettre à jour maintenant!';
$txt['pretty_version'] = 'Info de version';
//	Settings page
$txt['pretty_cant_write_htaccess'] = 'Impossible de remplacer le fichier .htaccess existant. Veuillez modifier ses permissions d\'écriture.';
$txt['pretty_chrome_caption_settings'] = 'Titre des param&egrave;tres';
$txt['pretty_chrome_page_title_settings'] = 'Param&egrave;tres de Pretty URLs';
$txt['pretty_core_settings'] = 'Param&egrave;tres principaux';
$txt['pretty_enable'] = 'Autoriser la r&eacute;&eacute;criture des URLs';
$txt['pretty_filters'] = 'Filtres de r&eacute;&eacute;criture des URLs';
$txt['pretty_save'] = 'Sauvegarder les modifications';

$txt['pretty_root_url'] = 'Racine de Pretty Urls : ';

$txt['pretty_skipactions'] = 'Liste des actions à ignorer : ';
$txt['pretty_skipactions_note'] = 'Entrez les actions à ignorer, séparées par une virgule, pour sauter la réécriture d\'url';
$txt['pretty_bufferusecache'] = 'Utilisez le cache au lieu de la table de base de données pour PrettyUrls';
// Tests page
$txt['pretty_chrome_caption_tests'] = 'Avant d\'activer la réécriture d\'URL, veuillez vérifier que ces liens réécrits fonctionnent.';

//	Maintenance page
$txt['pretty_chrome_caption_maintenance'] = 'Exécutez certaines tâches de maintenance';
$txt['pretty_chrome_page_title_maintenance'] = 'Maintenance de Pretty URLs';
$txt['pretty_run_maintenance'] = 'Exécuter les tâches de maintenance';

//	Edit filters page
$txt['pretty_chrome_caption_filters'] = 'Un outil pour éditer le tableau de filtres. Le tableau est formaté ici en format <a href="http://www.json.org/">JSON</a>. Soyez prudent, l\'analyseur JSON est assez strict.';
$txt['pretty_chrome_page_title_filters'] = 'Outil de filtres de Pretty URLs';
$txt['pretty_chrome_title_filters'] = 'Outil de filtres';
$txt['pretty_no_json'] = 'L\'extension PHP JSON est requise pour cet outil. Considérez la mise à niveau vers PHP 5.2.';

// Board URLs interface
$txt['pretty_add_url'] = 'Ajouter';
$txt['pretty_add_url_description'] = 'Ajouter une URL. Notez que ce que vous entrez ici sera traité car seuls certains caractères sont autorisés.';
$txt['pretty_board_url_title'] = 'Pretty URLs pour : ';
$txt['pretty_deleted_board'] = 'Supprimé le forum #';
$txt['pretty_duplicate_link'] = 'supprimez-le d\'abord.';
$txt['pretty_duplicate_warning'] = 'Cette URL est déjà utilisée par un autre forum. Elle sera disponible si vous ';
$txt['pretty_make_primary'] = 'Rendre primaire';
$txt['pretty_no_primary_warning'] = 'Attention, pas d\'URL primaire !';
$txt['pretty_numerical'] = 'Désolé, mais comme cette URL est soit un nombre soit la même qu\'une action du forum, l\'ID du forum a dû être ajouté comme suffixe.';
$txt['pretty_primary_url'] = 'Primaire';

$txt['pretty_chrome_menu_settings_description'] = 'Paramètres et configuration pour Pretty Urls';
$txt['pretty_chrome_menu_maintenance_description'] = 'Exécutez toutes les tâches de maintenance pour Pretty Urls';

$txt['pretty_chrome_menu_nginx_description'] = 'Générer des règles Nginx pour Pretty Urls. Utilisé uniquement si vous utilisez le serveur Web Nginx !';

$txt['pretty_nginix_note'] = 'Si vous utilisez Nginx comme serveur Web, voici les règles générées. Chaque fois que vous ajoutez un nouveau mod ou une action, vous devrez mettre à jour vos règles Nginx.';
?>