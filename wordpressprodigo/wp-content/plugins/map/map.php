<?php
/*
Plugin Name: map plugin
Description: Un plugin de création et de gestion de map drone.
Version: 0.1
Author: Junier Christophe & Fragne Jimmy
Author URI: http://vps330065.ovh.net/
License: GPL2
*/

class Map_Plugin
{
  public function __construct() // constructeur
  {
    include_once 'gestionmap.php'; //nouvelle page
    new Map_GestionMap(); // nouvelle class

    register_activation_hook(__FILE__,array('Map_GestionMap','install')); // crée une nouvelle table dans la db Wordpress
    register_uninstall_hook(__FILE__,array('Map_GestionMap','uninstall')); // supprime une table dans la db Wordpress
    add_action('admin_menu', array($this, 'add_admin_menu'));
  }

  public function add_admin_menu() //menu et sous-menu du plugin
  {
    add_menu_page('Notre premier plugin', 'Map Drone', 'manage_options', 'description', array($this, 'menu_html')); // menu Map Drone
    add_submenu_page('description', 'Présentation du plugin', 'Accueil', 'manage_options', 'description', array($this, 'menu_html')); // sous-menu Acceuil
  }

  public function menu_html() // contenu page Accueil
  {
    echo '<h1>'.get_admin_page_title().'</h1>'; // en-tête qui récupère le titre du sous-menu dans add_submenu_page
    echo '<p>Bienvenue sur la page d\'accueil du plugin</p>'; // en-tête
    echo '<h3>Ce plugin permet d\'ajouter, de modifier, de supprimer et de ranger tous vos paragraphes dans le but de créer un document entièrement modulable par vos soins ( onglet "Ordre d\'apparition"). Le shortcode de l\'onglet "Rendu textuel", permet l\'exportation de ce document dans toutes les pages wordpress souhaités, grâce à un simple copier/coller. Ce document est destiné à être rempli par un tiers avec ses informations personnelles, par le biais d\'un formulaire en JavaScript.</h3>'; // en-tête
    echo "<p>Author: <a href='http://www.google.com' target='_blank'>Junier Christophe</a> &  <a href='http://www.google.com' target='_blank'>Fragne Jimmy</a></p>"; // présentation des auteurs
  }


}

new Map_Plugin;
 ?>
