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
            <p id="bot-message">¡Hola! ¿En qué puedo ayudarte hoy?</p>
        </div>
    </div>
    <div id="contain-input-chatbot-xegure">
        <div id="input-div-xegure">
            <input type="text" id="input-chatbot-xegure" placeholder="Escribe tu mensaje..." required="true"
                autocomplete="off">
            <img id="send-button" onclick="sendMessage()"
                src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/send-icon.png' ?>'"
                alt="">
        </div>
    </div>
</div>

<script>
    let pending = false;
    async function sendMessage() {
        let message = document.getElementById('input-chatbot-xegure').value;

        if (message.length && !pending) {
            document.getElementById('input-chatbot-xegure').value = '';
            var chatbotMessages = document.getElementById('chatbot-messages-xegure');
            // Agrega el mensaje del usuario al componente del chat
            chatbotMessages.innerHTML += '<div id="contain-message-user"><p id="user-message">' + message + '</p></div>';
            // Agregando mensaje de espera xd
            chatbotMessages.innerHTML += `<div id="contain-message-xegure-pending">
                                                     <div id="contain-image-message">
                                                        <img id="icon-chatbot-message" src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/xegure-chat-message.png' ?>'" alt="">
                                                     </div>
                                                     <p id="bot-message"></p>
                                               </div>`;
            //scroll hacia abajo :v
            chatbotMessages.style.height = chatbotMessages.scrollHeight + 'px';
            chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
            let response = await fetch("https://xegure.holocruxe.com/questions?question=" + message)
            pending = true;
            if (response.status == 200) {
                pending = false;
                //quitando mensaje de espera 
                document.getElementById('contain-message-xegure-pending').remove();
                let data = await response.json()

                chatbotMessages.innerHTML += `<div id="contain-message-xegure">
                                                     <div id="contain-image-message">
                                                        <img id="icon-chatbot-message" src="<?php echo plugin_dir_url("chatbot-xegure.php") . 'chatbot-xegure/assets/images/xegure-chat-message.png' ?>'" alt="">
                                                     </div>
                                                     <p id="bot-message">${data.response}</p>
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