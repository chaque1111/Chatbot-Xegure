<?php
/*
Plugin Name: Xegure Chatbot AI
Description: Integración de Chatbot Xegure con Páginas WordPress
Version: 1.0
Author: Holocruxe-Factory
*/

// Función que agrega un menú para el plugin
function custom_icon_plugin_menu()
{
    add_menu_page(
        'Xegure Chatbot AI',
        // Título de la página
        'Xegure Chatbot',
        // Título del menú
        'manage_options',
        // Capacidad requerida para acceder al menú
        'xegure-chatbot-settings',
        // Identificador único del menú
        'show_landing_xegure', // Función que renderizará la página de configuración
        plugin_dir_url(__FILE__) . 'assets/images/xegure.png',
        // Icono del menú
        2 // Posición en el menú
    );
}

// Función que renderiza la página de configuración del plugin
function show_landing_xegure()
{
    ?>
    <div class="wrap">
        <h2>Configuración de Xegure Chatbot AI</h2>
        <p>Aquí puedes agregar configuraciones adicionales para tu plugin.</p>
    </div>
    <?php
}

// Agregar acción para cargar el menú en el panel de administración
add_action('admin_menu', 'custom_icon_plugin_menu');


// Función que renderiza el ícono del chatbot en el front-end
function show_chatbot_icon_frontend()
{
    include_once plugin_dir_path(__FILE__) . '/components/chatbot/chatbot-component.php';
}




// Agregar acción para mostrar el ícono en el front-end
add_action('wp_footer', 'show_chatbot_icon_frontend');