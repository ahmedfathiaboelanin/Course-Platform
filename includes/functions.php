<?php
// check if the user exist
    function isLogged (){
        if(empty($_SESSION['info'])){
            return false;
        }else{
            return true;
        }
    }
// ---------------------------
// check if he is admin
    function isAdmin (){
        if(empty($_SESSION['info']['admin']!=1)){
            return false;
        }else{
            return true;
        }
    }
