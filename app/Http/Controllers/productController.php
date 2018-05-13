<?php

namespace App\Http\Controllers;

use App\Http\Connector\mockConnector;
use App\Http\Helpers\DTOHelper;
use App\Http\Helpers\timeHelper;
use App\Http\Services\validatorService;

class productController extends Controller
{
    private $startDate;
    private $endDate;
    private $travellerNo;
    private $data;
    private $validatorService;
    private $mockConnector;

    public function __construct(validatorService $validatorService, mockConnector $mockConnector)
    {
        $this->validatorService = $validatorService;
        $this->mockConnector = $mockConnector;
    }

    private function searchByFilters() {
        $search = array();
        $searchStartTimestamp = timeHelper::dateTimeTimestamp($this->startDate);
        $searchEndTimestamp = timeHelper::dateTimeTimestamp($this->endDate);
        foreach ($this->data as $value) {
            if($value['places_available'] >= $this->travellerNo) {
                sort($value['activity_start_datetime']);
                $eventStartTimestamp = timeHelper::dateTimeTimestamp($value['activity_start_datetime'][0]);
                $eventEndTimestamp = timeHelper::dateTimeTimestamp(end($value['activity_start_datetime']));
                if($eventStartTimestamp >= $searchStartTimestamp & $eventEndTimestamp <= $searchEndTimestamp) {
                    $search[] = $value;
                }
            }
        }
        $this->data = $search;
    }


    public function getProducts($startDate, $endDate, $travelersNumber)
    {
        $output = array();
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->travellerNo = $travelersNumber;

        //check input before search
        $errors = $this->inputValidator($startDate, $endDate, $travelersNumber);

        if (count($errors) > 0)
            return json_encode($errors);

        //get the data from original file
        $data = $this->mockConnector->getEndPointContent();
        $data = DTOHelper::outputDTO($data);
        $this->data = $data;

        //search by filters
        $this->searchByFilters();

        return json_encode($this->data);
    }

    private function inputValidator()
    {
        $error = array();

        if (!$this->validatorService->isValidTimeStamp($this->startDate))
            $error[] = 'the start datetime not on timestamp format';

        if (!$this->validatorService->isValidTimeStamp($this->endDate))
            $error[] = 'the end datetime not on timestamp format';

        //check if start time smaller time than bigger time
        if(!$this->validatorService->checkTimeOrder($this->startDate,$this->endDate))
            $error[] = 'The start datetime has to be earlier of end datetime';
        if($this->validatorService->checkInteger($this->travellerNo))
            $error[] = 'The traveller number has to be integer value and bigger than 0 and less than 30';

        return $error;
    }
}
