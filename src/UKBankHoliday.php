<?php namespace Haakym\UKBankHoliday;

class UKBankHoliday {

    protected $yr;

    public function __construct($yr)
    {
        $this->yr = $yr;
    }

    public function newYears($year)
    {
        $newYearsDay = date("w", strtotime("{$year}-01-01 12:00:00"));

        switch ($newYearsDay) {
            case 6:
                $date = "{$this->yr}-01-03";
                break;
            case 0:
                $date = "{$this->yr}-01-02";
                break;
            default:
                $date = "{$this->yr}-01-01";
        }

        return $date;
    }

    public function goodFriday($year)
    {
        return date("Y-m-d", strtotime( "+".(easter_days($year) - 2)." days", strtotime("{$year}-03-21 12:00:00") ));
    }

    public function easterMonday($year)
    {
        return date("Y-m-d", strtotime( "+".(easter_days($this->yr) + 1)." days", strtotime("{$year}-03-21 12:00:00") ));
    }

    public function mayDay($year)
    {
        $mayDay = '';

        if ($year == 1995) {
            $mayDay = "1995-05-08"; // VE day 50th anniversary year exception
        } else {
            switch (date("w", strtotime("{$year}-05-01 12:00:00"))) {
                case 0:
                    $mayDay = "{$year}-05-02";
                    break;
                case 1:
                    $mayDay = "{$year}-05-01";
                    break;
                case 2:
                    $mayDay = "{$year}-05-07";
                    break;
                case 3:
                    $mayDay = "{$year}-05-06";
                    break;
                case 4:
                    $mayDay = "{$year}-05-05";
                    break;
                case 5:
                    $mayDay = "{$year}-05-04";
                    break;
                case 6:
                    $mayDay = "{$year}-05-03";
                    break;
            }
        }
        return $mayDay;
    }

    public function whitSun($year)
    {
        $whitSun = '';

        if ($year == 2002) { // exception year
            $whitSun = "2002-06-03";
            $whitSun = "2002-06-04";
        } else {
            switch (date("w", strtotime("{$year}-05-31 12:00:00"))) {
                case 0:
                    $whitSun = "{$year}-05-25";
                    break;
                case 1:
                    $whitSun = "{$year}-05-31";
                    break;
                case 2:
                    $whitSun = "{$year}-05-30";
                    break;
                case 3:
                    $whitSun = "{$year}-05-29";
                    break;
                case 4:
                    $whitSun = "{$year}-05-28";
                    break;
                case 5:
                    $whitSun = "{$year}-05-27";
                    break;
                case 6:
                    $whitSun = "{$year}-05-26";
                    break;
            }
        }
        return $whitSun;
    }

    public function summerBankHoliday($year)
    {
        $summerBankHoliday = '';

        switch (date("w", strtotime("{$year}-08-31 12:00:00"))) {
            case 0:
                $summerBankHoliday = "{$year}-08-25";
                break;
            case 1:
                $summerBankHoliday = "{$year}-08-31";
                break;
            case 2:
                $summerBankHoliday = "{$year}-08-30";
                break;
            case 3:
                $summerBankHoliday = "{$year}-08-29";
                break;
            case 4:
                $summerBankHoliday = "{$year}-08-28";
                break;
            case 5:
                $summerBankHoliday = "{$year}-08-27";
                break;
            case 6:
                $summerBankHoliday = "{$year}-08-26";
                break;
        }
        return $summerBankHoliday;
    }

    public function christmas($year)
    {
        $christmas = [];

        switch ( date("w", strtotime("{$this->yr}-12-25 12:00:00")) ) {
            case 5:
                $christmas[] = "{$this->yr}-12-25";
                $christmas[] = "{$this->yr}-12-28";
                break;
            case 6:
                $christmas[] = "{$this->yr}-12-27";
                $christmas[] = "{$this->yr}-12-28";
                break;
            case 0:
                $christmas[] = "{$this->yr}-12-26";
                $christmas[] = "{$this->yr}-12-27";
                break;
            default:
                $christmas[] = "{$this->yr}-12-25";
                $christmas[] = "{$this->yr}-12-26";
        }
        return $christmas;
    }

    public function allBankHolidays()
    {
        $bankHols[] = $this->newYears($this->yr);

        // Good friday:
        $bankHols[] = $this->goodFriday($this->yr);

        // Easter Monday:
        $bankHols[] = $this->easterMonday($this->yr);

        // May Day:
        $bankHols[] = $this->mayDay($this->yr);

        // Whitsun:
        $bankHols[] = $this->whitSun($this->yr);        

        // Summer Bank Holiday:
        $bankHols[] = $this->summerBankHoliday($this->yr);

        // Christmas:
        $bankHols = array_merge($bankHols, $this->christmas($this->yr));

        // Millenium eve
        if ($this->yr == 1999) {
            $bankHols[] = "1999-12-31";
        }

        return $bankHols;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        } else {
            throw new InexistentPropertyException("Inexistent property: $property");
        }
    }

}
