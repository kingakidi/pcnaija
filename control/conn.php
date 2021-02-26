<?php
      $conn = mysqli_connect('localhost', 'root', '', 'pcnaija');
      if (!$conn) {
         die("ERROR ON CONNECTION");
      }
      if(!isset($_SESSION)) 
      { 
         session_start(); 
      } 
      ob_start();