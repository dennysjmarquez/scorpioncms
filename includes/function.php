<?php

function get_the_date( $d = '', $post = null ) {

	global $Query;

	$post = $Query->post();

	if ( ! $post ) {
		return false;
	}

	if ( '' == $d ) {
		$the_date = mysql2date( "", $post["date"] );
	} else {
		$the_date = mysql2date( $d, $post["date"] );
	}



	echo $the_date;
}

function current_time( $type, $gmt = 0 ) {

	global $Query;

	switch ( $type ) {
		case 'mysql':
			return ( $gmt ) ? gmdate( 'Y-m-d H:i:s' ) : gmdate( 'Y-m-d H:i:s', ( time() + ( get_config("gmt_offset") * HOUR_IN_SECONDS ) ) );
		case 'timestamp':
			return ( $gmt ) ? time() : time() + ( get_config("gmt_offset") * HOUR_IN_SECONDS );
		case 'mysql2':

			date_default_timezone_set('UTC');
			$timestamp = time()+date("Z");

			return gmdate("Y/m/d G:i:s",$timestamp);

		default:
			return ( $gmt ) ? date( $type ) : date( $type, time() + ( get_config("gmt_offset") * HOUR_IN_SECONDS ) );
	}
}

function mysql2date( $format, $date, $translate = false ) {

	global $lang;

	if ( empty( $date ) ) return false;

	if ( 'G' == $format ) return strtotime( $date . ' +0000' );

	$i = strtotime( $date );

	$dia = date("d", $i);

	$mes = $lang->_s(date("F", $i), true);

	$año = date("Y", $i);

	$formato = $dia ."  ". $mes .", " . $año;

	if ( 'U' == $format ) return $i;



		return $formato;

}

function custom_str_contains($haystack, $needles) {

	foreach ((array) $needles as $needle) {
		
		if ($needle != '' && strpos($haystack, $needle) !== false) return true;

	}

	return false;

}
