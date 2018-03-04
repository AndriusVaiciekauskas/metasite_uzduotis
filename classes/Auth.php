<?php

namespace Classes;

class Auth
{
    private $name;
    private $password;
    private $users = [];

    public function __construct($name, $password)
    {
        // tikrinama ar uzpildyti visi laukai
        $this->checkForEmpty($name, $password);

        $this->name = $name;
        $this->password = $password;
    }

    public function auth()
    {
        // skaitomas failas
        $this->readFile();

        foreach ($this->users as $user) {
            // tikrinama kiekviena eilute ar sutampa vartotojo vardas ir slaptazodis
            if ($user[0] == $this->name && password_verify($this->password, $user[1])) {
                // jei duomenys sutampa sukuriama sesija
                Session::set('name', $this->name);
                Session::set('page', 0);
                Session::set('count', 0);
                return;
            }
        }

        // jei duomenys nesutampa i sesija irasoma error zinute
        Session::set('error', 'Neteisingas vartotojo vardas arba slaptažodis.');
        // grazinama i login forma
        header("Location: index.php?login");
        die();
    }

    public static function logout()
    {
        // paspaudus logout mygtuka sesija sunaikinama
        session_destroy();
        header("Location: index.php");
    }

    public function readFile()
    {
        $myfile = fopen("database/users.csv", "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            // visos eilutes sudedamos i masyva
            array_push($this->users, fgetcsv($myfile));
        }
        fclose($myfile);
    }

    public function checkForEmpty($name, $password)
    {
        if ($name == '' || $password == '') {
            Session::set('error', 'Privaloma užpidyti visus laukus.');
            return;
        }
    }
}
