<?php

function indexAction(){
    $hello = "Метод index контроллера Index";

    render("index", compact("hello"));
}