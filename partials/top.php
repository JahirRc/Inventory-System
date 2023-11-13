<div class="top">
    <button id="menu-btn">
        <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="theme-toggler">
        <span class="material-symbols-outlined active">light_mode</span>
        <span class="material-symbols-outlined">dark_mode</span>
    </div>
    <div class="profile">
        <div class="info">
            <p>Hola, </p><?php echo $user['nombre'];?></b></p>
            <small class="text-muted">        
                <?php
                if($user['id_cargo'] == 1){
                    echo "Admin";
                }else if($user['id_cargo'] == 2){
                    echo "Trabajador";
                }
                ?>
                </small>
            </div>
            <div class="profile-photo">
                <img src="https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDIzLTAxL3JtNjA5LXNvbGlkaWNvbi13LTAwMi1wLnBuZw.png" alt="">
            </div>
        </div>