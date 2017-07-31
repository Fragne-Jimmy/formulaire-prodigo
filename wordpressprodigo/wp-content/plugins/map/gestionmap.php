<?php

class Map_GestionMap
{
  public function __construct() // constructeur
  {
    add_action('admin_menu', array($this, 'add_admin_menu'), 20);
    add_action('wp_loaded', array($this, 'manage_text')); // construct ranger texte db map_text
    add_action('wp_loaded', array($this, 'get_all_text')); // construct récupérer texte db map_text
    add_action('wp_loaded', array($this, 'get_all_champs')); // construct récupérer champs db modif_champ
    add_action('show_map_render', array($this, 'render_map'));
    add_shortcode('map_recent_form', array($this, 'render_map')); // construct shortcode
  }
  public static function install() // création db table
  {
    global $wpdb; // appel db wordpress
    $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}map_text (id INT AUTO_INCREMENT PRIMARY KEY, libelle VARCHAR(30) NOT NULL, contenu TEXT NOT NULL, emplacement INT NOT NULL)"); // crétion table map_text avec comme champs : id, libelle, contenu et emplacement
    $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}modif_champ (id INT AUTO_INCREMENT PRIMARY KEY, titre VARCHAR(30) NOT NULL, content TEXT NOT NULL, emplacement INT NOT NULL)"); // crétion table modif_champ avec comme champs : id, titre, content et emplacement
  }

  public static function uninstall() // suppr table
  {
    global $wpdb; // appel db wordpress
    $wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}map_text;"); // supprimer une table déjà existente
  }

  public function add_admin_menu()// sous-menus du plugin : Ordre d'apparition et Rendu textuel
  {
    add_submenu_page('description', 'Ordre d\'apparition du map', 'Ordre d\'apparition', 'manage_options', 'text_order', array($this, 'menu_html')); // sous-menu Ordre d'apparition
    add_submenu_page('description', 'Rendu textuel du map', 'Rendu textuel', 'manage_options', 'map_text', array($this, 'rendu_html')); // sous-menu Rendu textuel
    add_submenu_page('description', 'Champs du formulaire', 'Formulaire', 'manage_options', 'modif_champ', array($this, 'formulaire_html')); // sous-menu Modif champ
  }

  public function menu_html() // contenu page sous-menu Ordre d'apparition
  {
     echo '<h1>'.get_admin_page_title().'</h1>'; // en-tête qui récupère le titre du sous-menu dans add_submenu_page
     echo "<p>Author: <a href='http://www.google.com' target='_blank'>Junier Christophe</a> &  <a href='http://www.google.com' target='_blank'>Fragne Jimmy</a></p>"; // présentation des auteurs
     echo '<h1>Description</h1>'; // en-tête
     echo '<texte>Cette page permet d\'ajouter, de modifier et de supprimer des textes directement dans la base de données. Ces derniers sont rangés par numéro d\'emplacement ce qui leurs donnent leurs position dans le futur document.</texte>'; // en-tête
     echo '<h2>Modifier/Supprimer un texte</h2>'; // en-tête

     $all_text = $_POST['all_text']; // récupère le texte pour l'affichage
     foreach($all_text as $key) {
         ?>
        <form action="" method="post"> <!-- form affichage db modif/suppr -->
          <p>Titre paragraphe / Contenu / Numéro de l'emplacement</p> <!-- aide mémoire -->
          <input type="hidden" name="id" value="<?php echo $key->id ?>"/> <!-- modif/suppr champ id -->
          <input type="text" name="libelle" value="<?php echo $key->libelle ?>"/> <!-- modif/suppr champ libelle -->
          <input style="width:500px;" type="text" name="contenu" value="<?php echo $key->contenu ?>"/> <!-- modif/suppr champ contenu -->
          <input type="number" name="emplacement" value="<?php echo $key->emplacement ?>"/> <!-- modif/suppr champ emplacement -->
          <br/><br/>
          <input type="submit" name="submit" value="Modifier" class="button button-primary"/> <!-- button modifier champ db -->
          <input type="submit" name="submit" value="Supprimer" class="button button-secondary-delete"/> <!-- button supprimer champ db -->
        </form>
        <br/>
        <br/>
        <br/>
        <br/>
      <?php }
     ?>
   <hr/>
     <h2>Ajouter un texte</h2>
     <form action="" method="post"> <!-- form ajout texte -->
       <input id="libelle" name="new_libelle" type="text" placeholder="titre du texte"/> <!-- ajout champ libelle -->
          <br/><br/>
       <input style="width:500px;" id="contenu" name="new_contenu" type="text" placeholder="contenu du texte"/> <!-- ajout champ contenu -->
          <br/><br/>
       <input id="emplacement" name="new_emplacement" type="number" placeholder="numéro emplacement"/> <!-- ajout champ emplacement -->
          <br/><br/>
       <input type="submit" name="submit" value="Ajouter" class="button button-primary"/> <!-- button ajouter champ db -->
     </form>
     <br/><br/>
     <br/><br/>
     <br/><br/>
    <?php
  }

public function rendu_html() // affiche le contenu de render_map
{
  echo '<h1>'.get_admin_page_title().'</h1>'; // en-tête qui récupère le titre du sous-menu dans add_submenu_page
  echo "<p>Author: <a href='http://www.google.com' target='_blank'>Junier Christophe</a> &  <a href='http://www.google.com' target='_blank'>Fragne Jimmy</a></p>"; // présentation des auteurs
  echo '<h2>Description</h2>'; // en-tête
  echo '<p>Voici le visuel de votre document. Les textes affichés ci-dessous sont ceux présent dans la base de données. Toutes les modifications, ajout ou suppression d\' éléments, éffectués dans la page Ordre d\'apparition seront visibles instantanément ici. Pour afficher ce texte, il suffit de copier/coller le shortcode suivant dans la page que vous désirez : [map_recent_form]</p>'; // en-tête
  echo '<h2>Visuel</h2>'; // en-tête

  do_action('show_map_render'); // récupère le contenu de render_map
}

public function render_map($param) // contenu page sous-menu Rendu textuel  /  parametre pour shortcode ($param)
{
     $all_text = $_POST['all_text']; // récupère le texte pour l'afficher dans le visuel
     foreach($all_text as $key) {
?>
     <form action="" method="post"> <!-- form affichage db -->
       <?php echo $key->libelle ?>
       <?php echo $key->contenu ?>
     </form>
          <br/>
<?php }

   extract(shortcode_atts(array('libelle' => $libelle, 'contenu' => $contenu),$param)); //création du shortcode et éléments à mettre dedans
   return $libelle . ' ' . $contenu; //création du shortcode et éléments à mettre dedans


}




public function manage_text() // ranger texte db ajout/modif/suppr
{
  if($_POST['submit'] == 'Ajouter') // ajouter élément db map_text
  {
    if(isset($_POST['new_libelle']) && isset($_POST['new_contenu']) && isset($_POST['new_emplacement']) && !empty($_POST['new_libelle']) && !empty($_POST['new_contenu']) && !empty($_POST['new_emplacement']))
    {
      global $wpdb; // appel db wordpress
      $libelle = $_POST['new_libelle']; // post champ libelle pour form ajout texte
      $contenu = $_POST['new_contenu']; // post champ contenu pour form ajout texte
      $emplacement = $_POST['new_emplacement']; // post champ emplacement pour form ajout texte
      $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}map_text WHERE libelle = '$libelle'");
      if (is_null($row)) {
        $wpdb->insert("{$wpdb->prefix}map_text", array('libelle' => $libelle, 'contenu' => $contenu, 'emplacement' => $emplacement)); // ajout élément à la db
      }
      else {
        $_POST['texte_erreur'] = "Ce libellé existe déjà, veuillez le remplacer"; // message erreur
      }
    }
  }
  else if($_POST['submit'] == 'Modifier') // modifier élément db map_text
  {
    $id = $_POST['id']; // post id pour form affichage modif
    $libelle = $_POST['libelle']; // post libelle pour form affichage modif
    $contenu = $_POST['contenu']; // post contenu pour form affichage modif
    $emplacement = $_POST['emplacement']; // post emplacement pour form affichage modif
    if(!empty($id) && !empty($libelle) && !empty($contenu) && !empty($emplacement) && $emplacement>0)
    {
      global $wpdb; // appel db wordpress
      $wpdb->query("UPDATE {$wpdb->prefix}map_text SET libelle = '$libelle', contenu = '$contenu', emplacement = '$emplacement' WHERE id = '$id' "); // modifie éléments db
    }
  }
  else if($_POST['submit'] == 'Supprimer') // supprimer élément db map_text
  {
    $id = $_POST['id']; // post champ id pour form affichage suppr
    global $wpdb; // appel db wordpress
    $wpdb->query("DELETE FROM {$wpdb->prefix}map_text WHERE id = '$id'"); // supprime élément db
  }
  else if($_POST['submit'] == "Ajouter champ") // ajout champ db modif_champ (pour page Formulaire dans formulaire_html)
  {
    if(!empty($_POST['brand_new_titre']) && !empty($_POST['brand_new_content']) && !empty($_POST['brand_new_emplacement']))
    {
      global $wpdb; // appel db wordpress
      $titre = $_POST['brand_new_titre']; // post titre pour form ajout champ
      $content = $_POST['brand_new_content']; // post content pour form ajout champ
      $emplacement = $_POST['brand_new_emplacement']; // post emplacement pour form ajout champ
      $row = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}modif_champ WHERE titre = '$titre'");
      if (is_null($row)) {
        $wpdb->insert("{$wpdb->prefix}modif_champ", array('titre' => $titre, 'content' => $content, 'emplacement' => $emplacement)); // ajout champ à la db
      }
      else {
        $_POST['formulaire_erreur'] = "Ce champ existe déjà, veuillez le modifier"; // message erreur
      }
    }
  }
   else if($_POST['submit'] == "Modifier champ") // modifie champ db modif_champ (pour page Formulaire dans formulaire_html)
   {
    $id = $_POST['id']; // post id pour form modif champ
    $titre = $_POST['titre']; // post titre pour form modif champ
    $content = $_POST['content']; // post content pour form modif chap
    $emplacement = $_POST['emplacement']; // post emplacement pour form modif champ
    if(!empty($id) && !empty($titre) && !empty($content) && !empty($emplacement) && $emplacement>0)
    {
      global $wpdb; // appel db wordpress
      $wpdb->query("UPDATE {$wpdb->prefix}modif_champ SET titre = '$titre', content = '$content', emplacement = '$emplacement' WHERE id = '$id' "); // modifie champs db
    }
   }
   else if($_POST['submit'] == "Supprimer champ") // supprime champ db modif_champ (pour page Formulaire dans formulaire_html)
  {
    $id = $_POST['id']; // post id pour form champ suppr
    global $wpdb; // appel db wordpress
    $wpdb->query("DELETE FROM {$wpdb->prefix}modif_champ WHERE id = '$id'"); // supprime champ db
   }
}



public function get_all_text() // récupérer texte db
{
  global $wpdb; // appel db wordpress
  $_POST['all_text'] = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}map_text ORDER BY emplacement ASC"); // afficher éléments de la table map_text (id, libelle, contenu, emplacement) rangé par numéro d'emplacement
}

public function get_all_champs() // récupérer champ db
{
  global $wpdb; // appel db wordpress
  $_POST['all_champs'] = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}modif_champ ORDER BY emplacement ASC"); // afficher champs de la table modif_champ (id, titre, content, emplacement) rangé par numéro d'emplacement
}

public function formulaire_html() // contenu page sous-menu Formulaire / création des champs qui serviront plutard pour la personnalisation du documents par les clients
{?>
  <h1 style="color:red"><?php get_admin_page_title() ?></h1> <!--en-tête qui récupère le titre du sous-menu dans add_submenu_page-->
  <p>Author: <a href='http://www.google.com' target='_blank'>Junier Christophe</a> &  <a href='http://www.google.com' target='_blank'>Fragne Jimmy</a></p>  <!--présentation des auteurs-->
  <h2>Description</h2> <!--en-tête-->
  <p>Ici, il est possible de créer des champs qui seront modifiables par l'utilisateur tel que son nom, prénom, adresse... pour que le document précédement créer soit personnalisé. </p>

  <?php
  $all_champs = $_POST['all_champs']; // récupère le champ pour l'affichage
  foreach($all_champs as $key) { ?>
  <form action="" method="post"> <!-- form champ affichage db modif_champ modif/suppr -->
    <p>Titre champ / Contenu / Numéro de l'emplacement</p> <!-- aide mémoire -->
    <input type="hidden" name="id" value="<?php echo $key->id ?>"/> <!-- modif/suppr champ id -->
    <input type="text" name="titre" value="<?php echo $key->titre ?>"/> <!-- modif/suppr champ titre -->
    <input type="text" name="content" value="<?php echo $key->content ?>"/> <!-- modif/suppr champ content -->
    <input type="number" name="emplacement" value="<?php echo $key->emplacement ?>"/> <!-- modif/suppr champ emplacement -->
    <br/><br/>
    <input type="submit" name="submit" value="Modifier champ" class="button button-primary"/> <!-- button modifier champ db -->
    <input type="submit" name="submit" value="Supprimer champ" class="button button-secondary-delete"/> <!-- button supprimer champ db -->
  </form>
  <?php } ?>
  <br/>
  <br/>
  <br/>
  <br/>
  <hr/>

  <h2>Ajouter un champ</h2>
  <form action="" method="post"> <!-- form ajout texte -->
    <input id="titre" name="brand_new_titre" type="text" placeholder="titre du champ"/> <!-- ajout champ titre -->
      <br/><br/>
    <input id="content" name="brand_new_content" type="text" placeholder="contenu du champ"/> <!-- ajout champ content -->
      <br/><br/>
    <input id="emplacement" name="brand_new_emplacement" type="number" placeholder="numéro emplacement"/> <!-- ajout champ emplacement -->
      <br/><br/>
    <input type="submit" name="submit" value="Ajouter champ" class="button button-primary"/> <!-- button ajouter champ db -->
  </form>

  <br/><br/>
  <br/><br/>
  <br/><br/>
    <?php
  }







}
 ?>
