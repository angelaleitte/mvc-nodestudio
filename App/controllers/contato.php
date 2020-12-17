<?php

class Contato{
    public function index(){
        echo "index do contato";
    }

    

    public function telefone(){
        echo "16 9669 6966";
    }

    public function email($nome = '', $email = '', $telefone = ''){
        echo $nome;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $telefone;
    }
}