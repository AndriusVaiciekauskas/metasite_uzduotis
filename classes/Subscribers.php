<?php

namespace Classes;

class Subscribers
{
    protected $users = [];
    protected $deleted_user;
    protected $updated_user;
    protected $exploded_user = [];
    protected $users_change = [];
    protected $users_update = [];
    protected $data = [];

    public function index()
    {
        // skaitomas failas
        $myfile = fopen("database/subscribers.csv", "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            array_push($this->users, fgetcsv($myfile));
        }
        fclose($myfile);
        // grazinami visi prenumaratoriai masyve
        array_pop($this->users);
        return $this->users;
    }

    public function delete($string)
    {
        // skaitomas failas
        $this->openFileForDelete();
        // tikrinama ar yra meginamas istrinti prenumeratorius
        foreach ($this->users_change as $user) {
            if (strpos($user, $string) !== false) {
                $this->deleted_user = $user;
            }
        }
        // surandamas prenumeratorius ir pasalinamas is masyvo
        $key = array_search($this->deleted_user, $this->users_change);
        array_splice($this->users_change, $key, 1);
        // prenumeratoriu failas perrasomas
        $this->rewriteFileForDelete();
        // grazinama success zinute
        Session::set('success', 'Vartotojas buvo sėkmingai ištrintas.');
    }

    public function edit($string)
    {
        // explodinamas vardas ir emailas ir paduodamas i forma edit puslapyje
        return explode(",", $string);
    }

    public function update($string, $name, $email)
    {
        // tikrinama ar nera tusciu lauku
        $this->checkForEmpty($string, $name, $email);
        // tikrinama ar email teisingas
        $this->checkForEmail($email, $string);
        // skaitomas failas
        $this->openFileForUpdate();
        // tikrinama ar yra meginamas redaguoti prenumeratorius
        foreach ($this->users_update as $user) {
            if (strpos($user, $string) !== false) {
                $this->updated_user = $user;
            }
        }
        // surandamas prenumeratorius
        $key = array_search($this->updated_user, $this->users_update);
        // explodinam prenumaratoriu kurio duomenis norime pakeisti
        array_push($this->exploded_user, explode(",", $this->users_update[$key]));

        foreach ($this->exploded_user as $user) {
            foreach ($user as $data) {
                array_push($this->data, $data);
            }
        }
        // priskiram naujus duomenis
        $this->data[1] = $name;
        $this->data[2] = $email;
        // atgal sulipdome stringa jau su pakeistais duomenimis
        $data_change = implode(",", $this->data);
        $this->users_update[$key] = $data_change;
        // perrasome faila
        $this->rewriteFileForUpdate();
        // nustatome success zinute
        Session::set('success', 'Vartotojas buvo sėkmingai redaguotas.');
    }

    public function checkForEmpty($string, $name, $email)
    {
        if ($name == '' || $email == '') {
            Session::set('error', 'Privaloma užpidyti visus laukus.');
            header("Location: index.php?user_edit=" . $string);
            die();
        }
    }

    public function checkForEmail($email, $string)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::set('error', 'El. paštas įvestas neteisingai.');
            header("Location: index.php?user_edit=" . $string);
            die();
        }
    }

    public function openFileForDelete()
    {
        $myfile = fopen("database/subscribers.csv", "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            array_push($this->users_change, trim(fgets($myfile)));
        }
        fclose($myfile);
    }

    public function openFileForUpdate()
    {
        $myfile = fopen("database/subscribers.csv", "r") or die("Unable to open file!");
        while (!feof($myfile)) {
            array_push($this->users_update, trim(fgets($myfile)));
        }
        fclose($myfile);
    }

    public function rewriteFileForDelete()
    {
        $myfile = fopen("database/subscribers.csv", "w") or die("Unable to open file!");
        foreach ($this->users_change as $user) {
            if (strlen($user) != 0) {
                $txt = $user . "\n";
                fwrite($myfile, $txt);
            }
        }
        fclose($myfile);
    }

    public function rewriteFileForUpdate()
    {
        $myfile = fopen("database/subscribers.csv", "w") or die("Unable to open file!");
        foreach ($this->users_update as $user) {
            if (strlen($user) != 0) {
                $txt = $user . "\n";
                fwrite($myfile, $txt);
            }
        }
    }
}
