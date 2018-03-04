<?php

namespace Classes;

class Subscribe
{
    protected $name;
    protected $email;
    private $options;

    public function __construct($name, $email, $options)
    {
        // tikrinama ar nera tusciu lauku
        $this->checkForEmpty($name, $email, $options);

        // tikrinama ar email ivestas teisingai
        $this->checkForEmail($email);

        $this->name = $name;
        $this->email = $email;
        $this->options = $options;
        $this->storeSubscriber();
    }

    public function storeSubscriber()
    {
        // uzpisldzius forma pradiniame puslapyje irasomi asmens duomenys i faila
        $myfile = fopen("database/subscribers.csv", "a") or die("Unable to open file!");
        $date = date("Y/m/d");
        $txt = $date . "," . $this->name . "," . $this->email . ",";
        foreach ($this->options as $option) {
            $txt .= $option . " ";
        }
        $txt .= "\n";
        fwrite($myfile, $txt);
        fclose($myfile);

        Session::set('success', 'Prenumeracija sėkminga!');
    }

    public function checkForEmpty($name, $email, $options)
    {
        if ($name == '' || $email == '' || $options == '') {
            Session::set('error', 'Privaloma uzpidyti visus laukus');
            header("Location: index.php");
            die();
        }
    }

    public function checkForEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Session::set('error', 'El. paštas įvestas neteisingai.');
            header("Location: index.php");
            die();
        }
    }
}
