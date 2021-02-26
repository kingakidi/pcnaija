<script src="./vendor/jquery/jquery.min.js" type="text/javascript"></script>
<script src="./vendor/jquery/timeago.js" type="text/javascript"></script>
<script src="./js/sydeestack.js"></script>
<script src="./js/functions.js"></script>
<?php
      if (isset($_GET['p'])) {
        $p = $_GET['p'];

        switch ($p) {
          case $p:
           echo "<script src='./js/$p.js'></script>";
            break;
          
          default:
          echo "<script src='./js/index.js'></script>";
            break;
        }
      }else{
        echo "./control/index.js";
      }

?>