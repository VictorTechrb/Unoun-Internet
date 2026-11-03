<?php
get_header();

$comunicados = new WP_Query(
    array(
        'post_type'      => 'comunicado',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'no_found_rows'  => true,
    )
);
?>

<main class="comunicado-page" id="conteudo-principal">
    <header class="comunicado-hero">
        <p class="comunicado-kicker">Informação UNOUN</p>
        <h1>Comunicados</h1>
        <p>Confira as novidades, avisos e informações importantes da UNOUN.</p>
    </header>

    <section class="comunicado-list" aria-label="Comunicados publicados">
        <?php if ( $comunicados->have_posts() ) : ?>
            <?php while ( $comunicados->have_posts() ) : $comunicados->the_post(); ?>
                <article class="comunicado-card">
                    <p class="comunicado-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></p>
                    <h2><?php the_title(); ?></h2>
                    <div class="comunicado-excerpt"><?php the_excerpt(); ?></div>
                    <a class="comunicado-button" href="<?php the_permalink(); ?>">Ler comunicado</a>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <div class="comunicado-empty">
                <h2>Nenhum comunicado publicado</h2>
                <p>Em breve, novas informações estarão disponíveis aqui.</p>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php get_footer(); ?>
