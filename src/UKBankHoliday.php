<?php
namespace Haakym\UKBankHoliday;

use JsonSerializable;

class UKBankHoliday implements JsonSerializable {

    protected $year;
    protected $newYears;
    protected $goodFriday;
    protected $easterMonday;
    protected $mayDay;
    protected $whitSun;
    protected $summerBankHoliday;
    protected $christmas;
    protected $boxingDay;
    protected $milleniumEve;

    public function __construct($year = null)
    {
        $this->year = $year ?: date("Y");
        $this->newYears = $this->newYears($this->year);
        $this->goodFriday = $this->goodFriday($this->year);
        $this->easterMonday = $this->easterMonday($this->year);
        $this->mayDay = $this->mayDay($this->year);
        $this->whitSun = $this->whitSun($this->year);        
        $this->summerBankHoliday = $this->summerBankHoliday($this->year);
        $this->christmas = $this->christmas($this->year);
        $this->boxingDay = $this->boxingDay($this->year);
        $this->milleniumEve = ($this->year == 1999) ? "1999-12-31" : null;
    }

    public function year($year)
    {
        $this->year = $year;
    }

    public function newYears()
    {
        $newYearsDay = date("w", strtotime("{$this->year}-01-01 12:00:00"));

        switch ($newYearsDay) {
            case 6:
                $date = "{$this->year}-01-03";
                break;
            case 0:
                $date = "{$this->year}-01-02";
                break;
            default:
                $date = "{$this->year}-01-01";
        }

        return $date;
    }

    public function goodFriday()
    {
        return date("Y-m-d", strtotime( "+".(easter_days($this->year) - 2)." days", strtotime("{$this->year}-03-21 12:00:00") ));
    }

    public function easterMonday()
    {
        return date("Y-m-d", strtotime( "+".(easter_days($this->year) + 1)." days", strtotime("{$this->year}-03-21 12:00:00") ));
    }

    public function mayDay()
    {
        $mayDay = '';

        if ($this->year == 1995) {
            $mayDay = "1995-05-08"; // VE day 50th anniversary year exception
        } else {
            switch (date("w", strtotime("{$this->year}-05-01 12:00:00"))) {
                case 0:
                    $mayDay = "{$this->year}-05-02";
                    break;
                case 1:
                    $mayDay = "{$this->year}-05-01";
                    break;
                case 2:
                    $mayDay = "{$this->year}-05-07";
                    break;
                case 3:
                    $mayDay = "{$this->year}-05-06";
                    break;
                case 4:
                    $mayDay = "{$this->year}-05-05";
                    break;
                case 5:
                    $mayDay = "{$this->year}-05-04";
                    break;
                case 6:
                    $mayDay = "{$this->year}-05-03";
                    break;
            }
        }
        return $mayDay;
    }

    public function whitSun()
    {
        $whitSun = '';

        if ($this->year == 2002) { // exception year
            $whitSun = "2002-06-03";
            $whitSun = "2002-06-04";
        } else {
            switch (date("w", strtotime("{$this->year}-05-31 12:00:00"))) {
                case 0:
                    $whitSun = "{$this->year}-05-25";
                    break;
                case 1:
                    $whitSun = "{$this->year}-05-31";
                    break;
                case 2:
                    $whitSun = "{$this->year}-05-30";
                    break;
                case 3:
                    $whitSun = "{$this->year}-05-29";
                    break;
                case 4:
                    $whitSun = "{$this->year}-05-28";
                    break;
                case 5:
                    $whitSun = "{$this->year}-05-27";
                    break;
                case 6:
                    $whitSun = "{$this->year}-05-26";
                    break;
            }
        }
        return $whitSun;
    }

    public function summerBankHoliday()
    {
        $summerBankHoliday = '';

        switch (date("w", strtotime("{$this->year}-08-31 12:00:00"))) {
            case 0:
                $summerBankHoliday = "{$this->year}-08-25";
                break;
            case 1:
                $summerBankHoliday = "{$this->year}-08-31";
                break;
            case 2:
                $summerBankHoliday = "{$this->year}-08-30";
                break;
            case 3:
                $summerBankHoliday = "{$this->year}-08-29";
                break;
            case 4:
                $summerBankHoliday = "{$this->year}-08-28";
                break;
            case 5:
                $summerBankHoliday = "{$this->year}-08-27";
                break;
            case 6:
                $summerBankHoliday = "{$this->year}-08-26";
                break;
        }
        return $summerBankHoliday;
    }

    public function christmas()
    {
        $christmas = "";

        switch ( date("w", strtotime("{$this->year}-12-25 12:00:00")) ) {
            case 5:
                $christmas = "{$this->year}-12-25";
                break;
            case 6:
                $christmas = "{$this->year}-12-27";
                break;
            case 0:
                $christmas = "{$this->year}-12-26";
                break;
            default:
                $christmas = "{$this->year}-12-25";
        }
        return $christmas;
    }

    public function boxingDay()
    {
        $boxingDay = "";

        switch ( date("w", strtotime("{$this->year}-12-25 12:00:00")) ) {
            case 5:
                $boxingDay = "{$this->year}-12-28";
                break;
            case 6:
                $boxingDay = "{$this->year}-12-28";
                break;
            case 0:
                $boxingDay = "{$this->year}-12-27";
                break;
            default:
                $boxingDay = "{$this->year}-12-26";
        }
        return $boxingDay;
    }

    public function all()
    {
        return $this->toArray();
    }
    
    public function toArray()
    {
        return get_object_vars($this);
    }

    public function toJson()
    {
        return $this->jsonSerialize();
    }

    public function jsonSerialize()
    {
        return json_encode($this->toArray());
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }

        throw new InexistentPropertyException("Inexistent property: $property");
    }

}
