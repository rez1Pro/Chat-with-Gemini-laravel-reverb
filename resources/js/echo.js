import axios from 'axios';
import { marked } from "https://cdn.jsdelivr.net/npm/marked/lib/marked.esm.js";
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

let echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});


echo.channel("chat").listen("OpenAIMessage", (e) => {
    document.getElementById("ai-reply").innerHTML += `<div>${marked.parse(e.message)}</div>`;
})

document.getElementById("ai").addEventListener("submit", (e) => {
    e.preventDefault();
    let message = document.querySelector("input[name]").value;

    document.getElementById("ai-ask").innerHTML += `<span>${message}</span>`;

    axios.post("ask", { message }).then((response) => {
        document.getElementById("ai-ask").innerHTML = ""
    }).catch((error) => {
        document.getElementById('error').innerHTML = error.response.data.message;
    });
    
    document.querySelector("input[name]").value = "";
    document.getElementById("ai-reply").innerHTML = ""
});