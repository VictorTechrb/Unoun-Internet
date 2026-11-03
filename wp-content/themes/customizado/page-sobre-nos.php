<?php
get_header();

$sobre_video_url = 'https://www.facebook.com/reel/871391839098534/';
$sobre_video_embed_url = 'https://www.facebook.com/plugins/video.php?href=' . rawurlencode($sobre_video_url) . '&show_text=false&width=900';

$sobre_secoes = [
    [
        'titulo' => 'A Nossa Missão',
        'texto' => 'Nós existimos para acabar com a frustração da internet que cai toda hora. Construímos uma rede robusta para garantir que seu trabalho, seu jogo e seu streaming funcionem sem interrupções. Entregamos a estabilidade que as grandes operadoras apenas prometem.',
        'campo_texto' => 'sobre_missao_texto',
        'campo_imagem' => 'sobre_missao_imagem',
        'alt' => 'Nossa Missão',
    ],
    [
        'titulo' => 'A Nossa Visão',
        'texto' => 'Ser a empresa de internet mais confiável e próxima das pessoas, levando conexão de qualidade e atendimento humano para cada cliente.',
        'campo_texto' => 'sobre_visao_texto',
        'campo_imagem' => 'sobre_visao_imagem',
        'alt' => 'Nossa Visão',
    ],
    [
        'titulo' => 'Nossos Valores',
        'texto' => 'Transparência, respeito, agilidade e compromisso com o cliente orientam cada decisão e cada atendimento da UNOUN.',
        'campo_texto' => 'sobre_valores_texto',
        'campo_imagem' => 'sobre_valores_imagem',
        'alt' => 'Nossos valores',
    ],
    [
        'titulo' => 'Nossa História (Fundação)',
        'texto' => 'A UNOUN nasceu da insatisfação com o suporte técnico regional. Éramos clientes cansados de falar com robôs e esperar dias por um técnico. Decidimos construir nossa própria estrutura de fibra óptica para entregar um atendimento humano, rápido e focado em resolver problemas no mesmo dia.',
        'campo_texto' => 'sobre_historia_texto',
        'campo_imagem' => 'sobre_historia_imagem',
        'alt' => 'Nossa História',
    ],
];
?>


<!-- SEÇÃO MISSÃO E HISTÓRIA (Padrão-Z) -->
<section class="sobre-mv-section">
    <div class="sobre-shell">

        <?php foreach ($sobre_secoes as $indice => $secao):
            $texto = function_exists('get_field') ? get_field($secao['campo_texto']) : '';
            $imagem_id = function_exists('get_field') ? get_field($secao['campo_imagem']) : 0;
            $imagem_id = is_numeric($imagem_id) ? (int) $imagem_id : 0;
            ?>
            <div class="z-row<?php echo $indice % 2 === 1 ? ' reverse' : ''; ?>">
                <div class="z-media">
                    <?php if ($imagem_id): ?>
                        <?php echo wp_get_attachment_image($imagem_id, 'large', false, [
                            'alt' => $secao['alt'],
                            'loading' => 'lazy',
                        ]); ?>
                    <?php endif; ?>
                </div>
                <div class="z-text">
                    <h2><?php echo esc_html($secao['titulo']); ?></h2>
                    <?php if ($texto): ?>
                        <?php echo wp_kses_post($texto); ?>
                    <?php else: ?>
                        <p><?php echo esc_html($secao['texto']); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>


<section class="sobre-video-section">
    <div class="video-wrapper">
        <iframe src="<?php echo esc_url($sobre_video_embed_url); ?>" title="Vídeo institucional da UNOUN" loading="lazy"
            scrolling="no" frameborder="0" allowfullscreen
            allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
        </iframe>
    </div>
    <p class="video-fallback">
        Acesse nosso
        <a href="<?php echo esc_url($sobre_video_url); ?>" target="_blank" rel="noopener noreferrer">Facebook.</a>
    </p>
</section>

<?php get_footer(); ?>