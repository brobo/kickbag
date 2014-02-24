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

var intervalId;

$(function() {
	navigator.webkitGetUserMedia({video:true, audio:false},
		function(stream) {
			$('#live').attr('src', window.webkitURL.createObjectURL(stream));
		},
		function(err) {
			console.log('Unable to get video stream.');
		}
	);
	$('#live').on('play', start);
	$('.stillbtn').hide();
	$('.livebtn').show();
});

function start() {
	var canvas = document.getElementById("canv");
	var context = canvas.getContext("2d");
	var video = document.getElementById("live");
	context.translate(canvas.width, 0);
	context.scale(-1,1);
	intervalId = setInterval(function() {
		context.drawImage(video, 200, 0, 200, 300,0,0,200,300);
	}, 10);
	$('.stillbtn').hide();
	$('.livebtn').show();
}

function snap() {
	clearInterval(intervalId);
	$('.livebtn').hide();
	$('.stillbtn').show();
	var canvas = document.getElementById("canv");
	var data = canvas.toDataURL();
	$('#picturePictureData').val(data.substring(data.indexOf(",")+1));
}