const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");

const themeToggler = document.querySelector(".theme-toggler");

menuBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';
})

//

let getMode = localStorage.getItem("dark-mode");
if(getMode && getMode ==="enabled"){
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
}

themeToggler.addEventListener('click', () =>{
    document.body.classList.toggle('dark-theme-variables');

    if(document.body.classList.contains("dark-theme-variables")){
        localStorage.setItem("dark-mode", "enabled");
        themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
        themeToggler.querySelector('span:nth-child(1)').classList.remove('active');
    }else{
        localStorage.setItem("dark-mode", "disabled");
        themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
        themeToggler.querySelector('span:nth-child(2)').classList.remove('active');
    }
})

//
let getClick = localStorage.getItem("clicked");


/*let list = document.getElementsByTagName("a");
console.log(list);

for(let i=0; i<list.length; i++){
    list[i].onclick = function(){
        let j=0;
        while(j < list.length){
            list[j++].classList.remove('active');
            localStorage.setItem("clicked", "disabled");
        }
        list[i].classList.toggle('active');
        localStorage.setItem("clicked", "enabled");
    }
}
*/

var list = document.getElementsByTagName("a");

// Loop through the buttons and add the active class to the current/clicked button
for (var i = 0; i < list.length; i++) {
    list[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");

    // If there's no active class
    if (current.length > 0) {
      current[0].className = current[0].className.replace(" active", "");
    }

    // Add the active class to the current/clicked button
    this.className += " active";
    localStorage.setItem("clicked", "enabled");
  });
}

