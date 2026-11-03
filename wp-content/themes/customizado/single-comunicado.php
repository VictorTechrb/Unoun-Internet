<?php
get_header();

while ( have_posts() ) :
    the_post();
    $pdf_id  = function_exists( 'get_field' ) ? absint( get_field( 'arquivo_pdf_comunicado' ) ) : 0;
    $pdf_url = $pdf_id && 'application/pdf' === get_post_mime_type( $pdf_id ) ? wp_get_attachment_url( $pdf_id ) : '';
    ?>
    <main class="comunicado-page comunicado-single" id="conteudo-principal">
        <article class="comunicado-content">
            <a class="comunicado-back-link" href="<?php echo esc_url( get_post_type_archive_link( 'comunicado' ) ); ?>">← Voltar aos comunicados</a>
            <p class="comunicado-kicker">Comunicado UNOUN</p>
            <h1><?php the_title(); ?></h1>
            <p class="comunicado-date"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd/m/Y' ) ); ?></time></p>

            <?php if ( has_post_thumbnail() ) : ?>
                <div class="comunicado-featured-image"><?php the_post_thumbnail( 'large', array( 'alt' => esc_attr( get_the_title() ) ) ); ?></div>
            <?php endif; ?>

            <div class="comunicado-body"><?php the_content(); ?></div>

            <?php if ( $pdf_url ) : ?>
                <div class="comunicado-pdf-box">
                    <div>
                        <strong>Documento complementar</strong>
                        <span>Visualize ou baixe o PDF deste comunicado.</span>
                    </div>
                    <a class="comunicado-button comunicado-button--pdf" href="<?php echo esc_url( $pdf_url ); ?>" target="_blank" rel="noopener noreferrer">Visualizar / baixar PDF</a>
                </div>
            <?php endif; ?>
        </article>
    </main>
    <?php
endwhile;

get_footer();
