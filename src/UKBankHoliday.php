<?php namespace Haakym\UKBankHoliday;

class UKBankHoliday {

    protected $yr;

    public function __construct($yr) {
        $this->yr = $yr;
    }

    public function getAllBankHolidays() {
        // New year's:
        switch ( date("w", strtotime("{$this->yr}-01-01 12:00:00")) ) {
            case 6:
                $bankHols[] = "{$this->yr}-01-03";
                break;
            case 0:
                $bankHols[] = "{$this->yr}-01-02";
                break;
            default:
                $bankHols[] = "{$this->yr}-01-01";
        }

        // Good friday:
        $bankHols[] = date("Y-m-d", strtotime( "+".(easter_days($this->yr) - 2)." days", strtotime("{$this->yr}-03-21 12:00:00") ));

        // Easter Monday:
        $bankHols[] = date("Y-m-d", strtotime( "+".(easter_days($this->yr) + 1)." days", strtotime("{$this->yr}-03-21 12:00:00") ));

        // May Day:
        if ($this->yr == 1995) {
            $bankHols[] = "1995-05-08"; // VE day 50th anniversary year exception
        } else {
            switch (date("w", strtotime("{$this->yr}-05-01 12:00:00"))) {
                case 0:
                    $bankHols[] = "{$this->yr}-05-02";
                    break;
                case 1:
                    $bankHols[] = "{$this->yr}-05-01";
                    break;
                case 2:
                    $bankHols[] = "{$this->yr}-05-07";
                    break;
                case 3:
                    $bankHols[] = "{$this->yr}-05-06";
                    break;
                case 4:
                    $bankHols[] = "{$this->yr}-05-05";
                    break;
                case 5:
                    $bankHols[] = "{$this->yr}-05-04";
                    break;
                case 6:
                    $bankHols[] = "{$this->yr}-05-03";
                    break;
            }
        }

        // Whitsun:
        if ($this->yr == 2002) { // exception year
            $bankHols[] = "2002-06-03";
            $bankHols[] = "2002-06-04";
        } else {
            switch (date("w", strtotime("{$this->yr}-05-31 12:00:00"))) {
                case 0:
                    $bankHols[] = "{$this->yr}-05-25";
                    break;
                case 1:
                    $bankHols[] = "{$this->yr}-05-31";
                    break;
                case 2:
                    $bankHols[] = "{$this->yr}-05-30";
                    break;
                case 3:
                    $bankHols[] = "{$this->yr}-05-29";
                    break;
                case 4:
                    $bankHols[] = "{$this->yr}-05-28";
                    break;
                case 5:
                    $bankHols[] = "{$this->yr}-05-27";
                    break;
                case 6:
                    $bankHols[] = "{$this->yr}-05-26";
                    break;
            }
        }

        // Summer Bank Holiday:
        switch (date("w", strtotime("{$this->yr}-08-31 12:00:00"))) {
            case 0:
                $bankHols[] = "{$this->yr}-08-25";
                break;
            case 1:
                $bankHols[] = "{$this->yr}-08-31";
                break;
            case 2:
                $bankHols[] = "{$this->yr}-08-30";
                break;
            case 3:
                $bankHols[] = "{$this->yr}-08-29";
                break;
            case 4:
                $bankHols[] = "{$this->yr}-08-28";
                break;
            case 5:
                $bankHols[] = "{$this->yr}-08-27";
                break;
            case 6:
                $bankHols[] = "{$this->yr}-08-26";
                break;
        }

        // Christmas:
        switch ( date("w", strtotime("{$this->yr}-12-25 12:00:00")) ) {
            case 5:
                $bankHols[] = "{$this->yr}-12-25";
                $bankHols[] = "{$this->yr}-12-28";
                break;
            case 6:
                $bankHols[] = "{$this->yr}-12-27";
                $bankHols[] = "{$this->yr}-12-28";
                break;
            case 0:
                $bankHols[] = "{$this->yr}-12-26";
                $bankHols[] = "{$this->yr}-12-27";
                break;
            default:
                $bankHols[] = "{$this->yr}-12-25";
                $bankHols[] = "{$this->yr}-12-26";
        }

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
