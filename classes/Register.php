<?php

namespace Classes;

class Register
{
    private $name;
    private $password;
    private $users = [];

    public function __construct($name, $password)
    {
        // tikrinama ar nera tusciu lauku
        $this->checkForEmpty($name, $password);

        $this->name = $name;
        $this->password = $password;
    }

    public function store()
    {
        // skaitomas uzsiregistravusiu vartotoju sarasas
        $myfile = fopen("database/users.csv", "a+") or die("Unable to open file!");
        while (!feof($myfile)) {
            array_push($this->users, fgetcsv($myfile));
        }

        foreach ($this->users as $user) {
            // tiktinama ar jau yra toks vartotojo vardas
            $this->checkForExistingUser($user);
        }

        // jei tokio vartotojo vardo nera vartotojas pridedamas i faila
        $txt = $this->name . "," . password_hash($this->password, PASSWORD_DEFAULT) . "\n";
        fwrite($myfile, $txt);
        fclose($myfile);
        header("Location: index.php?login");
    }

    public function checkForEmpty($name, $email)
    {
        if ($name == '' || $email == '') {
            Session::set('error', 'Privaloma užpidyti visus laukus.');
            header("Location: index.php?register");
            die();
        }
    }

    public function checkForExistingUser($user)
    {
        if ($user[0] == $this->name) {
            // jei vartotojo vardas egzistuoja i sesija i rasoma error zinute
            Session::set('error', 'Vartotojo vardas jau egzistuoja. Prašome pasirinkti kitą vartotojo vardą.');
            // grazinama atgal i register puslapi
            header("Location: index.php?register");
            die();
        }
    }
}
