<?php
get_header();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<?php
$slide_keys = ['carrossel_1', 'carrossel_2', 'carrossel_3', 'carrossel_4', 'carrossel_5'];
$slides = [];

foreach ($slide_keys as $key) {
    $id = get_field($key);
    if ($id) {
        $slides[] = $id;
    }
}
?>

<?php if (!empty($slides)): ?>
    <section class="banner-swiper-section" aria-label="Carrossel de banners">
        <div class="banner-swiper-orbit banner-swiper-orbit--one" aria-hidden="true"></div>
        <div class="banner-swiper-orbit banner-swiper-orbit--two" aria-hidden="true"></div>
        <div class="banner-swiper-intro" aria-hidden="true">
            <span class="banner-swiper-intro__line"></span>
            <span>UNOUN INTERNET</span>
        </div>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($slides as $index => $imagem_id):
                    $alt = esc_attr(get_post_meta($imagem_id, '_wp_attachment_image_alt', true) ?: get_the_title($imagem_id));
                    $src = wp_get_attachment_image_url($imagem_id, 'full');
                    $srcset = wp_get_attachment_image_srcset($imagem_id, 'full');
                    $sizes = '100vw';
                    ?>
                    <div class="swiper-slide">
                        <div class="banner-slide-frame">
                            <div class="banner-slide-meta">
                                <span
                                    class="banner-slide-meta__index"><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                                <span class="banner-slide-meta__rule"></span>
                                <span
                                    class="banner-slide-meta__total"><?php echo esc_html(str_pad((string) count($slides), 2, '0', STR_PAD_LEFT)); ?></span>
                            </div>
                            <div class="banner-slide-art">
                                <div class="banner-slide-art__glow" aria-hidden="true"></div>
                                <img src="<?php echo esc_url($src); ?>" srcset="<?php echo esc_attr($srcset); ?>"
                                    sizes="<?php echo esc_attr($sizes); ?>" alt="<?php echo $alt; ?>" <?php echo $index === 0 ? 'loading="eager"' : 'loading="lazy"'; ?> decoding="async" class="swiper-slide__img">
                            </div>
                            <div class="banner-slide-caption">
                                <span class="banner-slide-caption__eyebrow">Conectividade sem limites</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (count($slides) > 1): ?>
                <div class="banner-swiper-controls">
                    <button class="swiper-button-prev" aria-label="Slide anterior"></button>
                    <div class="swiper-pagination" role="tablist" aria-label="Navegação dos slides"></div>
                    <button class="swiper-button-next" aria-label="Próximo slide"></button>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php else: ?>
    <div class="banner-swiper-empty">
        <p>Nenhuma imagem de banner configurada no painel.</p>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    (function () {
        var swiperElement = document.querySelector(".mySwiper");
        if (!swiperElement) return;

        var reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            speed: 900,
            autoplay: reducedMotion ? false : { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: { el: ".swiper-pagination", clickable: true, dynamicBullets: false },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            a11y: { prevSlideMessage: "Slide anterior", nextSlideMessage: "Próximo slide" },
            keyboard: { enabled: true },
            grabCursor: true,
        });
    })();
</script>

<section class="plans-section" id="plans-section">
    <div class="plans-header">
        <h2>Nós temos o <span>plano perfeito</span> para você!</h2>
        <p>Internet 100% Fibra Óptica com estabilidade garantida para toda a família.</p>
    </div>

    <?php
    // 1. MOTOR DE AGRUPAMENTO (LÓGICA DE PREÇOS INDIVIDUAIS POR PACOTE)
    $args_apps = array(
        'post_type' => 'aplicativo',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    );
    $query_apps = new WP_Query($args_apps);

    $categorias_dinamicas = array(
        'Standard' => array('apps' => array()),
        'Advanced' => array('apps' => array()),
        'TOP' => array('apps' => array()),
        'Premium' => array('apps' => array())
    );

    if ($query_apps->have_posts()):
        while ($query_apps->have_posts()):
            $query_apps->the_post();
            $titulo = get_the_title();

            // Puxa a logo do banco de dados (ACF)
            $logo_id = get_field('logo_app');
            $logo_url = $logo_id ? wp_get_attachment_image_url($logo_id, 'thumbnail') : '';

            // Puxa os 4 campos de preço
            $p_standard = get_field('preco_standard');
            $p_advanced = get_field('preco_advanced');
            $p_top = get_field('preco_top');
            $p_premium = get_field('preco_premium');

            // Injeta o app na categoria com a Logo inclusa
            if ($p_standard !== '' && $p_standard !== null && $p_standard !== false) {
                $categorias_dinamicas['Standard']['apps'][] = array('nome' => $titulo, 'preco' => (float) $p_standard, 'logo' => $logo_url);
            }
            if ($p_advanced !== '' && $p_advanced !== null && $p_advanced !== false) {
                $categorias_dinamicas['Advanced']['apps'][] = array('nome' => $titulo, 'preco' => (float) $p_advanced, 'logo' => $logo_url);
            }
            if ($p_top !== '' && $p_top !== null && $p_top !== false) {
                $categorias_dinamicas['TOP']['apps'][] = array('nome' => $titulo, 'preco' => (float) $p_top, 'logo' => $logo_url);
            }
            if ($p_premium !== '' && $p_premium !== null && $p_premium !== false) {
                $categorias_dinamicas['Premium']['apps'][] = array('nome' => $titulo, 'preco' => (float) $p_premium, 'logo' => $logo_url);
            }
        endwhile;
        wp_reset_postdata();
    endif;

    // 2. BUSCA DOS APPS INCLUSOS (Sem custo adicional)
    $args_apps_inclusos = array(
        'post_type' => 'aplicativo_incluso',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    );
    $query_apps_inclusos = new WP_Query($args_apps_inclusos);

    $nomes_apps_inclusos = array();
    ob_start();
    if ($query_apps_inclusos->have_posts()):
        while ($query_apps_inclusos->have_posts()):
            $query_apps_inclusos->the_post();
            $app_title_incluso = get_the_title();
            $logo_app_incluso = get_field('logo_app');
            $logo_url_incluso = is_numeric($logo_app_incluso)
                ? wp_get_attachment_image_url((int) $logo_app_incluso, 'thumbnail')
                : '';
            $nomes_apps_inclusos[] = array(
                'nome' => $app_title_incluso,
                'logo' => $logo_url_incluso ?: '',
            );
            ?>
            <div class="plan-app-icon plan-app-icon--included" title="<?php echo esc_attr($app_title_incluso); ?>">
                <?php if (!empty($logo_app_incluso)): ?>
                    <?php echo wp_get_attachment_image($logo_app_incluso, 'thumbnail', false, array('alt' => esc_attr($app_title_incluso))); ?>
                <?php else: ?>
                    <span class="app-fallback"><?php echo esc_html(mb_substr($app_title_incluso, 0, 1)); ?></span>
                <?php endif; ?>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    $html_aplicativos_inclusos = ob_get_clean();
    $catalogo_categorias = $categorias_dinamicas;

    $planos = array(
        'plano_1' => array(
            'mega' => max(1, (int) unoun_get_plano_setting('plano_500_megas', 500)),
            'preco' => max(0, (float) unoun_get_plano_setting('plano_500_preco', 89.90)),
            'descricao' => unoun_get_plano_setting('plano_500_descricao', ''),
        ),
        'plano_2' => array(
            'mega' => max(1, (int) unoun_get_plano_setting('plano_700_megas', 700)),
            'preco' => max(0, (float) unoun_get_plano_setting('plano_700_preco', 109.90)),
            'descricao' => unoun_get_plano_setting('plano_700_descricao', ''),
        ),
        'plano_3' => array(
            'mega' => max(1, (int) unoun_get_plano_setting('plano_800_megas', 800)),
            'preco' => max(0, (float) unoun_get_plano_setting('plano_800_preco', 114.90)),
            'descricao' => unoun_get_plano_setting('plano_800_descricao', ''),
        ),
    );

    foreach ($planos as &$plano) {
        $preco_formatado = number_format($plano['preco'], 2, ',', '.');
        $partes_preco = explode(',', $preco_formatado);
        $plano['preco_inteiro'] = $partes_preco[0];
        $plano['preco_centavos'] = $partes_preco[1];
        $plano['preco_formatado'] = $preco_formatado;
    }
    unset($plano);

    $apps_inclusos_colunas = min(6, max(1, absint(unoun_get_plano_setting('apps_inclusos_colunas', 4))));
    $apps_inclusos_linhas = min(10, max(1, absint(unoun_get_plano_setting('apps_inclusos_linhas', 2))));
    $apps_inclusos_grid_style = sprintf(
        '--apps-columns:%d;--apps-rows:%d;',
        $apps_inclusos_colunas,
        $apps_inclusos_linhas
    );
    ?>

    <div class="plans-grid">
        <!-- CARTÃO 1: 500 MEGA -->
        <div class="plan-card" id="card-<?php echo esc_attr($planos['plano_1']['mega']); ?>">
            <div class="plan-speed-box">
                <div class="plan-speed-number"><?php echo esc_html($planos['plano_1']['mega']); ?></div>
                <div class="plan-speed-text">MEGA</div>
            </div>
            <div class="plan-price-box">
                <span class="plan-currency">R$</span><span
                    class="plan-value"><?php echo esc_html($planos['plano_1']['preco_inteiro']); ?></span>
                <div class="plan-cents-month"><span
                        class="plan-cents">,<?php echo esc_html($planos['plano_1']['preco_centavos']); ?></span><span
                        class="plan-month">/Mês*</span>
                </div>
            </div>
            <?php if ($planos['plano_1']['descricao'] !== ''): ?>
                <p class="plan-price-description"><?php echo esc_html($planos['plano_1']['descricao']); ?></p>
            <?php endif; ?>
            <div class="plan-apps-grid">
                <h5>Incluso no plano:</h5>
                <div class="plan-apps-icons" style="<?php echo esc_attr($apps_inclusos_grid_style); ?>">
                    <?php echo $html_aplicativos_inclusos; ?></div>
            </div>
            <hr class="plan-divider">
            <div class="plan-customizer">
                <h5>Personalize seu plano:</h5>
                <div class="tier-buttons">
                    <?php foreach ($categorias_dinamicas as $nome_cat => $dados_cat):
                        if (empty($dados_cat['apps']))
                            continue;
                        $apps_json = htmlspecialchars(json_encode($dados_cat['apps']), ENT_QUOTES, 'UTF-8');
                        ?>
                        <button type="button" class="btn-tier"
                            data-plano="<?php echo esc_attr($planos['plano_1']['mega']); ?>" aria-pressed="false"
                            onclick="abrirModalApps('<?php echo esc_js($nome_cat); ?>', <?php echo $apps_json; ?>, 'total-<?php echo esc_attr($planos['plano_1']['mega']); ?>', <?php echo esc_attr($planos['plano_1']['preco']); ?>, '<?php echo esc_js($planos['plano_1']['mega']); ?>')">
                            <?php echo esc_html($nome_cat); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div class="total-display">Total: <strong
                        id="total-<?php echo esc_attr($planos['plano_1']['mega']); ?>">R$
                        <?php echo esc_html($planos['plano_1']['preco_formatado']); ?></strong></div>
                <button type="button" class="btn-contratar"
                    onclick="enviarPedido('<?php echo esc_js($planos['plano_1']['mega']); ?>', 'total-<?php echo esc_attr($planos['plano_1']['mega']); ?>')">Contratar
                    Plano</button>
            </div>
        </div>

        <!-- CARTÃO 2: 700 MEGA -->
        <div class="plan-card" id="card-<?php echo esc_attr($planos['plano_2']['mega']); ?>">
            <div class="plan-speed-box">
                <div class="plan-speed-number"><?php echo esc_html($planos['plano_2']['mega']); ?></div>
                <div class="plan-speed-text">MEGA</div>
            </div>
            <div class="plan-price-box">
                <span class="plan-currency">R$</span><span
                    class="plan-value"><?php echo esc_html($planos['plano_2']['preco_inteiro']); ?></span>
                <div class="plan-cents-month"><span
                        class="plan-cents">,<?php echo esc_html($planos['plano_2']['preco_centavos']); ?></span><span
                        class="plan-month">/Mês*</span>
                </div>
            </div>
            <?php if ($planos['plano_2']['descricao'] !== ''): ?>
                <p class="plan-price-description"><?php echo esc_html($planos['plano_2']['descricao']); ?></p>
            <?php endif; ?>
            <div class="plan-apps-grid">
                <h5>Incluso no plano:</h5>
                <div class="plan-apps-icons" style="<?php echo esc_attr($apps_inclusos_grid_style); ?>">
                    <?php echo $html_aplicativos_inclusos; ?></div>
            </div>
            <hr class="plan-divider">
            <div class="plan-customizer">
                <h5>Personalize seu plano:</h5>
                <div class="tier-buttons">
                    <?php foreach ($categorias_dinamicas as $nome_cat => $dados_cat):
                        if (empty($dados_cat['apps']))
                            continue;
                        $apps_json = htmlspecialchars(json_encode($dados_cat['apps']), ENT_QUOTES, 'UTF-8');
                        ?>
                        <button type="button" class="btn-tier"
                            data-plano="<?php echo esc_attr($planos['plano_2']['mega']); ?>" aria-pressed="false"
                            onclick="abrirModalApps('<?php echo esc_js($nome_cat); ?>', <?php echo $apps_json; ?>, 'total-<?php echo esc_attr($planos['plano_2']['mega']); ?>', <?php echo esc_attr($planos['plano_2']['preco']); ?>, '<?php echo esc_js($planos['plano_2']['mega']); ?>')">
                            <?php echo esc_html($nome_cat); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div class="total-display">Total: <strong
                        id="total-<?php echo esc_attr($planos['plano_2']['mega']); ?>">R$
                        <?php echo esc_html($planos['plano_2']['preco_formatado']); ?></strong></div>
                <button type="button" class="btn-contratar"
                    onclick="enviarPedido('<?php echo esc_js($planos['plano_2']['mega']); ?>', 'total-<?php echo esc_attr($planos['plano_2']['mega']); ?>')">Contratar
                    Plano</button>
            </div>
        </div>

        <!-- CARTÃO 3: 800 MEGA -->
        <div class="plan-card" id="card-<?php echo esc_attr($planos['plano_3']['mega']); ?>">
            <div class="plan-speed-box">
                <div class="plan-speed-number"><?php echo esc_html($planos['plano_3']['mega']); ?></div>
                <div class="plan-speed-text">MEGA</div>
            </div>
            <div class="plan-price-box">
                <span class="plan-currency">R$</span><span
                    class="plan-value"><?php echo esc_html($planos['plano_3']['preco_inteiro']); ?></span>
                <div class="plan-cents-month"><span
                        class="plan-cents">,<?php echo esc_html($planos['plano_3']['preco_centavos']); ?></span><span
                        class="plan-month">/Mês*</span>
                </div>
            </div>
            <?php if ($planos['plano_3']['descricao'] !== ''): ?>
                <p class="plan-price-description"><?php echo esc_html($planos['plano_3']['descricao']); ?></p>
            <?php endif; ?>
            <div class="plan-apps-grid">
                <h5>Incluso no plano:</h5>
                <div class="plan-apps-icons" style="<?php echo esc_attr($apps_inclusos_grid_style); ?>">
                    <?php echo $html_aplicativos_inclusos; ?></div>
            </div>
            <hr class="plan-divider">
            <div class="plan-customizer">
                <h5>Personalize seu plano:</h5>
                <div class="tier-buttons">
                    <?php foreach ($categorias_dinamicas as $nome_cat => $dados_cat):
                        if (empty($dados_cat['apps']))
                            continue;
                        $apps_json = htmlspecialchars(json_encode($dados_cat['apps']), ENT_QUOTES, 'UTF-8');
                        ?>
                        <button type="button" class="btn-tier"
                            data-plano="<?php echo esc_attr($planos['plano_3']['mega']); ?>" aria-pressed="false"
                            onclick="abrirModalApps('<?php echo esc_js($nome_cat); ?>', <?php echo $apps_json; ?>, 'total-<?php echo esc_attr($planos['plano_3']['mega']); ?>', <?php echo esc_attr($planos['plano_3']['preco']); ?>, '<?php echo esc_js($planos['plano_3']['mega']); ?>')">
                            <?php echo esc_html($nome_cat); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <div class="total-display">Total: <strong
                        id="total-<?php echo esc_attr($planos['plano_3']['mega']); ?>">R$
                        <?php echo esc_html($planos['plano_3']['preco_formatado']); ?></strong></div>
                <button type="button" class="btn-contratar"
                    onclick="enviarPedido('<?php echo esc_js($planos['plano_3']['mega']); ?>', 'total-<?php echo esc_attr($planos['plano_3']['mega']); ?>')">Contratar
                    Plano</button>
            </div>
        </div>
    </div>
</section>

<?php
$apps_destaque = array(
    array('field_prefix' => 'app_disney', 'default_title' => 'Disney+', 'default_desc' => 'Filmes, séries e esportes.', 'slug' => 'disney-plus'),
    array('field_prefix' => 'app_deezer', 'default_title' => 'Deezer', 'default_desc' => 'Suas playlists favoritas.', 'slug' => 'deezer'),
    array('field_prefix' => 'app_hbo', 'default_title' => 'HBO Max', 'default_desc' => 'Drama, comédia e lançamentos.', 'slug' => 'hbo-max'),
);

$apps_page_url = get_post_type_archive_link('aplicativo') ?: (get_page_by_path('aplicativos') ? get_permalink(get_page_by_path('aplicativos')) : '#');
?>

<section class="apps-highlights-section" id="apps-highlights">
    <div class="apps-highlights-shell">
        <div class="apps-highlights-header">
            <p class="apps-kicker">Aplicativos do seu plano</p>
            <h2>Acesse os aplicativos do seu plano</h2>
        </div>
        <div class="apps-highlights-grid">
            <?php foreach ($apps_destaque as $app_item):
                $imagem_id = get_field($app_item['field_prefix'] . '_imagem');
                $titulo = get_field($app_item['field_prefix'] . '_titulo') ?: $app_item['default_title'];
                $descricao = get_field($app_item['field_prefix'] . '_descricao') ?: $app_item['default_desc'];
                $app_post = get_page_by_path($app_item['slug'], OBJECT, 'aplicativo');
                $app_link = $app_post ? get_permalink($app_post) : $apps_page_url;
                ?>
                <article class="highlight-app-card">
                    <a class="app-card-link" href="<?php echo esc_url($app_link); ?>">
                        <div class="highlight-card-art">
                            <?php if ($imagem_id):
                                echo wp_get_attachment_image($imagem_id, 'medium', false, array('alt' => esc_attr($titulo)));
                            else: ?><span><?php echo esc_html($titulo); ?></span><?php endif; ?>
                        </div>
                        <div class="highlight-card-body">
                            <h3><?php echo esc_html($titulo); ?></h3>
                            <p><?php echo esc_html($descricao); ?></p>
                            <strong>Destaque</strong>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
        <div class="apps-highlights-cta">
            <a href="<?php echo esc_url($apps_page_url); ?>" class="apps-view-all-link">Ver todos os aplicativos</a>
        </div>
    </div>
</section>

<?php
$boleto_url = get_field('link_2via_boleto', 'option') ?: 'https://central.unoun.com.br/central-assinante/';
$velocimetro_url = get_field('link_teste_velocidade', 'option') ?: 'https://www.speedtest.net/pt';
$autoatendimento_items = array(
    array('titulo' => '2ª via do boleto', 'link' => $boleto_url, 'icone' => '<path d="M6 2h9l3 3v17H6z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M9 9h6M9 12h6M9 15h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>'),
    array('titulo' => 'Teste de velocidade', 'link' => $velocimetro_url, 'icone' => '<path d="M12 4a9 9 0 0 0-9 9c0 2.4.9 4.6 2.4 6.3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><path d="M12 13l4-4M12 4a9 9 0 0 1 8.6 6.3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/><circle cx="12" cy="13" r="1.6" fill="currentColor"/>'),
);
?>

<section class="selfservice-section" id="autoatendimento">
    <div class="selfservice-shell">
        <div class="selfservice-header">
            <h2>Autoatendimento <span>Cliente UNOUN</span></h2>
        </div>
        <div class="selfservice-grid">
            <?php foreach ($autoatendimento_items as $item): ?>
                <a class="selfservice-card" href="<?php echo esc_url($item['link']); ?>" target="_blank"
                    rel="noopener noreferrer">
                    <span class="selfservice-icon"><svg viewBox="0 0 24 24"
                            fill="none"><?php echo $item['icone']; ?></svg></span>
                    <span class="selfservice-title"><?php echo esc_html($item['titulo']); ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="why-us-section" id="por-que-unoun">
    <div class="why-us-shell">
        <div class="why-us-header">
            <p class="apps-kicker">Por que escolher a UNOUN</p>
            <h2>Conexão que não te deixa na mão</h2>
        </div>
        <div class="why-us-grid">
            <div class="why-us-card"><span class="why-us-number">01</span>
                <h3>Infraestrutura com viabilidade técnica</h3>
                <p>Contamos com rede própria de fibra óptica e, quando necessário, realizamos a análise de viabilidade
                    técnica da região para garantir uma conexão estável e de qualidade.</p>
            </div>
            <div class="why-us-card"><span class="why-us-number">02</span>
                <h3>Instalação em até 48h úteis</h3>
                <p>Agende sua instalação e receba a visita técnica com agilidade. O equipamento necessário já está
                    incluso, para você começar a aproveitar sua conexão o quanto antes.</p>
            </div>
            <div class="why-us-card"><span class="why-us-number">03</span>
                <h3>Atendimento humano com apoio inteligente</h3>
                <p>Você conta com atendimento humano pelo WhatsApp, telefone e chat, com o apoio da inteligência
                    artificial para organizar e agilizar suas solicitações.</p>
            </div>
            <div class="why-us-card"><span class="why-us-number">04</span>
                <h3>Sem fidelidade abusiva</h3>
                <p>Condições claras desde a contratação, sem letras miúdas ou surpresas. Você sabe exatamente o que está
                    contratando.</p>
            </div>
        </div>
    </div>
</section>

<?php $whatsapp_url = function_exists('unoun_get_whatsapp_url') ? unoun_get_whatsapp_url() : 'https://api.whatsapp.com/send/?phone=%2B558000790101&text&type=phone_number&app_absent=0'; ?>
<section class="app-cta-box final-cta">
    <h2>Pronto para ter a melhor internet da região?</h2>
    <a class="apps-view-all-link" href="<?php echo esc_url($whatsapp_url); ?>" target="_blank"
        rel="noopener noreferrer">Fale com a gente</a>
</section>

<!-- ==========================================
     MODAL DINÂMICO E JAVASCRIPT GESTOR
     ========================================== -->
<div id="dynamicAppModal"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); z-index:9999; justify-content:center; align-items:center;">
    <div
        style="background:#fff; border-radius:12px; width:90%; max-width:420px; overflow:hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">

        <!-- Header Roxo -->
        <div
            style="display:flex; justify-content:space-between; align-items:center; background:#672f8f; color:#fff; padding:15px 20px;">
            <h3 id="modalCategoriaTitulo" style="margin:0; font-size:1.1rem; font-weight:bold;">Selecionar</h3>
            <button class="modal-fechar" onclick="fecharModalApps()" aria-label="Fechar janela">&times;</button>
        </div>

        <!-- Corpo da Lista -->
        <div id="listaDeAppsNoModal" style="padding: 20px; max-height: 350px; overflow-y: auto; color:#333;">
            <!-- O JS injeta os checkboxes aqui -->
        </div>

        <!-- Rodapé com Total Dinâmico -->
        <div
            style="display:flex; justify-content:space-between; align-items:center; padding:15px 20px; border-top:1px solid #eee; background:#fff;">
            <span style="font-size:0.95rem; color:#555;">Total: <strong id="modalPrecoTotalEmTempoReal"
                    style="color:#672f8f; font-size:1.15rem;">R$ 0,00</strong></span>
            <button id="btnLimparAppsModal" type="button" onclick="limparAppsNaSelecao()"
                style="padding:8px 12px; border:1px solid #e31b23; border-radius:16px; background:#fff; color:#e31b23; cursor:pointer; font-size:0.82rem;">
                Limpar apps
            </button>
            <button id="btnConfirmarModal"
                style="padding:10px 20px; background:#672f8f; color:#fff; border:none; border-radius:20px; font-weight:bold; cursor:pointer; font-size:0.9rem; transition: opacity 0.2s;">
                Contratar
            </button>
        </div>
    </div>
</div>

<script>
    // Agora o estadoPlanos guarda também qual categoria foi selecionada
    let estadoPlanos = {
        '<?php echo esc_js($planos['plano_1']['mega']); ?>': { base: <?php echo wp_json_encode($planos['plano_1']['preco']); ?>, adicionais: 0, apps: [], appDetalhes: [], categoriaAtiva: '' },
        '<?php echo esc_js($planos['plano_2']['mega']); ?>': { base: <?php echo wp_json_encode($planos['plano_2']['preco']); ?>, adicionais: 0, apps: [], appDetalhes: [], categoriaAtiva: '' },
        '<?php echo esc_js($planos['plano_3']['mega']); ?>': { base: <?php echo wp_json_encode($planos['plano_3']['preco']); ?>, adicionais: 0, apps: [], appDetalhes: [], categoriaAtiva: '' }
    };
    let planoModalAtual = '';
    let categoriaModalAtual = '';
    let modalEmSelecao = false;
    const appsInclusos = <?php echo wp_json_encode($nomes_apps_inclusos); ?>;
    const catalogoCategorias = <?php echo wp_json_encode($catalogo_categorias); ?>;

    function abrirModalApps(categoria, appsArray, displayId, precoBase, planoKey) {
        planoModalAtual = planoKey;
        categoriaModalAtual = categoria;
        modalEmSelecao = true;
        document.getElementById('modalCategoriaTitulo').innerText = categoria;
        document.getElementById('btnConfirmarModal').innerText = 'Contratar';
        document.getElementById('btnLimparAppsModal').style.display = 'inline-block';
        let btnVoltarExistente = document.getElementById('btnVoltarResumo');
        if (btnVoltarExistente) btnVoltarExistente.remove();

        let listaHTML = '';
        appsArray.forEach(function (app) {
            let isChecked = estadoPlanos[planoKey].apps.includes(app.nome) ? 'checked' : '';

            let visualDoApp = app.logo
                ? `<img src="${app.logo}" alt="${app.nome}" style="height: 24px; width: 24px; border-radius: 4px; object-fit: contain;"> <strong style="font-weight:600; font-size:0.95rem;">${app.nome}</strong>`
                : `<strong style="font-weight:600; font-size:0.95rem;">${app.nome}</strong>`;

            listaHTML += `
                <label style="display:flex; justify-content:space-between; align-items:center; padding:12px 15px; border:1px solid #eee; margin-bottom:10px; border-radius:8px; cursor:pointer; transition: background 0.2s;">
                    <span style="display:flex; align-items:center; gap:12px; width: 130px;">
                        <input type="checkbox" class="app-checkbox" value="${app.preco}" data-nome="${app.nome}" data-logo="${escapeHtml(app.logo || '')}" data-categoria="${escapeHtml(categoria)}" onchange="atualizarSomaTempoReal('${planoKey}')" ${isChecked} style="accent-color: #672f8f; transform: scale(1.1);"> 
                        ${visualDoApp}
                    </span>
                    <small style="font-weight:bold; color:#672f8f; font-size: 0.95rem;">R$ ${app.preco.toFixed(2).replace('.', ',')}</small>
                </label>
            `;
        });

        document.getElementById('listaDeAppsNoModal').innerHTML = listaHTML;
        document.getElementById('dynamicAppModal').style.display = 'flex';

        atualizarSomaTempoReal(planoKey);

        // Agora passamos a 'categoria' para a função de recalcular
        document.getElementById('btnConfirmarModal').onclick = function () {
            recalcularPlano(planoKey, displayId, categoria);
            transformarModalEmResumoFinal(planoKey);
        };
    }

    function atualizarSomaTempoReal(planoKey) {
        let checkboxes = document.querySelectorAll('.app-checkbox:checked, .outro-app-checkbox:checked');
        let categoriasVisiveis = [];
        document.querySelectorAll('.app-checkbox, .outro-app-checkbox').forEach(function (box) {
            let categoria = box.getAttribute('data-categoria');
            if (categoria && !categoriasVisiveis.includes(categoria)) categoriasVisiveis.push(categoria);
        });
        let valorAdicional = estadoPlanos[planoKey].appDetalhes.reduce(function (total, app) {
            if (categoriasVisiveis.includes(app.categoria)) return total;
            let item = catalogoCategorias[app.categoria].apps.find(function (catalogoApp) { return catalogoApp.nome === app.nome; });
            return total + (item ? Number(item.preco) : 0);
        }, 0);

        checkboxes.forEach(function (box) {
            valorAdicional += parseFloat(box.value);
        });

        let totalTempoReal = estadoPlanos[planoKey].base + valorAdicional;
        sincronizarTotalPlano(planoKey, totalTempoReal);
    }

    function recalcularPlano(planoKey, displayId, categoriaSelecionada) {
        let checkboxes = document.querySelectorAll('.app-checkbox:checked');
        let valorAdicional = 0;

        estadoPlanos[planoKey].appDetalhes = estadoPlanos[planoKey].appDetalhes.filter(function (app) {
            return app.categoria !== categoriaSelecionada;
        });
        estadoPlanos[planoKey].categoriaAtiva = categoriaSelecionada; // Salva a categoria na memória

        checkboxes.forEach(function (box) {
            valorAdicional += parseFloat(box.value);
            let nomeApp = box.getAttribute('data-nome');
            estadoPlanos[planoKey].apps.push(nomeApp);
            estadoPlanos[planoKey].appDetalhes.push({
                nome: nomeApp,
                logo: box.getAttribute('data-logo') || '',
                categoria: categoriaSelecionada
            });
        });

        estadoPlanos[planoKey].apps = estadoPlanos[planoKey].appDetalhes.map(function (app) { return app.nome; });
        estadoPlanos[planoKey].adicionais = estadoPlanos[planoKey].appDetalhes.reduce(function (total, app) {
            let item = catalogoCategorias[app.categoria].apps.find(function (catalogoApp) { return catalogoApp.nome === app.nome; });
            return total + (item ? Number(item.preco) : 0);
        }, 0);
        let novoTotal = estadoPlanos[planoKey].base + estadoPlanos[planoKey].adicionais;

        sincronizarTotalPlano(planoKey, novoTotal);
    }

    function transformarModalEmResumoFinal(planoKey) {
        let plano = estadoPlanos[planoKey];
        modalEmSelecao = false;
        let btnVoltarExistente = document.getElementById('btnVoltarResumo');
        if (btnVoltarExistente) btnVoltarExistente.remove();
        let total = plano.base + plano.adicionais;
        let appsInclusosHtml = appsInclusos.length
            ? appsInclusos.map(function (app) {
                let visual = app.logo
                    ? '<img src="' + escapeHtml(app.logo) + '" alt="" width="36" height="36" style="display:block; object-fit:contain; border-radius:6px;">'
                    : '<span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:6px; background:#f1edf5; color:#672f8f; font-weight:700;">' + escapeHtml(app.nome.charAt(0)) + '</span>';
                return '<li style="display:flex; align-items:center; gap:10px; list-style:none; margin:8px 0;">' + visual + '<span>' + escapeHtml(app.nome) + '</span></li>';
            }).join('')
            : '<li>✓ Aplicativos inclusos do plano</li>';
        let appsPersonalizados = plano.appDetalhes.length
            ? plano.appDetalhes.map(function (app) {
                let visual = app.logo
                    ? '<img src="' + escapeHtml(app.logo) + '" alt="" width="36" height="36" style="display:block; object-fit:contain; border-radius:6px;">'
                    : '<span style="display:flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:6px; background:#f1edf5; color:#672f8f; font-weight:700;">' + escapeHtml(app.nome.charAt(0)) + '</span>';
                return '<li style="display:flex; align-items:center; gap:10px; list-style:none; margin:8px 0;">' + visual + '<span>' + escapeHtml(app.nome) + '</span></li>';
            }).join('')
            : '<li>✓ Nenhum aplicativo adicional escolhido</li>';
        let opcoesPacotes = Object.keys(catalogoCategorias).map(function (categoria) {
            let atual = categoria === plano.categoriaAtiva;
            let disabled = atual ? ' disabled' : '';
            let estilo = atual ? 'opacity:0.55; cursor:not-allowed;' : 'cursor:pointer;';
            return '<button type="button" style="margin:4px; padding:8px 12px; border:1px solid #672f8f; border-radius:16px; background:#fff; color:#672f8f; ' + estilo + '" onclick="abrirOutroPacote(\'' + escapeHtml(categoria) + '\', \'' + planoKey + '\')"' + disabled + '>' + escapeHtml(categoria) + (atual ? ' (atual)' : '') + '</button>';
        }).join('')

        document.getElementById('modalCategoriaTitulo').innerText = 'Resumo da contratação';
        document.getElementById('btnLimparAppsModal').style.display = 'none';
        document.getElementById('listaDeAppsNoModal').innerHTML = `
            <div class="resumo-contratacao-final">
                <h4>Plano de ${planoKey} MEGAS</h4>
                <ul class="lista-apps-escolhidos">
                    ${appsInclusosHtml}
                    <li class="resumo-subtitulo">Aplicativos personalizados:</li>
                    ${appsPersonalizados}
                </ul>
                <div style="margin:16px 0;">
                    <strong>Deseja contratar outro pacote?</strong>
                    <div style="margin-top:8px;">${opcoesPacotes}</div>
                </div>
                <button type="button" style="padding:8px 12px; border:1px solid #d33; border-radius:16px; background:#fff; color:#b22; cursor:pointer;" onclick="limparAppsSelecionados('${planoKey}')">Limpar todos os apps</button>
                <div class="total-final-box">
                    <span>Valor total:</span>
                    <strong>R$ ${total.toFixed(2).replace('.', ',')} / mês</strong>
                </div>
            </div>
        `;
        sincronizarTotalPlano(planoKey, total);
        let btnVoltarResumo = document.getElementById('btnVoltarResumo');
        if (btnVoltarResumo) btnVoltarResumo.remove();
        document.getElementById('btnConfirmarModal').insertAdjacentHTML('beforebegin', '<button type="button" id="btnVoltarResumo" style="padding:8px 12px; margin-right:8px; border:1px solid #672f8f; border-radius:16px; background:#fff; color:#672f8f; cursor:pointer;" onclick="voltarParaPacoteAtual(\'' + planoKey + '\')">Voltar</button>');
        document.getElementById('btnConfirmarModal').innerText = 'Contratar';
        document.getElementById('btnConfirmarModal').onclick = function () {
            redirecionarParaWhatsApp(planoKey);
        };
    }

    function fecharModalApps() {
        if (modalEmSelecao && planoModalAtual && categoriaModalAtual) {
            let possuiAppsMarcados = document.querySelectorAll('.app-checkbox:checked').length > 0;
            if (!possuiAppsMarcados) limparCategoriaSemApps(planoModalAtual, categoriaModalAtual);
        }
        document.getElementById('dynamicAppModal').style.display = 'none';
    }

    function sincronizarTotalPlano(planoKey, total) {
        let valorFormatado = 'R$ ' + Number(total).toFixed(2).replace('.', ',');
        let modalTotal = document.getElementById('modalPrecoTotalEmTempoReal');
        let planoTotal = document.getElementById('total-' + planoKey);
        if (modalTotal) modalTotal.innerText = valorFormatado;
        if (planoTotal) planoTotal.innerText = valorFormatado;
    }

    function limparCategoriaSemApps(planoKey, categoria) {
        let plano = estadoPlanos[planoKey];
        plano.appDetalhes = plano.appDetalhes.filter(function (app) { return app.categoria !== categoria; });
        plano.apps = plano.appDetalhes.map(function (app) { return app.nome; });
        plano.adicionais = plano.appDetalhes.reduce(function (total, app) {
            let item = catalogoCategorias[app.categoria].apps.find(function (catalogoApp) { return catalogoApp.nome === app.nome; });
            return total + (item ? Number(item.preco) : 0);
        }, 0);
        let totalElement = document.getElementById('total-' + planoKey);
        if (totalElement) sincronizarTotalPlano(planoKey, plano.base + plano.adicionais);
    }

    function voltarParaPacoteAtual(planoKey) {
        let categoria = estadoPlanos[planoKey].categoriaAtiva;
        if (!categoria || !catalogoCategorias[categoria]) {
            fecharModalApps();
            return;
        }
        abrirModalApps(categoria, catalogoCategorias[categoria].apps, 'total-' + planoKey, estadoPlanos[planoKey].base, planoKey);
    }

    function escapeHtml(texto) {
        return String(texto).replace(/[&<>'"]/g, function (caractere) {
            return { '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[caractere];
        });
    }

    function abrirOutroPacote(categoria, planoKey) {
        modalEmSelecao = false;
        document.getElementById('btnLimparAppsModal').style.display = 'none';
        let appsArray = catalogoCategorias[categoria].apps;
        document.getElementById('modalCategoriaTitulo').innerText = 'Apps do pacote ' + categoria;
        document.getElementById('listaDeAppsNoModal').innerHTML = appsArray.map(function (app) {
            let selecionado = estadoPlanos[planoKey].appDetalhes.some(function (item) {
                return item.nome === app.nome && item.categoria === categoria;
            });
            let visual = app.logo ? '<img src="' + escapeHtml(app.logo) + '" alt="" width="36" height="36" style="object-fit:contain; border-radius:6px;">' : '<span style="width:36px; height:36px; display:flex; align-items:center; justify-content:center; border-radius:6px; background:#f1edf5; color:#672f8f; font-weight:700;">' + escapeHtml(app.nome.charAt(0)) + '</span>';
            return '<label style="display:flex; align-items:center; gap:10px; margin:8px 0; cursor:pointer;">' +
                '<input type="checkbox" class="outro-app-checkbox" value="' + app.preco + '" data-nome="' + escapeHtml(app.nome) + '" data-logo="' + escapeHtml(app.logo || '') + '" data-categoria="' + escapeHtml(categoria) + '" onchange="atualizarSomaTempoReal(\'' + planoKey + '\')"' + (selecionado ? ' checked' : '') + '>' + visual + '<span style="flex:1;">' + escapeHtml(app.nome) + '</span><strong style="color:#672f8f; white-space:nowrap;">R$ ' + Number(app.preco).toFixed(2).replace('.', ',') + '</strong></label>';
        }).join('');
        document.getElementById('btnConfirmarModal').innerText = 'Adicionar aplicativos';
        let btnVoltarExistente = document.getElementById('btnVoltarResumo');
        if (btnVoltarExistente) btnVoltarExistente.remove();
        document.getElementById('btnConfirmarModal').insertAdjacentHTML('beforebegin', '<button type="button" id="btnVoltarResumo" style="padding:8px 12px; margin-right:8px; border:1px solid #672f8f; border-radius:16px; background:#fff; color:#672f8f; cursor:pointer;" onclick="transformarModalEmResumoFinal(\'' + planoKey + '\')">Voltar</button>');
        document.getElementById('btnConfirmarModal').onclick = function () {
            salvarOutroPacote(categoria, planoKey);
        };
        atualizarSomaTempoReal(planoKey);
    }

    function salvarOutroPacote(categoria, planoKey) {
        let plano = estadoPlanos[planoKey];
        plano.appDetalhes = plano.appDetalhes.filter(function (app) { return app.categoria !== categoria; });
        document.querySelectorAll('.outro-app-checkbox:checked').forEach(function (box) {
            plano.appDetalhes.push({
                nome: box.getAttribute('data-nome'),
                logo: box.getAttribute('data-logo') || '',
                categoria: categoria
            });
        });
        plano.apps = plano.appDetalhes.map(function (app) { return app.nome; });
        plano.adicionais = plano.appDetalhes.reduce(function (total, app) {
            let item = catalogoCategorias[app.categoria].apps.find(function (catalogoApp) { return catalogoApp.nome === app.nome; });
            return total + (item ? Number(item.preco) : 0);
        }, 0);
        renderizarResumo(planoKey);
    }

    function limparAppsSelecionados(planoKey) {
        estadoPlanos[planoKey].apps = [];
        estadoPlanos[planoKey].appDetalhes = [];
        estadoPlanos[planoKey].adicionais = 0;
        renderizarResumo(planoKey);
    }

    function limparAppsNaSelecao() {
        if (!planoModalAtual) return;
        estadoPlanos[planoModalAtual].apps = [];
        estadoPlanos[planoModalAtual].appDetalhes = [];
        estadoPlanos[planoModalAtual].adicionais = 0;
        document.querySelectorAll('.app-checkbox:checked, .outro-app-checkbox:checked').forEach(function (checkbox) {
            checkbox.checked = false;
        });
        sincronizarTotalPlano(planoModalAtual, estadoPlanos[planoModalAtual].base);
    }

    function renderizarResumo(planoKey) {
        transformarModalEmResumoFinal(planoKey);
    }

    function redirecionarParaWhatsApp(planoKey) {
        let plano = estadoPlanos[planoKey];
        let valorFinal = (plano.base + plano.adicionais).toFixed(2).replace('.', ',');
        let apps = plano.apps;
        let categoriaAtiva = plano.categoriaAtiva;

        let linhaPersonalizacao = '• Nenhuma personalização adicionada.';
        if (apps.length > 0) {
            linhaPersonalizacao = `• ${apps.length} app(s) do pacote ${categoriaAtiva}: ${apps.join(', ')}`;
        }

        // Usa "Template Literals" (crases) para manter as quebras de linha reais no envio
        let mensagem = `*Olá! Tenho interesse no Plano Básico*

*Detalhes do Plano Escolhido:*

*Plano:* ${planoKey} MEGAS
*Valor Total:* R$ ${valorFinal}/mês

 *Incluído no plano:*
• IMAGINA SÓ
• BOOKS
• SKEELO
• CLUBE CERTO

*Personalizações Adicionadas:*
${linhaPersonalizacao}

 *Gostaria de mais informações e contratar este plano!*`;

        let link = `https://api.whatsapp.com/send/?phone=558000790101&text=${encodeURIComponent(mensagem)}`;

        window.open(link, '_blank');
    }

    function enviarPedido(planoKey, displayId) {
        abrirModalApps('Resumo do plano', [], displayId, estadoPlanos[planoKey].base, planoKey);
        transformarModalEmResumoFinal(planoKey);
    }
</script>

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

<?php get_footer(); ?>