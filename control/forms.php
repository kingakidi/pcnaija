<?php 
    include "./functions.php";
    if (isset($_POST['precastTitleForm'])) {
        echo '<div class="mt-3">
        <form class="title-form" id="title-form">
            <div class="form-group">
                <label for="title" >Precast Title </label>
                <input type="text" class="form-control" id="title" placeholder="Enter Precast Title" required>
            </div>
            <div class="form-group error error-title" id="error-title">
                
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-title btn btn-precast" id="btn-title">Create</button>
            </div>
        </form>
    </div>';
    }

    if (isset($_POST['contestantForm'])) {
        $pId = cleanForm($_POST['id']);
       
        // GET THE PRECAST TITLE 
        $pTQuery = mysqli_query($conn, "SELECT * FROM precast_title WHERE id=$pId");
        if (!$pTQuery) {
            die("PRECAST DETAILS FAILED ".mysqli_error($conn));
        }else{
            $row = mysqli_fetch_assoc($pTQuery);
            $title = $row['title'];

            echo "<form id='form-contestant'>
            <div class='form-group'>
                $title 
            </div>
            <div class='form-group'>
                <label for='nOfContestant'>Numbers of Contestant</label>
                <input type='number' class='form-control' placeholder='Enter Numbers of Contestant' id='nOfContestant' required>
            </div>
            <div class='form-group text-right'>
                <button class='btn btn-precast' id='btn-form-contestant'>Generate Form</button>
            </div>
        </form>
        <div class='show-generated-form' id='show-generated-form'>
        </div>";
           
        }
    }
   
?>

