/* Add copyright to footer 								*/
/* Author:		Barry J. Sullens 						*/
/* Date:		June 21, 2016 							*/
/* Description:	Adds current copyright year to footer 	*/

"use strict";

var copyrightElement = document.getElementById("copyright");
var currentYear = new Date().getFullYear(); 

copyrightElement.innerHTML = currentYear;