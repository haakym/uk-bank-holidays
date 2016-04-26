<?php
 
use Haakym\UKBankHoliday\UKBankHoliday;
 
class UKBankHolidayTest extends PHPUnit_Framework_TestCase {
 
    public function testGetYearProperty()
    {
        $bankHolidays = new UKBankHoliday("2007");

        $this->assertEquals($bankHolidays->year, "2007");
    }

  public function testGetAllBankHolidays()
  {
    $allBankHolidays = (new UKBankHoliday("2007"))->all();
    
    $expectedDates = [
        'year'           => '2007',
        'newYears'           => '2007-01-01',
        'goodFriday'         => '2007-04-06',
        'easterMonday'       => '2007-04-09',
        'mayDay'             => '2007-05-07',
        'whitSun'            => '2007-05-28',
        'summerBankHoliday' => '2007-08-27',
        'christmas'           => '2007-12-25',
        'boxingDay'          => '2007-12-26',
        'milleniumEve'          => null,
    ];

    $this->assertEquals($allBankHolidays, $expectedDates);
  }

  public function testBankHolidaysToArray()
  {
    $bankHolidaysArray = (new UKBankHoliday("2007"))->toArray();

    $expectedDates = [
        'year'           => '2007',
        'newYears'           => '2007-01-01',
        'goodFriday'         => '2007-04-06',
        'easterMonday'       => '2007-04-09',
        'mayDay'             => '2007-05-07',
        'whitSun'            => '2007-05-28',
        'summerBankHoliday' => '2007-08-27',
        'christmas'           => '2007-12-25',
        'boxingDay'          => '2007-12-26',
        'milleniumEve'          => null,
    ];

    $this->assertEquals($bankHolidaysArray, $expectedDates);
  }

  public function testBankHolidaysToJson()
  {
    $bankHolidaysJson = (new UKBankHoliday("2007"))->toJson();

    $expectedDatesJson = '{"year":"2007","newYears":"2007-01-01","goodFriday":"2007-04-06","easterMonday":"2007-04-09","mayDay":"2007-05-07","whitSun":"2007-05-28","summerBankHoliday":"2007-08-27","christmas":"2007-12-25","boxingDay":"2007-12-26","milleniumEve":null}';

    $this->assertEquals($bankHolidaysJson, $expectedDatesJson);
  }
 
}