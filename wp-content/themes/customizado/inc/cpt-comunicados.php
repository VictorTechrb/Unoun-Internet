<?php
/**
 * Cadastro e validação do Custom Post Type de Comunicados.
 */

function unoun_register_comunicado_cpt() {
    $labels = array(
        'name'               => __( 'Comunicados', 'unoun' ),
        'singular_name'      => __( 'Comunicado', 'unoun' ),
        'add_new'            => __( 'Adicionar novo', 'unoun' ),
        'add_new_item'       => __( 'Adicionar novo comunicado', 'unoun' ),
        'edit_item'          => __( 'Editar comunicado', 'unoun' ),
        'new_item'           => __( 'Novo comunicado', 'unoun' ),
        'view_item'          => __( 'Ver comunicado', 'unoun' ),
        'search_items'       => __( 'Buscar comunicados', 'unoun' ),
        'not_found'          => __( 'Nenhum comunicado encontrado', 'unoun' ),
        'not_found_in_trash' => __( 'Nenhum comunicado na lixeira', 'unoun' ),
        'all_items'          => __( 'Todos os comunicados', 'unoun' ),
        'menu_name'          => __( 'Comunicados', 'unoun' ),
        'name_admin_bar'     => __( 'Comunicado', 'unoun' ),
    );

    register_post_type(
        'comunicado',
        array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_rest'       => true,
            'has_archive'        => true,
            'rewrite'            => array( 'slug' => 'comunicados', 'with_front' => true ),
            'menu_icon'          => 'dashicons-megaphone',
            'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
            'capability_type'    => 'post',
            'map_meta_cap'       => true,
        )
    );
}
add_action( 'init', 'unoun_register_comunicado_cpt' );

function unoun_validate_comunicado_pdf( $valid, $value, $field ) {
    if ( empty( $value ) ) {
        return $valid;
    }

    $attachment_id = absint( $value );
    $attachment    = $attachment_id ? get_post( $attachment_id ) : null;
    $mime_type     = $attachment ? get_post_mime_type( $attachment_id ) : '';

    if ( ! $attachment || 'attachment' !== $attachment->post_type || 'application/pdf' !== $mime_type ) {
        return __( 'Selecione um arquivo PDF válido da biblioteca de mídia.', 'unoun' );
    }

    return $valid;
}
add_filter( 'acf/validate_value/key=field_comunicado_pdf', 'unoun_validate_comunicado_pdf', 10, 3 );

function unoun_sanitize_comunicado_pdf( $value ) {
    $attachment_id = absint( $value );

    if ( ! $attachment_id || 'application/pdf' !== get_post_mime_type( $attachment_id ) ) {
        return '';
    }

    return $attachment_id;
}
add_filter( 'acf/update_value/key=field_comunicado_pdf', 'unoun_sanitize_comunicado_pdf', 10, 1 );

function unoun_flush_comunicado_rewrites() {
    unoun_register_comunicado_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'unoun_flush_comunicado_rewrites' );

function unoun_maybe_flush_comunicado_rewrites() {
    if ( '1' === get_option( 'unoun_comunicado_rewrites_version' ) ) {
        return;
    }

    flush_rewrite_rules();
    update_option( 'unoun_comunicado_rewrites_version', '1' );
}
add_action( 'init', 'unoun_maybe_flush_comunicado_rewrites', 20 );
