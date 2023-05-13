import {send} from "./script_base.js";

// Enviar email do footer
document.querySelector("#enviarEmail").addEventListener("click", () =>{
    send(document.querySelector("#email"))
});