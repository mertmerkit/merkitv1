<?php 
if($_SESSION['role'] < 3){
     header('Location: ../');
     die();
};