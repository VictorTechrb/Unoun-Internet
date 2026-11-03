<?php
get_header();

while ( have_posts() ) :
    the_post();

    /* ── Campos ACF ──────────────────────────────────────────── */
    $logo_app        = get_field('logo_app');
    $descricao_curta = get_field('descricao_curta');
    $categoria_app   = get_field('categoria_app');
    $cor_destaque    = get_field('cor_destaque') ?: '#672f8f';
    $link_play_store = get_field('link_play_store');
    $link_app_store  = get_field('link_app_store');
    $passos_login    = get_field('conteudo_passos_login');
    $faq_conteudo    = get_field('conteudo_perguntas_frequentes'); // ← antes nunca exibido!
    $app_title       = get_the_title();

    /* ── URLs dinâmicas ──────────────────────────────────────── */
    $whatsapp_url   = function_exists('unoun_get_whatsapp_url')
        ? unoun_get_whatsapp_url()
        : 'https://api.whatsapp.com/send/?phone=%2B558000790101&text&type=phone_number&app_absent=0';

    $archive_url    = get_post_type_archive_link('aplicativo')
        ?: get_permalink( get_page_by_path('aplicativos') )
        ?: home_url('/aplicativos/');

    $texto_wpp      = urlencode( 'Tenho dúvidas sobre como adicionar o ' . $app_title . ' ao meu plano.' );
    $whatsapp_app   = 'https://api.whatsapp.com/send/?phone=558000790101&text=' . $texto_wpp;

    /* ── Cor complementar (luminosidade) ─────────────────────── */
    $cor_light = $cor_destaque . '22'; // hex com alpha baixo para fundos
?>

<?php /* ── Schema JSON-LD (SEO) ────────────────────────────── */ ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "SoftwareApplication",
    "name": "<?php echo esc_js($app_title); ?>",
    "description": "<?php echo esc_js( wp_strip_all_tags($descricao_curta) ); ?>",
    "applicationCategory": "<?php echo esc_js($categoria_app); ?>",
    "operatingSystem": "Android, iOS"
    <?php if ($link_app_store) echo ', "downloadUrl": "' . esc_js($link_app_store) . '"'; ?>
}
</script>

<main class="apps-page-container" id="conteudo-principal">
<section class="apps-highlights-section">
<div class="apps-highlights-shell">

    <!-- ── Breadcrumbs ──────────────────────────────────────── -->
    <nav class="app-breadcrumbs" aria-label="Caminho de navegação">
        <a href="<?php echo esc_url( home_url('/') ); ?>">
            <svg viewBox="0 0 24 24" fill="none" width="13" height="13" aria-hidden="true">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
            </svg>
            Início
        </a>
        <span class="breadcrumb-sep" aria-hidden="true">›</span>
        <a href="<?php echo esc_url($archive_url); ?>">Aplicativos</a>
        <span class="breadcrumb-sep" aria-hidden="true">›</span>
        <span aria-current="page"><?php echo esc_html($app_title); ?></span>
    </nav>

    <!-- ── Hero ─────────────────────────────────────────────── -->
    <div class="app-hero">

        <div class="app-hero-logo" style="background: linear-gradient(135deg, <?php echo esc_attr($cor_destaque); ?> 0%, <?php echo esc_attr($cor_destaque); ?>bb 100%);">
            <?php if ( ! empty($logo_app) ) : ?>
                <?php echo wp_get_attachment_image( $logo_app, 'medium', false, [
                    'alt'   => esc_attr($app_title),
                    'class' => 'app-hero-logo-image',
                ]); ?>
            <?php else : ?>
                <span class="app-hero-logo-initial">
                    <?php echo esc_html( mb_substr($app_title, 0, 1) ); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="app-hero-content">
            <?php if ( ! empty($categoria_app) ) : ?>
                <p class="apps-kicker">
                    <svg viewBox="0 0 24 24" fill="none" width="12" height="12" aria-hidden="true">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    </svg>
                    <?php echo esc_html($categoria_app); ?>
                </p>
            <?php endif; ?>

            <h1><?php echo esc_html($app_title); ?></h1>

            <?php if ( ! empty($descricao_curta) ) : ?>
                <div class="app-hero-desc"><?php echo wp_kses_post($descricao_curta); ?></div>
            <?php endif; ?>

            <!-- Badges de download -->
            <?php if ( $link_app_store || $link_play_store ) : ?>
            <div class="app-download-block">
                <h3>
                    <svg viewBox="0 0 24 24" fill="none" width="18" height="18" aria-hidden="true">
                        <path d="M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2z" stroke="currentColor" stroke-width="1.8"/>
                        <path d="M8 12l3 3 5-5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Baixe o App <?php echo esc_html($app_title); ?>
                </h3>
                <p>Disponível para <strong>Android</strong> e <strong>iOS</strong>. Baixe agora e aproveite com comodidade.</p>

                <div class="app-store-badges-oficial">
                    <?php if ( ! empty($link_app_store) ) : ?>
                    <a class="store-badge-btn"
                       href="<?php echo esc_url($link_app_store); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Baixar <?php echo esc_attr($app_title); ?> na App Store (abre em nova aba)">
                        <svg viewBox="0 0 384 512" width="22" height="22" aria-hidden="true">
                            <path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
                        </svg>
                        <div class="badge-text-ui">
                            <span>Baixar na</span>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <?php endif; ?>

                    <?php if ( ! empty($link_play_store) ) : ?>
                    <a class="store-badge-btn"
                       href="<?php echo esc_url($link_play_store); ?>"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Baixar <?php echo esc_attr($app_title); ?> no Google Play (abre em nova aba)">
                        <svg viewBox="0 0 512 512" width="22" height="22" aria-hidden="true">
                            <path fill="currentColor" d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
                        </svg>
                        <div class="badge-text-ui">
                            <span>Disponível no</span>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- ── Passos de login ───────────────────────────────────── -->
    <?php if ( ! empty($passos_login) ) : ?>
    <section class="app-login-steps" aria-labelledby="login-steps-title">
        <div class="app-section-header">
            <span class="app-section-kicker">Passo a passo</span>
            <h2 id="login-steps-title">Como fazer login no <?php echo esc_html($app_title); ?></h2>
            <p>Siga as etapas abaixo e acesse em poucos minutos.</p>
        </div>
        <div class="grid-passos-login">
            <?php echo wp_kses_post($passos_login); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── FAQ ──────────────────────────────────────────────── -->
    <?php if ( ! empty($faq_conteudo) ) : ?>
    <section class="app-faq-section" aria-labelledby="faq-title">
        <div class="app-section-header">
            <span class="app-section-kicker">Dúvidas frequentes</span>
            <h2 id="faq-title">Perguntas sobre o <?php echo esc_html($app_title); ?></h2>
        </div>
        <div class="app-faq-list">
            <?php echo wp_kses_post($faq_conteudo); ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── Outros aplicativos ───────────────────────────────── -->
    <?php
    $outros_apps = new WP_Query([
        'post_type'      => 'aplicativo',
        'posts_per_page' => 3,
        'post__not_in'   => [ get_the_ID() ],
        'orderby'        => 'rand',
    ]);

    if ( $outros_apps->have_posts() ) : ?>
    <section class="app-related-section" aria-labelledby="related-title">
        <div class="app-section-header">
            <span class="app-section-kicker">Mais aplicativos</span>
            <h2 id="related-title">Conheça outros apps do seu plano</h2>
        </div>
        <div class="app-related-grid">
            <?php while ( $outros_apps->have_posts() ) : $outros_apps->the_post();
                $r_logo   = get_field('logo_app');
                $r_desc   = get_field('descricao_curta');
                $r_cor    = get_field('cor_destaque') ?: '#672f8f';
                $r_cat    = get_field('categoria_app');
            ?>
            <a href="<?php the_permalink(); ?>" class="app-related-card">
                <div class="app-related-logo" style="background: linear-gradient(135deg, <?php echo esc_attr($r_cor); ?>, <?php echo esc_attr($r_cor); ?>bb);">
                    <?php if ( $r_logo ) :
                        echo wp_get_attachment_image( $r_logo, 'thumbnail', false, ['alt' => esc_attr(get_the_title()), 'class' => 'app-related-logo-img'] );
                    else : ?>
                        <span><?php echo esc_html( mb_substr(get_the_title(), 0, 1) ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="app-related-info">
                    <?php if ($r_cat) : ?>
                        <p class="app-related-cat"><?php echo esc_html($r_cat); ?></p>
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <?php if ($r_desc) : ?>
                        <p class="app-related-desc"><?php echo esc_html( wp_trim_words( wp_strip_all_tags($r_desc), 12 ) ); ?></p>
                    <?php endif; ?>
                    <span class="app-related-link">
                        Ver como acessar
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <div class="app-related-cta">
            <a href="<?php echo esc_url($archive_url); ?>" class="btn-ver-todos">
                Ver todos os aplicativos
                <svg viewBox="0 0 24 24" fill="none" width="16" height="16" aria-hidden="true">
                    <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- ── CTA WhatsApp ─────────────────────────────────────── -->
    <section class="app-cta-box" aria-labelledby="cta-title">
        <div class="app-cta-inner">
            <div class="app-cta-icon" aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="currentColor" width="32" height="32">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.549 4.107 1.51 5.842L.057 23.885a.5.5 0 0 0 .613.613l6.043-1.453A11.942 11.942 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.374l-.36-.214-3.724.895.912-3.63-.235-.373A9.79 9.79 0 0 1 2.182 12C2.182 6.565 6.565 2.182 12 2.182c5.434 0 9.818 4.383 9.818 9.818 0 5.434-4.384 9.818-9.818 9.818z"/>
                </svg>
            </div>
            <div class="app-cta-text">
                <h2 id="cta-title">Ainda com dúvidas sobre o <?php echo esc_html($app_title); ?>?</h2>
                <p>Nossa equipe está pronta para ajudar você a configurar e aproveitar ao máximo o seu plano.</p>
            </div>
            <a class="app-cta-btn"
               href="<?php echo esc_url($whatsapp_app); ?>"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="Falar no WhatsApp sobre <?php echo esc_attr($app_title); ?> (abre em nova aba)">
                <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                    <path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.549 4.107 1.51 5.842L.057 23.885a.5.5 0 0 0 .613.613l6.043-1.453A11.942 11.942 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.374l-.36-.214-3.724.895.912-3.63-.235-.373A9.79 9.79 0 0 1 2.182 12C2.182 6.565 6.565 2.182 12 2.182c5.434 0 9.818 4.383 9.818 9.818 0 5.434-4.384 9.818-9.818 9.818z"/>
                </svg>
                Falar no WhatsApp
            </a>
        </div>
    </section>

</div>
</section>
</main>
<script>
// Bloqueia o botão direito do mouse
document.addEventListener('contextmenu', event => event.preventDefault());

// Bloqueia teclas de atalho de desenvolvedor
document.addEventListener('keydown', event => {
    // Bloqueia F12
    if (event.key === 'F12' || event.keyCode === 123) {
        event.preventDefault();
    }
    
    // Bloqueia Ctrl+Shift+I, Ctrl+Shift+C, Ctrl+Shift+J
    if (event.ctrlKey && event.shiftKey && (event.key === 'I' || event.key === 'i' || event.key === 'C' || event.key === 'c' || event.key === 'J' || event.key === 'j')) {
        event.preventDefault();
    }
    
    // Bloqueia Ctrl+U (Ver código-fonte)
    if (event.ctrlKey && (event.key === 'U' || event.key === 'u')) {
        event.preventDefault();
    }
});
</script>

<?php endwhile; ?>
<?php get_footer(); ?>