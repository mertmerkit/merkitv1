<?php 
if($_SESSION['role'] < 5){
     header('Location: ../');
     die();
};