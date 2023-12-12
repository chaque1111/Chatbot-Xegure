<?php
wp_enqueue_style('chat-component-styles', plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/styles/chat-styles.css');
?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var chatbotIcon = document.createElement('img');
        chatbotIcon.id = "xegure-bot-icon"
        chatbotIcon.src = '<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/chatbot.png' ?>';
        chatbotIcon.style.position = 'fixed';
        chatbotIcon.style.bottom = '20px';
        chatbotIcon.style.right = '20px';
        chatbotIcon.style.width = '70px'; // Ajusta el tamaño según sea necesario
        chatbotIcon.style.cursor = 'pointer';
        chatbotIcon.style.borderRadius = "100%"; /* Ajusta el radio de borde según tu recorte */
        chatbotIcon.style.transitionDuration = "1s"
        chatbotIcon.style.boxShadow = "0 4px 8px rgba(0, 0, 0, 0.2)";

        var inputChat = document.getElementById("input-chatbot-xegure");

        inputChat.addEventListener("keydown", function (event) {
            if (event.keyCode === 13) {
                // Ejecutar alguna acción, por ejemplo, mostrar el contenido del input
                sendMessage()
            }
        })

        chatbotIcon.addEventListener('click', function () {
            var chatbotComponent = document.getElementById('chatbot-component');
            if (chatbotComponent.style.display === 'none') {
                chatbotComponent.style.display = 'block';
            } else {
                chatbotComponent.style.display = 'none';
            }
        });
        document.body.appendChild(chatbotIcon);
    });
</script>

<!-- Componente del chat -->
<div id="chatbot-component">
    <div id="chatbot-header">
        <img id="chatbot-img-xegure-text" alt="xegure-image"
            src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/xegure-chatbot.png' ?>'">
        <img onclick="closeChat()" id="close-chatbot-xegure-img"
            src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/close-chat-button-image.png' ?>'"
            alt="">
    </div>
    <div id="chatbot-messages-xegure">
        <div id="contain-message-xegure">
            <div id="contain-image-message">
                <img id="icon-chatbot-message"
                    src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/xegure-chat-message.png' ?>'"
                    alt="">
            </div>
            <p>¡Hola! ¿En qué puedo ayudarte hoy?</p>
        </div>
    </div>
    <div id="chatbot-input">
        <input type="text" id="input-chatbot-xegure" placeholder="Escribe tu mensaje..." required="true">
        <button id="send-button" onclick="sendMessage()">Enviar</button>
    </div>
</div>

<script>
    async function sendMessage() {
        let message = document.getElementById('input-chatbot-xegure').value;

        if (message.length) {
            document.getElementById('input-chatbot-xegure').value = '';
            var chatbotMessages = document.getElementById('chatbot-messages-xegure');
            // Agrega el mensaje del usuario al componente del chat
            chatbotMessages.innerHTML += '<div id="contain-message-user"><p>' + message + '</p></div>';
            chatbotMessages.style.height = chatbotMessages.scrollHeight + 'px';
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            let response = await fetch("https://jsonplaceholder.org/posts")
            if (response.status) {
                let json = await response.json()
                var nRandom = Math.floor(Math.random() * 100) + 1;
                // Puedes agregar lógica para procesar la respuesta del chatbot aquí
                // Por ahora, simplemente agregamos un mensaje de ejemplo
                chatbotMessages.innerHTML += `<div id="contain-message-xegure">
                                                     <div id="contain-image-message">
                                                        <img id="icon-chatbot-message" src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/xegure-chat-message.png' ?>'" alt="">
                                                     </div>
                                                     <p>${json[nRandom].title}</p>
                                               </div>`;
                chatbotMessages.style.height = chatbotMessages.scrollHeight + 'px';
                chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            }


            // Limpia el campo de entrada del usuario

        }
    }
</script>


<!-- close chat -->

<script>
    function closeChat() {
        const chatbotComponent = document.getElementById("chatbot-component")
        if (chatbotComponent.style.display === 'block') {
            chatbotComponent.style.display = 'none';
        }
    }
</script>