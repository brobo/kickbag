<?php

/*************************************************************************
 * This file is a part of the Kickbag martial arts manager.
* Copyright © 2014 Colby Brown
*
* This program is free software; you can redistribute it and/or modify it
* under the terms of the GNU General Public License as published by the
* Free Software Foundation; either version 3 of the License,
* or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
*************************************************************************/

App::uses('AppModel','Model');
class TestingStudent extends AppModel {
	public $name = 'TestingStudent';
	public $hasOne = array('Testing', 
			'Student' => array(
				'className' => 'Student',
				'foreignKey' => 'ata_number',
				'dependent' => false)	
	); 
	
	//TODO -- This is all vestigal now! This needs to go away!
	// Remember, ranks are now based on the lookup table!
	/*
	public $ranks = array(
			'W' => 'White',
			'W+' => 'White +',
			'O' => 'Orange',
			'O+' => 'Orange +',
			'Y' => 'Yellow',
			'Y+' => 'Yellow +',
			'Ca' => 'Camo',
			'Ca+' => 'Camo +',
			'G' => 'Green',
			'G+' => 'Green +',
			'P' => 'Purple',
			'P+' => 'Purple +',
			'Bl' => 'Blue',
			'Bl+' => 'Blue +',
			'Br' => 'Brown',
			'Br+' => 'Brown +',
			'RB' => 'Red-Black',
			'B' => '1° Degree',
			'2B' => '2° Degree',
			'2B+' => '2° Degree +',
			'3B' => '3° Degree',
			'4B' => '4° Degree',
			'5B' => '5° Degree',
			'6B+' => '6° Degree (+)');*/
}