/*const navBar = document.querySelector("nav"),
       menuBtns = document.querySelectorAll(".menu-icon"),
       overlay = document.querySelector(".overlay");
     menuBtns.forEach((menuBtn) => {
       menuBtn.addEventListener("click", () => {
         navBar.classList.toggle("open");
       });
     });
     overlay.addEventListener("click", () => {
       navBar.classList.remove("open");
     });
     */

const body = document.querySelector("body"),
modeToggle = body.querySelector(".mode-toggle");
sidebar = body.querySelector("nav");
sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});


const form_producto1 = document.getElementById("producto_register");
const form_producto2 = document.getElementById("producto_process");
const boton_producto = document.getElementsByClassName("registrar_producto");
const tabla_inventario = document.getElementsByClassName("inventory");

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
        if (window.innerWidth < 768) {
            sidebar.removeAttribute('hidden', '');
            form_producto1.style.width = "160%"; 
            form_producto1.style.marginLeft = "-100px";  
            form_producto2.style.width = "160%"; 
            form_producto2.style.marginLeft = "-100px";

            for (let i = 0; i < boton_producto.length; i++) {
                boton_producto[i].style.fontSize = "12px";
            }
        }
        sidebar.removeAttribute('hidden', '');
    }else{
        localStorage.setItem("status", "open");
        if (window.innerWidth < 768) {
            sidebar.setAttribute('hidden', '');
            form_producto1.style.width = "140%"; 
            form_producto1.style.marginLeft = "-95px"; 
            form_producto2.style.width = "140%"; 
            form_producto2.style.marginLeft = "-95px";
            for (let i = 0; i < boton_producto.length; i++) {
                boton_producto[i].style.fontSize = "17px";
            }

            for (let i = 0; i < tabla_inventario.length; i++) {
                tabla_inventario[i].style.fontSize = "12px"; 
            }
        }
    }
})