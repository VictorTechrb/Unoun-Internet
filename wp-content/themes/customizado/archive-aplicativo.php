<?php
get_header();

$selected_category = isset( $_GET['categoria_app'] ) ? sanitize_text_field( wp_unslash( $_GET['categoria_app'] ) ) : '';
$categories = array( 'Streaming', 'Música', 'Segurança', 'Games/Rede', 'Outros' );

if ( ! in_array( $selected_category, $categories, true ) ) {
  $selected_category = '';
}

$query_args = array(
  'post_type'      => 'aplicativo',
  'post_status'    => 'publish',
  'posts_per_page' => -1,
  'orderby'        => 'title',
  'order'          => 'ASC',
);

if ( $selected_category ) {
  $query_args['meta_query'] = array(
    array(
      'key'     => 'categoria_app',
      'value'   => $selected_category,
      'compare' => '=',
    ),
  );
}

$app_query = new WP_Query( $query_args );
$archive_url = get_post_type_archive_link( 'aplicativo' );
?>

<main class="apps-page-container">
  <section class="apps-highlights-section">
    <div class="apps-highlights-shell">
      <div class="apps-highlights-header">
        <p class="apps-kicker">Aplicativos</p>
        <h2>Aplicativos do seu plano</h2>
        <p>Veja os aplicativos disponíveis, escolha o que combina com seu plano e siga os passos de ativação na página de cada app.</p>
      </div>

      <div class="app-filters-bar" aria-label="Filtro por categoria">
        <a class="app-filter-link <?php echo empty( $selected_category ) ? 'is-active' : ''; ?>" href="<?php echo esc_url( $archive_url ); ?>">Todos</a>
        <?php foreach ( $categories as $category ) : ?>
          <a class="app-filter-link <?php echo $selected_category === $category ? 'is-active' : ''; ?>" href="<?php echo esc_url( add_query_arg( 'categoria_app', $category, $archive_url ) ); ?>"><?php echo esc_html( $category ); ?></a>
        <?php endforeach; ?>
      </div>

      <div class="apps-highlights-grid">
        <?php if ( $app_query->have_posts() ) : ?>
          <?php while ( $app_query->have_posts() ) : $app_query->the_post(); ?>
            <?php
            $logo_app = get_field( 'logo_app', get_the_ID() );
            $descricao_curta = get_field( 'descricao_curta', get_the_ID() );
            $cor_destaque = get_field( 'cor_destaque', get_the_ID() ) ?: '#0f4360';
            $categoria_app = get_field( 'categoria_app', get_the_ID() );
            $title = get_the_title();
            ?>
            <article class="highlight-app-card">
              <a class="app-card-link" href="<?php the_permalink(); ?>">
                <div class="highlight-card-art" style="background-color: <?php echo esc_attr( $cor_destaque ); ?>;">
                  <?php if ( ! empty( $logo_app ) ) : ?>
                    <?php echo wp_get_attachment_image( $logo_app, 'medium', false, array( 'alt' => esc_attr( $title ), 'style' => 'object-fit: contain; padding: 22px; box-sizing: border-box;' ) ); ?>
                  <?php else : ?>
                    <span><?php echo esc_html( function_exists( 'mb_substr' ) ? mb_substr( $title, 0, 1 ) : substr( $title, 0, 1 ) ); ?></span>
                  <?php endif; ?>
                </div>

                <div class="highlight-card-body">
                  <?php if ( ! empty( $categoria_app ) ) : ?>
                    <p class="app-card-category"><?php echo esc_html( $categoria_app ); ?></p>
                  <?php endif; ?>
                  <h3><?php echo esc_html( $title ); ?></h3>
                  <p><?php echo esc_html( $descricao_curta ? $descricao_curta : wp_trim_words( wp_strip_all_tags( get_the_excerpt() ), 18, '...' ) ); ?></p>
                  <strong>Ver mais</strong>
                </div>
              </a>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php else : ?>
          <div class="apps-empty-state">
            <h3>Nenhum aplicativo encontrado</h3>
            <p>Selecione outra categoria ou cadastre novos aplicativos no painel do WordPress.</p>
          </div>
        <?php endif; ?>
      </div>
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

<?php get_footer(); ?>