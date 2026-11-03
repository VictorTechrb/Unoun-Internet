<?php

function unoun_seed_aplicativos() {
  if ( ! function_exists( 'update_field' ) ) {
    return;
  }

  $seeded_apps = array(
    array(
      'slug'             => 'deezer',
      'title'            => 'Deezer',
      'descricao_curta'  => 'Suas playlists favoritas, músicas e podcasts em qualquer momento do dia',
      'categoria_app'    => 'Música',
      'cor_destaque'     => '#5723a6',
      'post_content'     => 'Guia de ativação do Deezer para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Acesse o site de ativação',
          'descricao_passo' => 'Acesse o site ativardeezer.com.br e confirme o seu telefone cadastrado na operadora.',
        ),
        array(
          'titulo_passo'    => 'Receba o código',
          'descricao_passo' => 'Selecione se deseja receber o código de ativação por SMS ou WhatsApp.',
        ),
        array(
          'titulo_passo'    => 'Digite o código',
          'descricao_passo' => 'Insira o código de 7 dígitos recebido por mensagem e clique em Resgatar Código.',
        ),
        array(
          'titulo_passo'    => 'Cadastre-se ou faça login',
          'descricao_passo' => 'Abra o link recebido por SMS, clique em Cadastre-se ou em Login se já tiver conta, preencha seus dados e conclua o cadastro.',
        ),
        array(
          'titulo_passo'    => 'Pronto para curtir',
          'descricao_passo' => 'Com a oferta ativa, clique em Ouvir agora para aproveitar suas músicas favoritas.',
        ),
      ),
    ),
    array(
      'slug'             => 'looke',
      'title'            => 'Looke',
      'descricao_curta'  => 'Catálogo de filmes e séries selecionados',
      'categoria_app'    => 'Streaming',
      'cor_destaque'     => '#1c1536',
      'post_content'     => 'Guia de ativação do Looke para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Acesse a opção de operadora',
          'descricao_passo' => 'Abra o app do Looke, toque no ícone de perfil no canto superior direito, selecione Login com a Operadora e escolha Outros Parceiros.',
        ),
        array(
          'titulo_passo'    => 'Ative sua assinatura',
          'descricao_passo' => 'Clique no botão Cliente, ative sua assinatura aqui.',
        ),
        array(
          'titulo_passo'    => 'Valide seus dados',
          'descricao_passo' => 'Insira seu número de telefone com DDD e seu CPF cadastrados no provedor, depois clique em Validar.',
        ),
        array(
          'titulo_passo'    => 'Crie sua senha',
          'descricao_passo' => 'Informe seu e-mail de cadastro, defina uma senha e clique em Ativar.',
        ),
        array(
          'titulo_passo'    => 'Finalize no app ou na TV',
          'descricao_passo' => 'Clique em Começar Agora no celular. Para usar na TV, acesse Apple TV / Login com QR Code nas configurações da conta e escaneie o QR Code ou acesse looke.com.br/begin com o código numérico.',
        ),
      ),
    ),
    array(
      'slug'             => 'exitlag',
      'title'            => 'ExitLag',
      'descricao_curta'  => 'Reduza a latência e melhore sua experiência em jogos online',
      'categoria_app'    => 'Games/Rede',
      'cor_destaque'     => '#0b4f8f',
      'post_content'     => 'Guia de ativação do ExitLag para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Verifique seu e-mail',
          'descricao_passo' => 'Abra o e-mail recebido com a confirmação de ativação do ExitLag e clique no link para criar sua senha.',
        ),
        array(
          'titulo_passo'    => 'Defina sua senha',
          'descricao_passo' => 'No site da ExitLag, digite sua nova senha de acesso e salve as alterações.',
        ),
        array(
          'titulo_passo'    => 'Baixe e instale o programa',
          'descricao_passo' => 'Baixe o instalador para Windows, abra o arquivo executável e clique em Next, Install e depois Finish.',
        ),
        array(
          'titulo_passo'    => 'Faça login no app',
          'descricao_passo' => 'Abra o ExitLag no PC, insira seu e-mail e a senha cadastrada para começar a otimizar suas rotas de jogos.',
        ),
      ),
    ),
    array(
      'slug'             => 'sky-plus-light',
      'title'            => 'SKY+ Light',
      'descricao_curta'  => 'Canais de TV por assinatura direto no seu celular ou smart TV',
      'categoria_app'    => 'Streaming',
      'cor_destaque'     => '#d93838',
      'post_content'     => 'Guia de ativação do SKY+ Light para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Acesse o app SKY+',
          'descricao_passo' => 'Abra o aplicativo da SKY+, clique em Entrar na minha conta e selecione a opção Operadoras.',
        ),
        array(
          'titulo_passo'    => 'Selecione o provedor',
          'descricao_passo' => 'Busque por Outros Parceiros na lista de operadoras.',
        ),
        array(
          'titulo_passo'    => 'Insira suas credenciais',
          'descricao_passo' => 'Selecione seu provedor, digite o código do assinante e a senha fornecidos no momento da contratação e clique em Entrar.',
        ),
        array(
          'titulo_passo'    => 'Autorize o acesso',
          'descricao_passo' => 'Na tela seguinte, clique em Autorizar para conectar sua conta SKY+ e começar a assistir à programação.',
        ),
      ),
    ),
    array(
      'slug'             => 'kaspersky',
      'title'            => 'Kaspersky',
      'descricao_curta'  => 'Antivírus e proteção completa para seus dispositivos',
      'categoria_app'    => 'Segurança',
      'cor_destaque'     => '#1a7f5a',
      'post_content'     => 'Guia de ativação do Kaspersky para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Crie sua conta My Kaspersky',
          'descricao_passo' => 'Acesse my.kaspersky.com, clique em Criar uma conta, informe seu e-mail, defina uma senha segura e confirme o link enviado na sua caixa de entrada.',
        ),
        array(
          'titulo_passo'    => 'Adicione o código de ativação',
          'descricao_passo' => 'Insira o código de ativação de 20 dígitos recebido por SMS ou e-mail na sua conta para liberar a assinatura.',
        ),
        array(
          'titulo_passo'    => 'Baixe e instale o app',
          'descricao_passo' => 'No menu do site, clique em Downloads, escolha a versão para o seu dispositivo e baixe o aplicativo.',
        ),
        array(
          'titulo_passo'    => 'Conecte sua assinatura',
          'descricao_passo' => 'Abra o aplicativo instalado no celular, selecione Eu tenho uma assinatura e insira novamente o código de ativação para sincronizar a proteção.',
        ),
      ),
    ),
    array(
      'slug'             => 'disney-plus',
      'title'            => 'Disney+',
      'descricao_curta'  => 'Os melhores filmes e séries do Star e esportes com a ESPN',
      'categoria_app'    => 'Streaming',
      'cor_destaque'     => '#0b4f8f',
      'post_content'     => 'Guia de ativação do Disney+ para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Acesse o link de ativação',
          'descricao_passo' => 'Abra o SMS enviado pelo provedor e clique no link de ativação.',
        ),
        array(
          'titulo_passo'    => 'Confirme seu telefone',
          'descricao_passo' => 'Insira o número de telefone cadastrado na contratação e digite o código de segurança recebido via SMS ou WhatsApp.',
        ),
        array(
          'titulo_passo'    => 'Ative sua conta',
          'descricao_passo' => 'Confirme os dados na tela de informações da conta e clique em Ativar para ser redirecionado ao site do Disney+.',
        ),
        array(
          'titulo_passo'    => 'Faça login ou crie sua senha',
          'descricao_passo' => 'Insira seu e-mail, digite sua senha do MyDisney ou crie uma nova caso não tenha, aceite os termos de assinatura e configure seu perfil para começar a assistir.',
        ),
      ),
    ),
    array(
      'slug'             => 'hbo-max',
      'title'            => 'HBO Max',
      'descricao_curta'  => 'Drama, comédia, realities e muito mais',
      'categoria_app'    => 'Streaming',
      'cor_destaque'     => '#3f2bc2',
      'post_content'     => 'Guia de ativação do HBO Max para clientes UNOUN.',
      'steps'            => array(
        array(
          'titulo_passo'    => 'Acesse o app HBO Max',
          'descricao_passo' => 'Abra o aplicativo da HBO Max, clique em Entrar e selecione a opção para criar ou conectar conta de provedor.',
        ),
        array(
          'titulo_passo'    => 'Selecione o provedor',
          'descricao_passo' => 'Clique no campo Pesquise seu provedor e selecione a opção PlayHub.',
        ),
        array(
          'titulo_passo'    => 'Valide seu telefone',
          'descricao_passo' => 'Digite seu número de celular cadastrado, marque o reCAPTCHA e escolha receber o código por SMS ou WhatsApp.',
        ),
        array(
          'titulo_passo'    => 'Insira o código de validação',
          'descricao_passo' => 'Digite o código recebido no dispositivo e clique em Confirmar Código para concluir a validação da sua assinatura PlayHub.',
        ),
      ),
    ),
  );

  foreach ( $seeded_apps as $seed_app ) {
    $existing_post = get_page_by_path( $seed_app['slug'], OBJECT, 'aplicativo' );

    if ( $existing_post ) {
      continue;
    }

    $post_id = wp_insert_post(
      array(
        'post_type'    => 'aplicativo',
        'post_status'  => 'publish',
        'post_title'   => $seed_app['title'],
        'post_name'    => $seed_app['slug'],
        'post_excerpt' => $seed_app['descricao_curta'],
        'post_content' => $seed_app['post_content'],
      )
    );

    if ( is_wp_error( $post_id ) || ! $post_id ) {
      continue;
    }

    update_field( 'descricao_curta', $seed_app['descricao_curta'], $post_id );
    update_field( 'categoria_app', $seed_app['categoria_app'], $post_id );
    update_field( 'cor_destaque', $seed_app['cor_destaque'], $post_id );
    update_field( 'link_play_store', '', $post_id );
    update_field( 'link_app_store', '', $post_id );
    $conteudo_login = '<div class="login-steps-grid">';

    foreach ( $seed_app['steps'] as $index => $step ) {
      $numero_passo = $index + 1;
      $conteudo_login .= '<div class="login-step">';
      $conteudo_login .= '<span class="login-step-number">' . esc_html( $numero_passo ) . '</span>';
      $conteudo_login .= '<div class="login-step-text"><p><strong>' . esc_html( $step['titulo_passo'] ) . '</strong><br>' . esc_html( $step['descricao_passo'] ) . '</p></div>';
      $conteudo_login .= '</div>';
    }

    $conteudo_login .= '</div>';

    update_field( 'conteudo_passos_login', $conteudo_login, $post_id );
    update_field( 'perguntas_frequentes', array(), $post_id );
  }
}
add_action( 'acf/init', 'unoun_seed_aplicativos' );