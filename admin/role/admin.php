<?php 
if($_SESSION['role'] < 4){
     header('Location: ../');
     die();
};