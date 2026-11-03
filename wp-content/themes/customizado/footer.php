<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/footer.css" />

<?php
/* ── Links dinâmicos ─────────────────────────────────────── */
$whatsapp_url  = function_exists('unoun_get_whatsapp_url')
    ? unoun_get_whatsapp_url()
    : ' ';

$velocimetro_url   = get_field('link_teste_velocidade', 'option') ?: 'https://www.speedtest.net/pt';
$central_url       = get_field('link_area_cliente',     'option') ?: 'https://central.unoun.com.br/central-assinante/';
$ouvidoria_url     = get_field('link_ouvidoria',        'option') ?: 'https://wa.me/5508000790101?text=Ol%C3%A1%2C%20vim%20de%20através%20do%20Site%20da%20UNOUN%20Internet%20.';
$boleto_url        = get_field('link_2via_boleto',      'option') ?: 'https://central.unoun.com.br/central-assinante/';
$documentos_url = get_field('link_documentos_legais', 'option') ?: get_template_directory_uri() . '/doc/1-CONTRATO-ASSINADO-E-REGISTRADO-UNOUN-2023.PDF';

/* Páginas do site — ajuste os slugs conforme seu WordPress */
$page_links = [
    'planos'      => home_url('/#plans-section'),
    'aplicativos' => get_permalink( get_page_by_path('aplicativos') ) ?: home_url('/aplicativos'),
    'tv'          => get_permalink( get_page_by_path('tv') )          ?: home_url('/tv'),
    'suporte'     => get_permalink( get_page_by_path('suporte') )     ?: home_url('/suporte'),
    'ajuda'       => get_permalink( get_page_by_path('central-de-ajuda') ) ?: home_url('/ajuda'),
    'corporativo' => get_permalink( get_page_by_path('corporativo') ) ?: home_url('/corporativo'),
    'privacidade' => get_permalink( get_page_by_path('privacidade') ) ?: home_url('/privacidade'),
    'termos'      => get_permalink( get_page_by_path('termos') )      ?: home_url('/termos'),
];
?>

<footer class="site-footer" aria-label="Rodapé do site">

    <!-- Topo decorativo -->
    <div class="footer-wave" aria-hidden="true"></div>

    <div class="footer-container">

        <!-- ── Col 1: Marca ──────────────────────────── -->
        <div class="footer-col footer-col--brand">
            <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo" aria-label="UNOUN — Página inicial">
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/imag/unonun-telecom-branca.webp' ); ?>"
                    alt="Logomarca UNOUN Telecom"
                    width="140"
                    height="auto"
                    loading="lazy"
                >
            </a>

            <p class="footer-brand-desc">
                A UNOUN é o melhor provedor de internet fibra óptica da região. Conectando você com o que há de melhor em tecnologia, velocidade e estabilidade garantida.
            </p>

            <!-- App download -->
            <div class="footer-apps">
                <h5 class="footer-apps-title">Baixe o App UNOUN</h5>
                <div class="footer-app-brand">
                    <img
                        class="footer-app-icone"
                        src="<?php echo esc_url( get_template_directory_uri() . '/imag/UNOUN.webp' ); ?>"
                        alt="Ícone do Aplicativo UNOUN"
                        width="64"
                        height="64"
                        loading="lazy"
                    >
                    <div class="footer-app-info">
                        <p>Gerencie sua conta, consulte sua fatura e muito mais.</p>
                    </div>
                </div>
                <div class="app-buttons-wrapper">
                    <a class="store-badge-btn" href="https://apps.apple.com/us/app/unoun/id6758315639" target="_blank" rel="noopener noreferrer" aria-label="Baixar na App Store (abre em nova aba)">
                        <svg viewBox="0 0 384 512" width="20" height="20" aria-hidden="true">
                            <path fill="currentColor" d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"/>
                        </svg>
                        <div class="badge-text-ui">
                            <span>Baixar na</span>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a class="store-badge-btn" href="https://play.google.com/store/apps/details?id=com.r3r.unouninternet&hl=pt&pli=1" target="_blank" rel="noopener noreferrer" aria-label="Disponível no Google Play (abre em nova aba)">
                        <svg viewBox="0 0 512 512" width="20" height="20" aria-hidden="true">
                            <path fill="currentColor" d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"/>
                        </svg>
                        <div class="badge-text-ui">
                            <span>Disponível no</span>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- ── Col 2: Serviços ────────────────────────── -->
        <div class="footer-col">
            <h4 class="footer-col-title">Nossos Serviços</h4>
            <ul class="footer-links">
                <li>
                    <a href="<?php echo esc_url( $page_links['planos'] ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M2 8.5a15.5 15.5 0 0 1 20 0M5.5 12a10.5 10.5 0 0 1 13 0M9 15.5a5.5 5.5 0 0 1 6 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="19" r="1.4" fill="currentColor"/></svg>
                        Internet Fibra Óptica
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/aplicativos' ) ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><rect x="5" y="2" width="14" height="20" rx="2" stroke="currentColor" stroke-width="1.8"/><circle cx="12" cy="17" r="1" fill="currentColor"/></svg>
                        Aplicativos Inclusos
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/aplicativos/?categoria_app=Streaming' ) ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><rect x="2" y="4" width="20" height="14" rx="2" stroke="currentColor" stroke-width="1.8"/><path d="M8 20h8M12 18v2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        Combos de TV
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $central_url ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M6 2h9l3 3v17H6z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 9h6M9 12h6M9 15h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        Central de Ajuda
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $page_links['corporativo'] ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Contato Corporativo
                    </a>
                </li>
            </ul>
        </div>

        <!-- ── Col 3: Links Úteis ─────────────────────── -->
        <div class="footer-col">
            <h4 class="footer-col-title">Links Úteis</h4>
            <ul class="footer-links">
                <li>
                    <a href="<?php echo esc_url( $boleto_url ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M6 2h9l3 3v17H6z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 9h6M9 12h6M9 15h4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        2ª Via do Boleto
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $central_url ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><circle cx="12" cy="8" r="3.4" stroke="currentColor" stroke-width="1.8"/><path d="M5 20a7 7 0 0 1 14 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        Central do Assinante
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $velocimetro_url ); ?>" target="_blank" rel="noopener noreferrer">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M12 4a9 9 0 0 0-9 9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M12 13l4-4M12 4a9 9 0 0 1 8.6 6.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><circle cx="12" cy="13" r="1.6" fill="currentColor"/></svg>
                        Velocímetro
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $documentos_url ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M7 2h8l4 4v16H7z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M10 11h6M10 15h6M10 7h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        Documentos Legais
                    </a>
                </li>
                <li>
                    <a href="<?php echo esc_url( $ouvidoria_url ); ?>">
                        <svg viewBox="0 0 24 24" fill="none" width="14" height="14" aria-hidden="true"><path d="M3 11v2a2 2 0 0 0 2 2h1l3 4v-6M9 11H5a1 1 0 0 0-1 1" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M9 5c5 0 9 3 12 3v6c-3 0-7 3-12 3" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>
                        Ouvidoria UNOUN
                    </a>
                </li>
            </ul>
        </div>

        <!-- ── Col 4: Contato ─────────────────────────── -->
        <div class="footer-col">
            <h4 class="footer-col-title">Fale Conosco</h4>
            <div class="footer-contact-list">

                <a href="tel:08000790101" class="contact-item contact-item--link" aria-label="Ligar para 0800 079 0101">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" width="18" height="18" aria-hidden="true">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.91a16 16 0 0 0 6 6l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <strong>Central de Atendimento</strong>
                        <span>0800 079 0101</span>
                        <em>Ligação gratuita</em>
                    </div>
                </a>

                <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="contact-item contact-item--link contact-item--whatsapp" aria-label="Falar no WhatsApp (abre em nova aba)">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.549 4.107 1.51 5.842L.057 23.885a.5.5 0 0 0 .613.613l6.043-1.453A11.942 11.942 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.374l-.36-.214-3.724.895.912-3.63-.235-.373A9.79 9.79 0 0 1 2.182 12C2.182 6.565 6.565 2.182 12 2.182c5.434 0 9.818 4.383 9.818 9.818 0 5.434-4.384 9.818-9.818 9.818z"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <strong>WhatsApp</strong>
                        <span>Atendimento Online</span>
                        <em>Resposta imediata</em>
                    </div>
                    <span class="contact-arrow">→</span>
                </a>

                <div class="contact-item">
                    <div class="contact-icon">
                        <svg viewBox="0 0 24 24" fill="none" width="18" height="18" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.8"/>
                            <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="contact-text">
                        <strong>Horário de Atendimento</strong>
                        <span>Seg. a Sáb.: 8h – 18h</span>
                    </div>
                </div>

            </div>

            <!-- Redes sociais -->
            <div class="footer-social">
                <p class="footer-social-label">Siga a UNOUN</p>
                <div class="footer-social-icons">
                    <a href="https://www.instagram.com/sejaunoun/" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram da UNOUN">
                        <svg viewBox="0 0 24 24" fill="none" width="18" height="18" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"/>
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sejaunoun/?locale=pt_BR" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook da UNOUN">
                        <svg viewBox="0 0 24 24" fill="none" width="18" height="18" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer" class="social-icon social-icon--whatsapp" aria-label="WhatsApp da UNOUN">
                        <svg viewBox="0 0 24 24" fill="currentColor" width="18" height="18" aria-hidden="true">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
                            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.117.549 4.107 1.51 5.842L.057 23.885a.5.5 0 0 0 .613.613l6.043-1.453A11.942 11.942 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.797 9.797 0 0 1-5.003-1.374l-.36-.214-3.724.895.912-3.63-.235-.373A9.79 9.79 0 0 1 2.182 12C2.182 6.565 6.565 2.182 12 2.182c5.434 0 9.818 4.383 9.818 9.818 0 5.434-4.384 9.818-9.818 9.818z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div><!-- /.footer-container -->

    <!-- ── Barra inferior ────────────────────────────────── -->
    <div class="footer-bottom">
        <div class="footer-bottom-inner">
            <nav class="footer-legal-links" aria-label="Links legais">
                <a href="<?php echo esc_url( get_template_directory_uri() . '/doc/1-CONTRATO-ASSINADO-E-REGISTRADO-UNOUN-2023.PDF' ); ?>">Documentos Legais</a>
            </nav>
            <p class="footer-anatel">
                Prestadora de serviço de telecomunicações autorizada pela <strong>ANATEL</strong>
            </p>
            <p class="footer-copyright">
                &copy; <?php echo date('Y'); ?> <strong>UNOUN Internet</strong>. Todos os direitos reservados.
            </p>
        </div>
    </div>

</footer>
 
<?php wp_footer(); ?>

<!-- ── Botão flutuante WhatsApp ───────────────────────────── -->
<a
    href="<?php echo esc_url( $whatsapp_url ); ?>"
    target="_blank"
    rel="noopener noreferrer"
    class="whatsapp-float"
    aria-label="Fale Conosco pelo WhatsApp (abre em nova aba)"
>
    <span class="whatsapp-tooltip">Fale Conosco</span>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="whatsapp-icon" aria-hidden="true" focusable="false">
        <path fill="currentColor" d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.15-.173.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
    </svg>
</a>

</body>
</html>