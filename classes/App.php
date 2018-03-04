<?php

namespace Classes;

use Classes\Subscribers;
use Classes\Categories;
use Classes\Pagination;
use Classes\Session;
use Classes\Subscribe;
use Classes\Register;
use Classes\Auth;

class App
{
    public function __construct()
    {
        session_start();

        $subscribers = new Subscribers();
        $categories = new Categories();

        // pagination
        if (isset($_POST['count'])) {
            $pagination = new Pagination($_POST['count']);
            Session::set('page', $_POST['page']);
            Session::set('count', $_POST['count']);
        }

        // sukuriamas naujas subscriberis
        if (isset($_POST['subscribe'])) {
            $subscribe = new Subscribe($_POST['name'], $_POST['email'], $_POST['select']);
        }

        // uzsiregistruojama
        if (isset($_POST['register'])) {
            $register = new Register($_POST['name'], $_POST['password']);
            echo $register->store();
        }
        
        // prisijungiama
        if (isset($_POST['login'])) {
            $login = new Auth($_POST['name'], $_POST['password']);
            $login->auth();
        }

        // atsijungiama
        if (isset($_GET['logout'])) {
            Auth::logout();
        }

        // istrinamas prenumeratorius
        if (isset($_POST['delete_subscriber'])) {
            $subscribers->delete($_POST['delete_subscriber']);
        }

        // editinami pernumeratoriaus duomenys
        if (isset($_POST['edit'])) {
            $subscribers->update($_POST['string'], $_POST['name'], $_POST['email']);
            Session::unset('error');
        }

        // atvaizduojamas reikiamas views'as
        if (isset($_GET['user_edit'])) {
            $user = $subscribers->edit($_GET['user_edit']);
            require "views/edit.view.php";
        } elseif (isset($_SESSION['name'])) {
            $user_data = $subscribers->index();
            require "views/list.view.php";
        } elseif (isset($_GET['register'])) {
            require "views/register.view.php";
            Session::unset('error');
        } elseif (isset($_GET['login'])) {
            require "views/login.view.php";
        } else {
            $categories = $categories->allCategories();
            require "views/subscribe.view.php";
        }

        // panaikinam error ar success zinutes
        Session::unset('success');
        Session::unset('error');
    }
}
