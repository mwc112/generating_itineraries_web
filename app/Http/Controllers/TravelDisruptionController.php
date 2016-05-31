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
							$result_ret[$i]->statuses[$j]->validityPeriods[$k] = new Period;
							$result_ret[$i]->statuses[$j]->validityPeriods[$k]->fromDate =
									$line_stat->validityPeriods[$k]->fromDate;

							$result_ret[$i]->statuses[$j]->validityPeriods[$k]->toDate =
									$line_stat->validityPeriods[$k]->toDate;
						}

					}
				}

			}


			return json_encode($result_ret);

		}

	}

}


?>
