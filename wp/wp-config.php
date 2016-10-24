<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'ambiente_wordpress');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'ana22luiza');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Y|!FtM(nIPTtm3J^ELXQ~Wz K2jx XhWxC1?1=Qon+zt=1=!-{q&XA.w|H?|>@Nz');
define('SECURE_AUTH_KEY',  'o_+(q?&ITttvr%@{r:p?:BER$tWWxOop+RNr!MAou_LXv.7Rxhz0?OR|YY?[`N,l');
define('LOGGED_IN_KEY',    'uL%yyN[6x?D$P79 D:}P0>{}UWUpqS9}|ccf`khrdO ?I/9=RY!ik9jlj:6.z.-+');
define('NONCE_KEY',        'mkxpCE}F6-#^Ka-3ca3BmJ|--0*Le,?BAw_{xM-.4JE!h8M,^Vw@Y7ucz&yI-8.o');
define('AUTH_SALT',        '3rS=iJ-}6KNpt9a!L1:EWg3aRm-8FpOy2?`D.+DkMc+]t gju@|}c9qxpM2>X?fC');
define('SECURE_AUTH_SALT', '1T.>(:{:rI<U<U(ejykoLUyV|2g1){nKtH`{OT<K>U^+^L^9?WaoY^`[3r]DS:*:');
define('LOGGED_IN_SALT',   'UsH$G=Tx98g)KO[Q8.$cyo(@T-=X}$U/}-~HT!%+?DgFFUw r4g_qh-:u#w!E}0=');
define('NONCE_SALT',       ' :m5{WhvQkxj+95+Vg5cwl{2[$|sbu.%32a`-FgDadW=Xlt-=T&[K35Lry$nnQv=');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_HOME','http://localhost/ambientelab/index.php/revista');