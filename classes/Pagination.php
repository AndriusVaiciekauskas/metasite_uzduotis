<?php 
class Pagination
{
	public $users = [];
	public $per_page = 5;
	public $get_count = 0;
	public $count;
	public function __construct($count) {
		$this->get_count = $count;
		$this->count = $this->per_page + $this->get_count;
		$this->open_file();
		$this->check_for_count();
	}

	public function open_file() {
		// skaitomas failas
		$myfile = fopen("database/subscribers.csv", "r") or die("Unable to open file!");
		while(!feof($myfile)) {
		  array_push($this->users, fgetcsv($myfile));
		}
		fclose($myfile);
		// grazinami visi prenumaratoriai masyve
		array_pop($this->users);
		return $this->users;
	}

	public function check_for_count() {
		if ($this->count > count($this->users)) {
			$this->count = count($this->users)-1;
		}
	}
}