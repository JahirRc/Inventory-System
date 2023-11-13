<link rel="stylesheet" href="css/select.css">

<div class="select-menu" id="select-menu" name="select-menu">
  <div class="select-btn" id="select-btn" name="select-btn">
    <span class="sBtn-text" id="sBtn-text" name="sBtn-text">Selecciona</span>
  </div>
  <ul class="options" id="select-scroll" name="select-scroll">
    <option value = "">REINICIA EL FILTRO</option>
    <?php
    $query = "SELECT nombre_categoria from categoria ORDER BY nombre_categoria ASC";
    $r = mysqli_query($con,$query);
    while($category = mysqli_fetch_assoc($r)){
      ?>
      <option value="<?= $category['nombre_categoria'] ?>"><?= $category['nombre_categoria'] ?></td>
      <?php 
      } 
      ?>
      </ul>
    </div>