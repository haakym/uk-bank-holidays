<?php
 
use Haakym\UKBankHoliday\UKBankHoliday;
 
class UKBankHolidayTest extends PHPUnit_Framework_TestCase {
 
    public function testGetYearProperty()
    {
        $bankHolidays = new UKBankHoliday("2007");

        $this->assertEquals($bankHolidays->yr, "2007");
    }

  public function testGetAllBankHolidays()
  {
    $allBankHolidays = (new UKBankHoliday("2007"))->allBankHolidays();
    
    $expectedDates = [
        "2007-01-01",
        "2007-04-06",
        "2007-04-09",
        "2007-05-07",
        "2007-05-28",
        "2007-08-27",
        "2007-12-25",
        "2007-12-26",
    ];

    $this->assertEquals($allBankHolidays, $expectedDates);
  }
 
}