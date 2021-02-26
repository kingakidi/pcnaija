<?php 
    include('./conn.php');
    function cleanForm ($data)
    {
        global $conn;
        return strtolower(trim(mysqli_escape_string($conn, $data)));
    }
    function checkPass ($data)
    {
        global $conn;
        return mysqli_escape_string($conn, $data);
    }

// ERROR PRINTING FUNCTION 
    function error($text)
    {
        return "<span class='text-danger'>$text</span>";
    }

    // INFO PRINTING FUNCTION 
    function info($text)
    {
        return "<span class='text-info'>$text</span>";
    }

    // SUCCESS PRINTING FUNCTION 
    function success($text)
    {
        return "<span class='text-precast'>$text</span>";
    }

    // CHECK VALUE FUNCTION 

    function dbValCheck($val, $col, $table) {
        global $conn;
            $query = mysqli_query($conn, "SELECT * FROM $table WHERE $col='$val'");
            if (!$query) {
            return die("UNABLE TO FETCH QUERY ".mysqli_error($conn));

            }else{
            $numRow = mysqli_num_rows($query);
            if ($numRow > 0) {
                return true;
            }else{
                return false;
            }

        }

    }