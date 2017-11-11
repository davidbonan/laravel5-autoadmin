
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var select2 = require('select2');
var minicolors = require('@claviska/jquery-minicolors/');

$(document).ready(function(){
	//Initialize Select2 Elements
    $('.select2').select2();

    //Initialize Colorpicker Elements
    $('.color-picker').minicolors();
});