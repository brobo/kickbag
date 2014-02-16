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
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, you can find a copy of it at
* <http://www.gnu.org/licenses/gpl.html>
*************************************************************************/

/*
 * A panel seat is just the embodiment of
 * of a has-and-belongs-to-many relationship
 * for testings and judges.
 * 
 * CakePHP has weak support for HABTM tables with
 * additional fields (in this case, the rank of the
 * judge at the time of testing), so we have to use
 * this pseudo-model to encapsulate both foreign keys
 * with the additional column.
 */
class PanelSeat extends AppModel {
	public $belongsTo = array('Testing', 'Judge');
}
?>