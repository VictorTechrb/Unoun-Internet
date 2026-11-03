<?php

// 1. Registro Limpo do Custom Post Type
function unoun_register_aplicativo_cpt() {
    $labels = array(
        'name'               => __( 'Aplicativos', 'unoun' ),
        'singular_name'      => __( 'Aplicativo', 'unoun' ),
        'add_new'            => __( 'Adicionar novo', 'unoun' ),
        'add_new_item'       => __( 'Adicionar novo aplicativo', 'unoun' ),
        'edit_item'          => __( 'Editar aplicativo', 'unoun' ),
        'new_item'           => __( 'Novo aplicativo', 'unoun' ),
        'view_item'          => __( 'Ver aplicativo', 'unoun' ),
        'search_items'       => __( 'Buscar aplicativos', 'unoun' ),
        'not_found'          => __( 'Nenhum aplicativo encontrado', 'unoun' ),
        'not_found_in_trash' => __( 'Nenhum aplicativo na lixeira', 'unoun' ),
        'all_items'          => __( 'Todos os aplicativos', 'unoun' ),
        'menu_name'          => __( 'Aplicativos', 'unoun' ),
        'name_admin_bar'     => __( 'Aplicativo', 'unoun' ),
    );

    $args = array(
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'aplicativos', 'with_front' => true ),
        'supports'     => array( 'title', 'thumbnail', 'editor' ),
        'menu_icon'    => 'dashicons-smartphone',
        'show_in_rest' => true, // Essencial para ativar o editor Gutenberg
    );

    register_post_type( 'aplicativo', $args );
}
add_action( 'init', 'unoun_register_aplicativo_cpt' );

// 2. Método Arquitetural Correto para Atualizar Rotas
function unoun_flush_rewrite_on_activation() {
    unoun_register_aplicativo_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'unoun_flush_rewrite_on_activation' );