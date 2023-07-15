<?php
echo "Login";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="css/programador.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  
  <script src="js/login.js" defer></script>
</head>
<body>
    <div class="card">
        <div class="user">
            <div class="imgBx">
                <img src="https://64.media.tumblr.com/00da0e5e1b61ac19a6ca0c9c3dfb3464/02bc32a9422e0a41-3b/s400x600/b67526a96c19d3635952c80a05074b097e7cd1d0.jpg">
            </div>
            <div class="content">
                <h2>Franklin Jahir Ruiz Castro<br><span>Programador Backend</span></h2>
            </div>
            <span class="toggle"></span>
        </div>

        <ul class="contact">
            <li style="--clr:#171515;--i:1;">
                <p>Programador Junior/Freelance<br>Especializado en backend<br>PHP - MYSQL <br>CSS - JS</p>
            </li>
            <li style="--clr:#c71610;--i:0;">
                <a href="#">
                    <div class="iconBx">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <p>jahirrc3@gmail.com</p>
                </a>
            </li>
        </ul>
    </div>
    
    <script>
        let toggle = document.querySelector('.toggle');
        let = card = document.querySelector('.card');
        toggle.onclick = function(){
            card.classList.toggle('active');
        }
    </script>
</body>
</html>






