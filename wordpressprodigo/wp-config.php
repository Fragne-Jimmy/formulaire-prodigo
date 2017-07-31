<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'local-prodigo-dev');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'adminProdigo');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'adminProdigo');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'ZmDHL}$^!*~5S,AOr?E3_;-?gqJ&5Cp=Iv/W;!ma<V`gCeq(Cf}wipq(G[`|Xp;]');
define('SECURE_AUTH_KEY',  'sS/k.O:$^ggQzY*:bj)HeLAW|wKzc8_IRKHxKDmFHq`/?d1AL:`{(O~(jJ|zx+:L');
define('LOGGED_IN_KEY',    'aps1*Z!B^SYB-!2ia(70[LRt5m6RTdh73yBcOO-e?ZG~VTkB6WXhNRdbI>~enRA@');
define('NONCE_KEY',        '0EfP^tTp3Axm,TV^h*Mb%_YrjB$~z<1qqm<+7nLv_!WTR1u.cT4R0j0^y`jS*n2]');
define('AUTH_SALT',        'K>ZLIF]Y9Kuoo6I?ERx6{i]Yl9V~n${6}xhXS^ECszXKDX8 XIHnhstbjtc+GSU&');
define('SECURE_AUTH_SALT', '(RG;O[cb4Wr63PvCL/xj*a7tx]DH)4!W+dRd D.xN>D^:3pMpkk)gHU;A[9&EkO%');
define('LOGGED_IN_SALT',   'z^@3WR]oTl#bEJ7Xk`O~dh38de<9oWzAqR].LaS5lhL50A9QBVY&~Js-k0FI@[gA');
define('NONCE_SALT',       'eaI}TOc.xU@`;7TmkzVs.qeJdtT;u^_)VaxC2xY-Z`NY6Ol%OSNk(1TVut o}|VZ');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wor';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
