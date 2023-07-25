<?php 

if (! function_exists('getWeekDates')) {
	function getWeekDates($duration){
		$dt = new \DateTime();
	    // create DateTime object with current time
	    if($duration == 'next-week'){
	    	$dt->setISODate($dt->format('o'), $dt->format('W') + 1);
	    }
	    if($duration == 'last-week'){
	    	$dt->setISODate($dt->format('o'), $dt->format('W') - 1);
	    }
	    // set object to Monday on next week
	    $periods = new \DatePeriod($dt, new \DateInterval('P1D'), 6);
	    // get all 1day periods from Monday to +6 days
	    $days = iterator_to_array($periods);
	    // convert DatePeriod object to array
	    return $days;
	}
}

if (! function_exists('getMonthDates')) {
	function getMonthDates($duration){
		if($duration == 'next-month'){
			$date = date('Y-m-d', strtotime('+1 month'));	
		}
		if($duration == 'last-month'){
			$date = date('Y-m-d', strtotime('-1 month'));	
		}
		$start_date = date("Y-m-01", strtotime($date));
		$end_date = date("Y-m-t", strtotime($date)); 
		return [
			'start_date' => $start_date,
			'end_date'   => $end_date
		];
	}
}


if (! function_exists('isWeekend')) {
	function isWeekend($date) {
	    $weekDay = date('w', strtotime($date));
	    if($weekDay == 0 || $weekDay == 6){
	    	return 1;
	    }else{
	    	return 0;
	    }
	}
}


?>