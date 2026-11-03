<?php

function unoun_register_aplicativos_inclusos_cpt() {
    $labels = array(
        'name'               => __( 'Aplicativos Inclusos', 'unoun' ),
        'singular_name'      => __( 'Aplicativo Incluso', 'unoun' ),
        'add_new'            => __( 'Adicionar novo', 'unoun' ),
        'add_new_item'       => __( 'Adicionar novo aplicativo incluso', 'unoun' ),
        'edit_item'          => __( 'Editar aplicativo incluso', 'unoun' ),
        'new_item'           => __( 'Novo aplicativo incluso', 'unoun' ),
        'view_item'          => __( 'Ver aplicativo incluso', 'unoun' ),
        'search_items'       => __( 'Buscar aplicativos inclusos', 'unoun' ),
        'not_found'          => __( 'Nenhum aplicativo incluso encontrado', 'unoun' ),
        'not_found_in_trash' => __( 'Nenhum aplicativo incluso na lixeira', 'unoun' ),
        'all_items'          => __( 'Todos os aplicativos inclusos', 'unoun' ),
        'menu_name'          => __( 'Aplicativos Inclusos', 'unoun' ),
        'name_admin_bar'     => __( 'Aplicativo Incluso', 'unoun' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'aplicativos-inclusos', 'with_front' => true ),
        'supports'           => array( 'title' ),
        'menu_icon'          => 'dashicons-awards',
        'show_in_rest'       => true,
        'show_ui'            => true,
        'hierarchical'       => false,
        'exclude_from_search'=> false,
    );

    register_post_type( 'aplicativo_incluso', $args );
}

add_action( 'init', 'unoun_register_aplicativos_inclusos_cpt' );
