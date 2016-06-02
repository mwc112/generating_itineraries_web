<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

	class Line {
		public $id;
		public $statuses;
	}

	class Status {
		public $severity;
		public $severityDescription;
		public $validityPeriods;
	}

	class Period {
		public $toDate;
		public $fromDate;
	}

	class TflDate {
		public $year;
		public $month;
		public $day;
	}

class TravelDisruptionController extends Controller {

	public function getDisruption(Request $request) {


		//TODO: Ignore travel mode and city for now
		//TODO: add token so that only our requests taken
		//TODO: check whether it is an issue for our routes with detail?
		if($request->has('city') and $request->has('start_date') and
				$request->has('end_date') and $request->has('travel_mode')) {

			$result = file_get_contents('https://api.tfl.gov.uk/Line/Mode/tube/'
					. 'Status?startDate=' . $request->start_date . '&endDate='
					. $request->end_date . '&detail=False&app_id=ceb20f55'
					. '&app_key=b0c1e57c66038a2d4ad67bd94a113a82');

			$result_obj = json_decode($result);


			$result_ret = array();


			for($i = 0; $i < count($result_obj); $i++) {
				$line = $result_obj[$i];
				$result_ret[$i] = new Line;
				$result_ret[$i]->id = $line->id;
				$result_ret[$i]->statuses = array();
				
				for($j = 0; $j < count($line->lineStatuses); $j++) {
					$line_stat = $line->lineStatuses[$j];		

					$result_ret[$i]->statuses[$j] = new Status;
					$result_ret[$i]->statuses[$j]->severity = $line_stat->statusSeverity;
					$result_ret[$i]->statuses[$j]->severityDescription = 
							$line_stat-> statusSeverityDescription;

					if($line_stat->statusSeverity != 10) {
						$result_ret[$i]->statuses[$j]->validityPeriods = array();
						for($k = 0; $k < count($line_stat->validityPeriods); $k++) {
							$old_from_date = $line_stat->validityPeriods[$k]->fromDate;
							$old_to_date = $line_stat->validityPeriods[$k]->toDate;
							$from_date = new TflDate;
							$to_date = new TflDate;
							$from_date->year = intval(substr($old_from_date, 0, 4));
							$from_date->month = intval(substr($old_from_date, 5, 2));
							$from_date->day = intval(substr($old_from_date, 8, 2));
							$to_date->year = intval(substr($old_to_date, 0, 4));
							$to_date->month = intval(substr($old_to_date, 5, 2));
							$to_date->day = intval(substr($old_to_date, 8, 2));

							if($from_date->year == $to_date->year
										and $from_date->month == $to_date->month
										and $from_date->day == $to_date->day
										and intval(substr($old_to_date, 11, 2))
										- intval(substr($old_from_date, 11, 2)) < 4) {
								
							}
							else {
								$result_ret[$i]->statuses[$j]->validityPeriods[$k] = new Period;
								$result_ret[$i]->statuses[$j]->validityPeriods[$k]->fromDate =
										$from_date;

								$result_ret[$i]->statuses[$j]->validityPeriods[$k]->toDate =
										$to_date;
							}
						}

					}
				}

			}


			return json_encode($result_ret);

		}

		return 'Bad Request';
	}

	/*private function increaseByDay(TflDate $date) {
		if($date->day == intval(date('t', strtotime($date->month . $date->day)))) {
			if($date->month == 12) {
				$date->year = $date->year + 1;
			}
			else {
				$date->month = $date->month + 1;
			}
		}
		else {
			$date->day = $date->day+1;
		}
	}*/

}


?>
