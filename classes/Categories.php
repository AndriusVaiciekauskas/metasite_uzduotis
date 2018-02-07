<?php

class Categories
{
	private $categories = [];

	public function allCategories() 
	{
		// atdarom faila
		$myfile = fopen("database/categories.csv", "r") or die("Unable to open file!");
		while(!feof($myfile)) {
			// visas eilutes surasome i masyva
		  array_push($this->categories, fgetcsv($myfile));
		}
		fclose($myfile);
		// graziname masyva
		return $this->categories;
	}
}