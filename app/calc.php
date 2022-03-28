<?php

require_once dirname(__FILE__).'/../config.php';

function getParams(&$form){
	$form['x'] = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$form['y'] = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$form['z'] = isset($_REQUEST['z']) ? $_REQUEST['z'] : null;	
}

function validate(&$form,&$infos,&$msgs,&$hide_intro){


	if ( ! (isset($form['x']) && isset($form['y']) && isset($form['z']) ))	return false;	
	
		$hide_intro = true;

	
	if ( $form['x'] == "") $msgs [] = 'Nie podano wartości pożyczki';
	if ( $form['y'] == "") $msgs [] = 'Nie podano ilości rat';
	if ( $form['z'] == "") $msgs [] = 'Nie podano oprocentowania';
	
	if ( count($msgs)==0 ) {
		
		if (! is_numeric( $form['x'] )) $msgs [] = 'Wartość pożyczki musi zostać zapisana jako liczba.';
		if (! is_numeric( $form['y'] )) $msgs [] = 'Ilość rat musi być zapisana jako liczba całkowita.';
		if (! is_numeric( $form['y'] )) $msgs [] = 'Oprocentowanie musi zostać zapisane jako liczba.';
	}
	
	if (count($msgs)>0) return false;
	else return true;
}
	

function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Wprowadzone wartości są poprawne.';
	
	
	$form['x'] = floatval($form['x']);
	$form['y'] = intval($form['y']);
	$form['z'] = floatval($form['z']);

		$kwota = $form['x'] * ($form['z'] / 100);
		$wynik = ($form['x'] + $kwota) / $form['y'];
		$result = round($wynik,2);
		

}


$form = null;
$infos = array();
$messages = array();
$result = null;

	
getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

$page_title = 'Kalkulator walutowy';
$page_description = '';
$page_header = '';
$page_footer = 'Link do ';

include 'calc_view.php';