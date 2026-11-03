<?php
/**
 * Functions and definitions - Tema Customizado UNOUN / VictorTech
 */

/* ═══════════════════════════════════════════════════════════
   MENUS DE NAVEGAÇÃO
═══════════════════════════════════════════════════════════ */
function unoun_registrar_menus() {
    register_nav_menus([
        'menu-principal' => __('Menu Principal', 'unoun'),
        'menu-footer'    => __('Menu Rodapé', 'unoun'),
    ]);
}
add_action('init', 'unoun_registrar_menus');


/* ═══════════════════════════════════════════════════════════
   SCRIPTS E ESTILOS
═══════════════════════════════════════════════════════════ */
function unoun_enqueue_assets() {
    // 1. Stylesheet principal do tema (style.css na raiz)
    wp_enqueue_style(
        'unoun-theme',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // 2. CSS exclusivo do header
    wp_enqueue_style(
        'unoun-header',
        get_template_directory_uri() . '/header.css',
        ['unoun-theme'],
        '1.0.0'
    );

    // 3. CSS exclusivo do footer
    wp_enqueue_style(
        'unoun-footer',
        get_template_directory_uri() . '/footer.css',
        ['unoun-theme'],
        '1.0.0'
    );

    // CSS exclusivo da página Sobre
    if ( is_page('sobre-nos') || is_page('page-sobre') || is_page_template('page-sobre-nos.php') || is_page_template('page-sobre.php') ) {
        $sobre_css = get_template_directory() . '/page-sobre.css';
        wp_enqueue_style(
            'unoun-page-sobre',
            get_template_directory_uri() . '/page-sobre.css',
            ['unoun-theme'],
            file_exists($sobre_css) ? filemtime($sobre_css) : '1.0.0'
        );
    }

    // 4. CSS exclusivo para single 'aplicativo'
    if ( function_exists('is_singular') && is_singular('aplicativo') ) {
        wp_enqueue_style(
            'unoun-single-aplicativo',
            get_template_directory_uri() . '/single-aplicativo.css',
            ['unoun-theme'],
            '1.0.0'
        );
    }

    // 5. CSS exclusivo para archive do post type 'aplicativo'
    if ( function_exists('is_post_type_archive') && is_post_type_archive('aplicativo') ) {
        wp_enqueue_style(
            'unoun-archive-aplicativo',
            get_template_directory_uri() . '/archive-aplicativo.css',
            ['unoun-theme'],
            '1.0.0'
        );
    }

    // Menu mobile toggle (header.js)
    wp_enqueue_script(
        'unoun-header',
        get_template_directory_uri() . '/header.js',
        [],
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'unoun_enqueue_assets');


/* ═══════════════════════════════════════════════════════════
   WHATSAPP — URL centralizada para todo o tema
═══════════════════════════════════════════════════════════ */
function unoun_get_whatsapp_url() {
    if ( function_exists('get_field') ) {
        $acf_url = get_field('whatsapp_url', 'option');
        if ( ! empty($acf_url) ) return esc_url($acf_url);
    }

    return 'https://api.whatsapp.com/send/?phone=%2B558000790101&text&type=phone_number&app_absent=0';
}


/* ═══════════════════════════════════════════════════════════
   CUSTOM POST TYPES
═══════════════════════════════════════════════════════════ */
require_once get_template_directory() . '/inc/cpt-aplicativos.php';
require_once get_template_directory() . '/inc/cpt-aplicativos-inclusos.php';

/* ═══════════════════════════════════════════════════════════
   CONFIGURAÇÕES DOS PLANOS
═══════════════════════════════════════════════════════════ */
function unoun_register_planos_options_page() {
    add_menu_page(
        'Planos de Internet',
        'Planos',
        'manage_options',
        'unoun-planos',
        'unoun_render_planos_admin_page',
        'dashicons-chart-area',
        25.5
    );
}
add_action('admin_menu', 'unoun_register_planos_options_page', 20);

function unoun_get_plano_setting($field, $fallback) {
    $value = get_option($field, null);
    if ($value === null && function_exists('get_field')) {
        $value = get_field($field, 'option');
    }
    return ($value === null || $value === false || $value === '') ? $fallback : $value;
}

function unoun_render_planos_admin_page() {
    if ( ! current_user_can('manage_options') ) {
        wp_die('Você não tem permissão para editar os planos.');
    }

    if ( isset($_POST['unoun_planos_nonce']) && wp_verify_nonce(
        sanitize_text_field(wp_unslash($_POST['unoun_planos_nonce'])),
        'unoun_salvar_planos'
    ) ) {
        $campos = [
            'plano_500_megas' => ['tipo' => 'inteiro', 'fallback' => 500],
            'plano_500_preco' => ['tipo' => 'preco', 'fallback' => 89.90],
            'plano_700_megas' => ['tipo' => 'inteiro', 'fallback' => 700],
            'plano_700_preco' => ['tipo' => 'preco', 'fallback' => 109.90],
            'plano_800_megas' => ['tipo' => 'inteiro', 'fallback' => 800],
            'plano_800_preco' => ['tipo' => 'preco', 'fallback' => 114.90],
            'plano_500_descricao' => ['tipo' => 'texto', 'fallback' => ''],
            'plano_700_descricao' => ['tipo' => 'texto', 'fallback' => ''],
            'plano_800_descricao' => ['tipo' => 'texto', 'fallback' => ''],
            'apps_inclusos_colunas' => ['tipo' => 'inteiro', 'fallback' => 4, 'min' => 1, 'max' => 6],
            'apps_inclusos_linhas' => ['tipo' => 'inteiro', 'fallback' => 2, 'min' => 1, 'max' => 10],
        ];

        foreach ($campos as $campo => $config) {
            $valor = isset($_POST[$campo]) ? wp_unslash($_POST[$campo]) : $config['fallback'];
            if ($config['tipo'] === 'texto') {
                update_option($campo, sanitize_textarea_field($valor));
                continue;
            }
            $valor = $config['tipo'] === 'inteiro' ? absint($valor) : (float) str_replace(',', '.', $valor);
            if (isset($config['min'])) {
                $valor = max($config['min'], $valor);
            }
            if (isset($config['max'])) {
                $valor = min($config['max'], $valor);
            }
            update_option($campo, $valor > 0 ? $valor : $config['fallback']);
        }

        echo '<div class="notice notice-success is-dismissible"><p>Planos atualizados com sucesso.</p></div>';
    }
    ?>
    <div class="wrap">
        <h1>Planos de Internet</h1>
        <p>Altere a velocidade e o preço promocional exibidos na página inicial.</p>
        <form method="post">
            <?php wp_nonce_field('unoun_salvar_planos', 'unoun_planos_nonce'); ?>
            <table class="form-table" role="presentation">
                <?php foreach ([500, 700, 800] as $plano): ?>
                    <tr>
                        <th scope="row"><label for="plano_<?php echo esc_attr($plano); ?>_megas">Plano <?php echo esc_html($plano); ?></label></th>
                        <td>
                            <input name="plano_<?php echo esc_attr($plano); ?>_megas" id="plano_<?php echo esc_attr($plano); ?>_megas" type="number" min="1" step="1" value="<?php echo esc_attr(get_option("plano_{$plano}_megas", $plano)); ?>" class="small-text">
                            <label for="plano_<?php echo esc_attr($plano); ?>_preco">Mega</label>
                            &nbsp;&nbsp;
                            <input name="plano_<?php echo esc_attr($plano); ?>_preco" id="plano_<?php echo esc_attr($plano); ?>_preco" type="number" min="0" step="0.01" value="<?php echo esc_attr(get_option("plano_{$plano}_preco", $plano === 500 ? 89.90 : ($plano === 700 ? 109.90 : 114.90))); ?>" class="small-text">
                            <label for="plano_<?php echo esc_attr($plano); ?>_preco">Preço (R$)</label>
                            <br><br>
                            <label for="plano_<?php echo esc_attr($plano); ?>_descricao"><strong>Descrição abaixo do valor</strong></label><br>
                            <textarea name="plano_<?php echo esc_attr($plano); ?>_descricao" id="plano_<?php echo esc_attr($plano); ?>_descricao" rows="2" cols="50" placeholder="Ex.: Instalação grátis e Wi-Fi incluso."><?php echo esc_textarea(get_option("plano_{$plano}_descricao", '')); ?></textarea>
                            <p class="description">Texto pequeno exibido logo abaixo do preço deste plano.</p>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <th scope="row"><label for="apps_inclusos_colunas">Aplicativos inclusos</label></th>
                    <td>
                        <input name="apps_inclusos_colunas" id="apps_inclusos_colunas" type="number" min="1" max="6" step="1" value="<?php echo esc_attr(get_option('apps_inclusos_colunas', 4)); ?>" class="small-text">
                        <label for="apps_inclusos_colunas">Colunas</label>
                        &nbsp;&nbsp;
                        <input name="apps_inclusos_linhas" id="apps_inclusos_linhas" type="number" min="1" max="10" step="1" value="<?php echo esc_attr(get_option('apps_inclusos_linhas', 2)); ?>" class="small-text">
                        <label for="apps_inclusos_linhas">Linhas</label>
                        <p class="description">Define a organização dos ícones de aplicativos inclusos nos cards dos planos.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button('Salvar planos'); ?>
        </form>
    </div>
    <?php
}

/* ═══════════════════════════════════════════════════════════
   SEED DE DADOS (somente em ambiente de desenvolvimento)
═══════════════════════════════════════════════════════════ */
if ( defined('WP_DEBUG') && WP_DEBUG ) {
    require_once get_template_directory() . '/inc/aplicativos-seed.php';
}


/* ═══════════════════════════════════════════════════════════
   SUPORTE A FUNCIONALIDADES DO WORDPRESS
═══════════════════════════════════════════════════════════ */
function unoun_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
    ]);

    global $content_width;
    if ( ! isset($content_width) ) $content_width = 1200;
}
add_action('after_setup_theme', 'unoun_theme_setup');


/* ═══════════════════════════════════════════════════════════
   PERSONALIZAÇÃO DA TELA DE LOGIN (VICTOR TECH)
═══════════════════════════════════════════════════════════ */
function unoun_custom_login_styles() {
    ?>
    <style type="text/css">
        /* Fundo limpo em Branco */
        body.login {
            background: #ffffff !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        .login h1 {
            text-align: center !important;
            margin-bottom: 15px !important;
        }

        /* Logotipo / Imagem VictorTech */
        .login h1 a {
            display: inline-block !important;
            width: 320px !important;
            max-width: 100% !important;
            height: 140px !important;
            background-color: transparent !important;
            background-image: url('<?php echo esc_url( get_stylesheet_directory_uri() . '/imag/victorTech-unoun.png' ); ?>') !important;
            background-size: contain !important;
            background-repeat: no-repeat !important;
            background-position: center center !important;
            border: 0 !important;
            box-shadow: none !important;
            text-indent: -9999px !important;
            overflow: hidden !important;
            margin: 0 auto !important;
            padding: 0 !important;
            transition: transform 0.2s ease;
            text-decoration: none !important;
        }

        .login h1 a:hover {
            transform: scale(1.02);
        }

        /* Caixa de Login Sofisticada */
        .login form {
            background: #ffffff !important;
            border-radius: 16px !important;
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.06), 0 2px 6px rgba(0, 0, 0, 0.04) !important;
            border: 1px solid rgba(0, 0, 0, 0.04) !important;
            padding: 35px 30px !important;
        }

        /* Campos de Entrada (Inputs) */
        .login form input[type="text"],
        .login form input[type="password"] {
            border-radius: 8px !important;
            border-color: #ddd !important;
            padding: 10px 14px !important;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.02) !important;
        }
        .login form input[type="text"]:focus,
        .login form input[type="password"]:focus {
            border-color: #672f8f !important;
            box-shadow: 0 0 0 2px rgba(103, 47, 143, 0.15) !important;
        }

        /* Botão principal de login */
        .login .button.button-primary {
            background: #20B765 !important;
            border-color: #20B765 !important;
            border-radius: 8px !important;
            height: 42px !important;
            line-height: 42px !important;
            font-size: 15px !important;
            font-weight: 600 !important;
            text-shadow: none !important;
            box-shadow: 0 4px 12px rgba(32, 183, 101, 0.25) !important;
            transition: all 0.3s ease;
            width: 100% !important;
            float: none !important;
        }
        .login .button.button-primary:hover {
            background: #168A4B !important;
            border-color: #168A4B !important;
            box-shadow: 0 6px 16px rgba(32, 183, 101, 0.35) !important;
        }

        /* Links de Ajuda (Agora escuros para destacar no fundo branco) */
        .login #nav, .login #backtoblog {
            text-align: center !important;
            padding: 0 !important;
            margin-top: 20px !important;
        }
        .login #nav a, .login #backtoblog a {
            color: #555555 !important;
            font-weight: 500;
            transition: color 0.2s;
        }
        .login #nav a:hover, .login #backtoblog a:hover {
            color: #672f8f !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var logoLink = document.querySelector('.login h1 a');
            if (logoLink) {
                logoLink.href = 'https://wa.me/557981681054';
                logoLink.target = '_blank';
                logoLink.rel = 'noopener noreferrer';
            }
        });
    </script>
    <?php
}
add_action('login_enqueue_scripts', 'unoun_custom_login_styles');


/* ═══════════════════════════════════════════════════════════
   CORREÇÃO DO OFFSET DA ADMIN BAR NO HEADER DO SITE
═══════════════════════════════════════════════════════════ */
function unoun_admin_bar_offset() {
    if ( ! is_admin_bar_showing() ) return;
    ?>
    <style>
        html { margin-top: 0 !important; }

        @media screen and (min-width: 783px) {
            .isp-header { top: 32px !important; }
            body        { padding-top: calc(var(--hdr-total-h, 104px) + 32px) !important; }
        }
        @media screen and (max-width: 782px) {
            .isp-header { top: 46px !important; }
            body        { padding-top: calc(var(--hdr-navbar-h, 60px) + 46px) !important; }
        }
    </style>
    <?php
}
add_action('wp_head', 'unoun_admin_bar_offset');