<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#672f8f">

    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() . '/header.css' ); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#conteudo-principal">Pular para o conteúdo</a>

<?php
/* ── URLs reutilizadas em todo o site ──────────────── */
$whatsapp_url = function_exists('unoun_get_whatsapp_url')
    ? unoun_get_whatsapp_url()
    : 'https://api.whatsapp.com/send/?phone=%2B558000790101&text&type=phone_number&app_absent=0';

$boleto_url   = get_field('link_2via_boleto', 'option')
    ?: 'https://central.unoun.com.br/central-assinante/';

$central_url  = 'https://central.unoun.com.br/central-assinante/';

/* ── Active states ─────────────────────────────────── */
$is_apps = is_post_type_archive('aplicativo') || is_singular('aplicativo') || is_page('aplicativos');
$is_home = is_front_page();
$is_sobre = is_page('sobre-nos') || is_page('page-sobre') || is_page_template('page-sobre.php');
$is_comunicados = is_post_type_archive('comunicado') || is_singular('comunicado');
?>

<header class="isp-header" role="banner">

    <!-- ══ Topbar ══════════════════════════════════════════ -->
    <div class="isp-topbar">
        <div class="isp-topbar-right">

            <a href="tel:08000790101" class="isp-topbar-phone" aria-label="Ligue grátis: 0800 079 0101">
                <svg viewBox="0 0 24 24" fill="none" width="13" height="13" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="topbar-phone-label">Suporte </span>0800 079 0101
            </a>

            <a href="<?php echo esc_url($whatsapp_url); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-wpp"
               aria-label="Falar com o suporte via WhatsApp (abre em nova aba)">
                <svg viewBox="0 0 24 24" fill="currentColor" width="14" height="14" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.549 4.107 1.51 5.842L.057 23.885a.5.5 0 0 0 .613.613l6.043-1.453A11.942 11.942 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.374l-.36-.214-3.724.895.912-3.63-.235-.373A9.79 9.79 0 0 1 2.182 12C2.182 6.565 6.565 2.182 12 2.182c5.434 0 9.818 4.383 9.818 9.818 0 5.434-4.384 9.818-9.818 9.818z"/>
                </svg>
                Fale Conosco
            </a>

            <a href="<?php echo esc_url($boleto_url); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="isp-topbar-boleto"
               aria-label="Emitir 2ª via do boleto (abre em nova aba)">
                <svg viewBox="0 0 24 24" fill="none" width="15" height="15" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
                Área do Cliente
            </a>

        </div>
    </div>

    <!-- ══ Navbar ═══════════════════════════════════════════ -->
    <nav class="isp-navbar" aria-label="Menu principal">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url('/') ); ?>"
           class="isp-logo"
           aria-label="UNOUN Internet — Página inicial">
            <img
                class="isp-logo-img"
                src="<?php echo esc_url( get_template_directory_uri() . '/imag/unonun-telecom-branca.webp' ); ?>"
                alt="UNOUN Internet"
                width="130"
                height="40"
                loading="eager"
                decoding="sync"
            >
        </a>

        <!-- Menu links (desktop) -->
        <div class="isp-menu" id="isp-menu-principal" role="navigation" aria-label="Links principais">
            <ul class="menu-list">
                <li>
                    <a href="<?php echo esc_url( home_url('/#plans-section') ); ?>"
                       <?php echo $is_home ? 'aria-current="page"' : ''; ?>>
                        <svg viewBox="0 0 24 24" fill="none" width="15" height="15" aria-hidden="true">
                            <path d="M2 8.5a15.5 15.5 0 0 1 20 0M5.5 12a10.5 10.5 0 0 1 13 0M9 15.5a5.5 5.5 0 0 1 6 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            <circle cx="12" cy="19" r="1.4" fill="currentColor"/>
                        </svg>
                        Internet
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url('/aplicativos/') ); ?>"
                       <?php echo $is_apps ? 'aria-current="page"' : ''; ?>>
                        <svg viewBox="0 0 24 24" fill="none" width="15" height="15" aria-hidden="true">
                            <rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="12" cy="17" r="1" fill="currentColor"/>
                        </svg>
                        Aplicativos
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url('/sobre-nos/') ); ?>"
                       <?php echo $is_sobre ? 'aria-current="page"' : ''; ?>>
                        <svg viewBox="0 0 24 24" fill="none" width="15" height="15" aria-hidden="true">
                            <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5M9 11h.01M15 11h.01" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Sobre Nós
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url('/comunicados/') ); ?>"
                       <?php echo $is_comunicados ? 'aria-current="page"' : ''; ?>>
                        <svg viewBox="0 0 24 24" fill="none" width="15" height="15" aria-hidden="true">
                           <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M14 2v6h6M8 13h8M8 17h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                       </svg>
                        Comunicados
                    </a>
                </li>
            </ul>
        </div>

        <!-- Hambúrguer mobile -->
        <button
            type="button"
            class="isp-menu-toggle"
            aria-expanded="false"
            aria-controls="isp-menu-principal"
            aria-label="Abrir menu de navegação"
        >
            <span class="isp-menu-toggle-bar"></span>
            <span class="isp-menu-toggle-bar"></span>
            <span class="isp-menu-toggle-bar"></span>
        </button>

    </nav>

</header>

<main id="conteudo-principal" tabindex="-1">