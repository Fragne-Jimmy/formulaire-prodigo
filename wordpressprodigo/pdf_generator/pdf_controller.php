<?php


$exploitant = $_POST['exploitant']; // modif clients
$adresse = $_POST['adresse']; // modif clients
$telephone = $_POST['tel']; // modif clients
$mail = $_POST['mail']; // modif clients
$date = $_POST['date']; // modif clients

$texte = $_POST['text']; // pour que l'Admin puisse modifier le texte


require 'vendor/autoload.php'; // appel du fichier du vendor avec composer

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf(); // création du pdf
$html2pdf->pdf->SetAuthor('FRAGNE Jimmy'); // propriétées du doc
$html2pdf->pdf->SetTitle('Map document'); // propriétées du doc
$html2pdf->pdf->SetSubject('This is your autorisation !');  // propriétées du doc
$html2pdf->pdf->SetKeywords('map, drone, autorisation');  // propriétées du doc
$html2pdf->pdf->SetDisplayMode('fullpage');  // affichage plein écran du pdf
$html2pdf->pdf->SetProtection(array('print','copy')); // protège le document pdf en empechant certaine fonctionnalité

$html2pdf->writeHTML(" <img src='prodigo.png' width='100'> <br/><br/> "); // contenu du pdf image
$html2pdf->writeHTML("$exploitant  <br/><br/>"); // contenu du pdf page 1
$html2pdf->writeHTML("Date :   $date <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("MANUEL D’ACTIVITES PARTICULIERES AERONEFS TELEPILOTES <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Amendement : 0 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Page : 1 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Edition : 1 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("RAPPELS<br/><br/>"); // contenu du pdf

//texte à modifier !!!
$html2pdf->writeHTML("$texte Selon l’annexe III à l’arrêté du 17 décembre 2015 relatif à la conception des aéronefs civils qui circulent sanspersonne à bord, aux conditions de leur emploi et sur les capacités requises des personnes qui les utilisent :§ 3.4.1. Un manuel d’activités particulières est requis pour l’exploitation de tout aéronef en activitésparticulières sauf pour l’exploitation d’un aérostat captif non autonome de masse inférieure ou égale à25 kilogrammes.§ 3.4.3. Le manuel d’activités particulières est amendé pour tenir compte :a) des évolutions de la règlementation ; l’exploitant dispose d’un délai d’un mois, à partir de la dated’entrée en vigueur de la modification, pour effectuer cet amendement.b) de toute modification de l’activité ayant une incidence sur le manuel.§ 3.4.4. L’exploitant archive le manuel d’activités particulières et tous ses amendements.§ 3.4.5. Le ministre chargé de l’aviation civile peut imposer des modifications au manuel d’activitésparticulières s’il constate que l’exploitant ne respecte pas la réglementation.§ 3.5.1. L’exploitant s’assure que le manuel d’activités particulières est connu et mis en application strictepar le personnel concerné pour l’exécution des missions.§ 3.5.2. L’exploitant s’assure du niveau de compétence théorique et pratique de ses télépilotesconformément aux conditions du chapitre IV et évalue périodiquement le maintien de cette compétence.§ 3.5.3. L’exploitant établit et tient à jour un dossier pour chaque télépilote contenant notamment lescertificats et titres aéronautiques détenus et les justificatifs des formations reçues et des évaluations decompétence. Sur demande, l’exploitant met ce dossier à disposition du télépilote concerné et des autorités.CONSIGNES POUR RENSEIGNER ET GERER LE MAP- Toutes les informations contenues dans le MAP doivent être tenues à jour.- Tous les paragraphes du MAP doivent être renseignés. Dans le cas où l’un des paragraphes ne devraitrien comporter, indiquer, le cas échéant » « Sans objet », « Néant » ou « Non concerné ».- Des indications portées en italique indiquent ce que les paragraphes doivent comporter au minimum. Cesindications doivent être supprimées dans le document final.- Le MAP doit être amendé pour tenir compte :- Des évolutions de la réglementation. Dans ce cas, l’exploitant dispose d’un délai d’un mois aprèsl’entrée en vigueur de la nouvelle règlementation pour mettre à jour son MAP. Dans l’intervalle, lesnouvelles dispositions règlementaires s’appliquent dès leur entrée en vigueur.- de toute modification de l’activité ayant une incidence sur le manuel- L’exploitant doit archiver le MAP et tous ces amendements, et les tenir à la disposition de l’autorité- Lorsqu’une modification doit être apportée au MAP, deux cas sont possibles :- Soit la modification est mineure et ne concerne que quelques pages du MAP.Un amendement au MAP sera alors réalisé.Seules les pages impactées par une modification seront à amender (le cartouche de ces pages etuniquement de ces pages devra faire apparaitre le nouveau numéro d’amendement et la date de lamodification). Toutes les autres pages du MAP ne subiront aucune modification (que ce soit dans lecontenu ou au niveau du cartouche).- Soit la modification est majeure et concerne une grande partie des pages du MAP.Dans ce cas, une nouvelle édition du MAP sera mise en place. Le cartouche de toutes les pages duMAP sera alors modifié avec le numéro et la date de la nouvelle édition.Pour tout autre renseignement voir guide DSAC « Aéronefs circulant sans personne à bord : activitésparticulières » (Parties 10, 11, 15, 16, 17)<br/><br/>"); // contenu du pdf
//texte à modifier !!!

$html2pdf->writeHTML("<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>"); // saut de lignes


$html2pdf->writeHTML(" <img src='prodigo.png' width='100'> <br/><br/> "); // contenu du pdf image
$html2pdf->writeHTML("$exploitant <br/><br/>"); // contenu du pdf page 2
$html2pdf->writeHTML("Date :   $date <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("MANUEL D’ACTIVITES PARTICULIERES AERONEFS TELEPILOTES <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Amendement : 0 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Page : 2 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Edition : 1 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("RAPPELS<br/><br/>"); // contenu du pdf

$html2pdf->writeHTML("Exploitant :   $exploitant <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Adresse :   $adresse <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Telephone :   $telephone <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("E-mail :   $mail <br/><br/>"); // contenu du pdf

$html2pdf->writeHTML("<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>"); // saut de lignes


$html2pdf->writeHTML(" <img src='prodigo.png' width='100'> <br/><br/> "); // contenu du pdf image
$html2pdf->writeHTML("$exploitant <br/><br/>"); // contenu du pdf page 3
$html2pdf->writeHTML("Date :   $date <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("MANUEL D’ACTIVITES PARTICULIERES AERONEFS TELEPILOTES <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Amendement : 0 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Page : 3 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("Edition : 1 <br/><br/>"); // contenu du pdf
$html2pdf->writeHTML("RAPPELS<br/><br/>"); // contenu du pdf


$html2pdf->writeHTML(" <br/><br/>    <table bgcolor='lightgrey' text-align='center' border='1'><tr><td text-align='center'>N° de page</td><td text-align='center'>N° amendement</td><td height='30' text-align='center'>Date</td></tr><tr><td width='200' text-align='center'>1</td><td width='200' text-align='center'>1</td><td bgcolor='#3c9091' height='30' text-align='center'>$date</td></tr><tr><td width='200' text-align='center'>2</td><td bgcolor='#3c9091' text-align='center'>$mail</td><td bgcolor='#3c9091' height='30' text-align='center'>$date</td></tr></table> "); // contenu du pdf tableau
$html2pdf->writeHTML("Ce tableau doit contenir l’intégralité des pages du MAP et les numéros d’amendement et dates associées.<br/><br/>"); // contenu du pdf


$html2pdf->writeHTML("Lorem ipsum dolor  $exploitant sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."); // contenu du pdf
$html2pdf->writeHTML("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat $telephone. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."); // contenu du pdf

$html2pdf->writeHTML(" <br/><br/>  $exploitant  <img src='prodigo.png' width='100'>  "); // contenu du pdf image



$html2pdf->output('Mymap.pdf'); // nom du pdf à télécharger ou imprimer







?>
