  <?php include "./view/header.php"; ?>
  <body>
    <div id="precast" class="precast">
     <?php include "./view/navbar.php"; ?>

      <div class="show" id="show">
        <?php
          if (isset($_GET['p'])) {
            $p = $_GET['p'];

            switch ($p) {
              case $p:
               include "./control/$p.php";
                break;
              
              default:
              include "./control/index.php";
                break;
            }
          }else{
            include "./control/index.php";
          }
        ?>       

      </div>
    </div>
      <?php include "./control/footer.php"; ?>
  </body>
</html>
