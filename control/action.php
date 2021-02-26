<?php 
    require('./conn.php');
    require('./functions.php');
    $userid = 1;

    // ADDING TITLE 
    if(isset($_POST['sendPrecastTitle'])){
        $title = cleanForm($_POST['title']);
        
        // CHECK FOR EMPTY FIELDS 
        if (!empty($title)) {
            // CHECK IF TITLE ALREADY EXIST BY THIS USER 
            $cPTitle = mysqli_query($conn, "SELECT * FROM precast_title WHERE title='$title' AND userid = $userid");


            if (!$cPTitle) {
                die("UNABLE TO VERIFY STATUS ".mysqli_error($conn));
            }else if(mysqli_num_rows($cPTitle) > 0){
                echo error("YOU HAVE PRECAST OF THE SAME TITLE");
            }else{
                // SEND IF NOT EXIST
                $addTitleQuery  = mysqli_query($conn, "INSERT INTO `precast_title`(`userid`, `title`, `status`, `date`) VALUES ($userid, '$title', 'approved', now())");

                if (!$addTitleQuery) {
                    die("ADDING TITLE FAILED");
                }else{
                    echo success("TITLE ADDED SUCCESSFULLY CLICK <strong>My Precasts </strong> TO ADD CONTESTANT");
                }
            }
        }else{
            echo error("ALL FIELDS REQURIED");
        }
        
      


    }

    // MY PRECAST 
    if (isset($_POST['myPrecast'])) {
        // GET ALL THIS USER PRECASTS
        $uPQuery = mysqli_query($conn, "SELECT * FROM precast_title WHERE userid = $userid ORDER BY date DESC");
        if (!$uPQuery) {
            echo error("UNABLE TO GET YOUR PRECASTS AT THE MOMENT, TRY AGAIN LATER");
        }else if(mysqli_num_rows($uPQuery) < 1){
            echo success("YOU HAVE NOT CREATE ANY PRECAST USE <strong> Create Precast </strong> ABOVE TO CREATE ONE");
        }else{
            // PRINT ALL USERS PRECAST 
            echo "<div id='show-myprecast-action'>";
            while ($row = mysqli_fetch_assoc($uPQuery)) {
                $id = $row['id'];
                $title = $row['title'];
                $date = $row['date'];
                echo "<div class='precast-link table'>
                        <a >$title</a>
                       <div > 
                            <button name='add-contestant' id='$id'  class='btn btn-precast'>Add Contestant</button>
                            <button name='edit-precast'  class='btn btn-precast' name='edit-precast'>Edit</button>
                            
                            
                            <time class='timeago' datetime='$date'>$date</time>
                            
                       </div>
                    </div>";

            }
            echo "</div>";
        }
    }
?>

