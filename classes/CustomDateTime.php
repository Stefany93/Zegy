<?php
/**
 * A user-friendly class for handling dates.
 */
class CustomDateTime extends DateTime 
{
    protected $year;
    protected $month;
    protected $day;
    protected $arrangeDates;
    
    #####################################################
    # STATIC METHOD                                     #
    #####################################################
    /**
     * Calculate the number of days between two dates.
     *
     * @param Pos_Date $startDate Starting date.
     * @param Pos_Date $endDate Finishing date.
     * @return int Number of days between start and end dates.
     */
    static public function dateDiff(CustomDateTime $startDate, CustomDateTime $endDate)
    {
        // code
    }
    
    ####################################################
    # OVERRIDDEN METHODS                               #
    ####################################################
    /**
     * Constructor method.
     * 
     * The constructor overrides the PHP DateTime class and sets the value
     * of the internal properties. Creates an object for the current date
     * and time only, but accepts an optional argument to set the time zone.
     * 
     * @param DateTimeZone $timezone string Optional DateTimeZone object.
     * @return Pos_Date
     */
    public function __construct($timezone = null)
    {
        // call the parent constructor
        if ($timezone) {
            parent::__construct ( 'now', $timezone );
        } else {
            parent::__construct ( 'now' );
        }
        // assign the values to the class properties
        $this->_year = ( int ) $this->format ( 'Y' );
        $this->_month = ( int ) $this->format ( 'n' );
        $this->_day = ( int ) $this->format ( 'j' );
    }
    
    /**
     * Resets the current time. 
     * 
     * This overrides the parent method to prevent out-of-range units
     * being accepted.
     *
     * @param int $hours    Number between 0 and 23.
     * @param int $minutes  Number between 0 and 59.
     * @param int $seconds  (Optional) Number beween 0 and 59; default 0. 
     */

   public function setTime($hours, $minutes, $seconds = 0)
    {
        if (! is_numeric ( $hours ) || ! is_numeric ( $minutes ) || ! is_numeric ( $seconds )) {
            throw new Exception ( 'setTime() expects two or three numbers separated by commas in the order: hours, minutes, seconds' );
        }
        $outOfRange = false;
        if ($hours < 0 || $hours > 23) {
            $outOfRange = true;
        }
        if ($minutes < 0 || $minutes > 59) {
            $outOfRange = true;
        }
        if ($seconds < 0 || $seconds > 59) {
            $outOfRange = true;
        }
        if ($outOfRange) {
            throw new Exception ( 'Invalid time.' );
        }
        parent::setTime ( $hours, $minutes, $seconds );
    }
    /**
     * Changes the date represented by the object.
     * 
     * Overrides the parent setDate() method, and checks
     * that the arguments supplied constitute a valid date.
     * 
     * @param  int   $year   The year as a four-digit number.
     * @param  int   $month  The month as a number between 1 and 12.
     * @param  int   $day    The day as a number between 1 and 31.
     */
    public function setDate($year, $month, $day) {
        if (! is_numeric ( $year ) || ! is_numeric ( $month ) || ! is_numeric ( $day )) {
            throw new Exception ( 'setDate() expects three numbers separated by commas in the order: year, month, day.' );
        }
        if (! checkdate ( $month, $day, $year )) {
            throw new Exception ( 'Non-existent date.' );
        }
        parent::setDate ( $year, $month, $day );
        $this->_year = ( int ) $year;
        $this->_month = ( int ) $month;
        $this->_day = ( int ) $day;
    }

    public function getForumDate()
    {
       // $this->setTimestamp($timestamp);
     
             return $this->format( 'F d Y' );
        
        switch ($style)
         {
            case 'american':
                return $this->format ( 'm/d/Y' );
                break;
            case 'East asian':
                return $this->format ( 'Y/m/d' );
                break;
            default: // Default is European
                return $this->format ( 'd/m/Y' );
                break;
        }
    }
  
    ##################################################
    # PUBLIC METHODS FOR GETTING DATE PARTS          #
    ##################################################
    /**
     * Get year as four-digit number.
     *
     * @return int Year as four-digit number
     */
    public function getFullYear() {
        return $this->_year;
    }
    
    /**
     * Get year as two-digit number.
     *
     * @return string Year as two-digit number
     */
    public function getYear() {
        return $this->format ( 'y' );
    }
    
    /**
     * Get month with or without leading zero.
     * 
     * Optional Boolean argument adds leading zero if true. Defaults to false.
     *
     * @param bool $leadingZero (Optional) adds leading zero if true; default false.
     * @return int|string Month.
     */
    public function getMonth($leadingZero = false) {
        return $leadingZero ? $this->format ( 'm' ) : $this->_month;
    }
    
    /**
     * Get month name in full.
     *
     * @return string Month name in full.
     */
    public function getMonthName() {
        return $this->format ( 'F' );
    }
    
    /**
     * Get month name as three-letter abbreviation.
     *
     * @return string Abbreviated month name.
     */
    public function getMonthAbbr() {
        return $this->format ( 'M' );
    }
    
    /**
     * Get day with or without leading zero.
     * 
     * Optional Boolean argument adds leading zero if true. Defaults to false.
     *
     * @param bool $leadingZero (Optional) adds leading zero if true; default false.
     * @return int|string Day.
     */
    public function getDay($leadingZero = false) {
        return $leadingZero ? $this->format ( 'd' ) : $this->_day;
    }
    
    /**
     * Get day number as English ordinal (1st, 2nd, etc.)
     *
     * @return string Day number as ordinal
     */
    public function getDayOrdinal() {
        return $this->format ( 'jS' );
    }
    
    /**
     * Get day name in full.
     *
     * @return string Full day name.
     */
    public function getDayName() {
        return $this->format ( 'l' );
    }
    
    /**
     * Get day name as abbreviation.
     *
     * @return string Abbreviated day name.
     */
    public function getDayAbbr() {
        return $this->format ( 'D' );
    }
    
    ################################################
    # PUBLIC METHODS FOR DATE CALCULATIONS         #
    ################################################
    /**
     * Add specified number of days to stored date.
     *
     * @param int $numDays Number of days to be added, must be positive.
     */
    public function addDays($numDays) {
        if (! is_numeric ( $numDays ) || $numDays < 1) {
            throw new Exception ( 'addDays() expects a positive integer.' );
        }
        parent::modify ( '+' . intval ( $numDays ) . ' days' );
    }
    
    /**
     * Subtract specified number of days from stored date.
     * 
     * Accepts either a positive or negative number, but uses only the
     * absolute value.
     *
     * @param int $numDays Number of days to be subtracted.
     */
    public function subDays($numDays) {
        if (! is_numeric ( $numDays )) {
            throw new Exception ( 'subDays() expects an integer.' );
        }
        parent::modify ( '-' . abs ( intval ( $numDays ) ) . ' days' );
    }
    
    /**
     * Add specified number of weeks to date.
     *
     * @param int $numWeeks Number of weeks to be added, must be positive.
     */
    public function addWeeks($numWeeks) {
        if (! is_numeric ( $numWeeks ) || $numWeeks < 1) {
            throw new Exception ( 'addWeeks() expects a positive integer.' );
        }
        parent::modify ( '+' . intval ( $numWeeks ) . ' weeks' );
    }
    
    /**
     * Subtract specified number of weeks from date.
     * 
     * Accepts either a positive or negative number, but uses only the
     * absolute value.
     * 
     * @param int $numWeeks Number of weeks to be subtracted.
     */
    public function subWeeks($numWeeks) {
        if (! is_numeric ( $numWeeks )) {
            throw new Exception ( 'subWeeks() expects an integer.' );
        }
        parent::modify ( '-' . abs ( intval ( $numWeeks ) ) . ' weeks' );
    }
    
    /**
     * Add specified number of months to date.
     * 
     * This method adjusts the result to the final day of the month if
     * the resulting date is invalid, e.g., September 31 is converted
     * to September 30. Results in February also take account of leap
     * year. This contrasts with DateTime::modify() and strtotime, which
     * produce unexpected results by adding the day(s). 
     *
     * @param int $numMonths Number of months to be added.
     */
    public function addMonths($numMonths) {
        if (! is_numeric ( $numMonths ) || $numMonths < 1) {
            throw new Exception ( 'addMonths() expects a positive integer.' );
        }
        $numMonths = ( int ) $numMonths;
        // Add the months to the current month number.
        $newValue = $this->_month + $numMonths;
        // If the new value is less than or equal to 12, the year
        // doesn't change, so just assign the new value to the month.
        if ($newValue <= 12) {
            $this->_month = $newValue;
        } else {
            // A new value greater than 12 means calculating both
            // the month and the year. Calculating the year is
            // different for December, so do modulo division 
            // by 12 on the new value. If the remainder is not 0,
            // the new month is not December. 
            $notDecember = $newValue % 12;
            if ($notDecember) {
                // The remainder of the modulo division is the new month.
                $this->_month = $notDecember;
                // Divide the new value by 12 and round down to get the
                // number of years to add.
                $this->_year += floor ( $newValue / 12 );
            } else {
                // The new month must be December
                $this->_month = 12;
                $this->_year += ($newValue / 12) - 1;
            }
        }
        $this->checkLastDayOfMonth ();
        parent::setDate ( $this->_year, $this->_month, $this->_day );
    }
    
    /**
     * Subtract specified number of months from date.
     * 
     * This method adjusts the result to the final day of the month if
     * the resulting date is invalid, e.g., September 31 is converted
     * to September 30. Results in February also take account of leap
     * year. This contrasts with DateTime::modify() and strtotime, which
     * produce unexpected results by subtracting the day(s). 
     *
     * @param int $numMonths Number of months to be subtracted.
     */
    public function subMonths($numMonths) {
        if (! is_numeric ( $numMonths )) {
            throw new Exception ( 'addMonths() expects an integer.' );
        }
        $numMonths = abs ( intval ( $numMonths ) );
        // Subtract the months from the current month number.
        $newValue = $this->_month - $numMonths;
        // If the result is greater than 0, it's still the same year,
        // and you can assign the new value to the month.
        if ($newValue > 0) {
            $this->_month = $newValue;
        } else {
            // Create an array of the months in reverse.
            $months = range (12, 1);
            // Get the absolute value of $newValue.
            $newValue = abs ( $newValue );
            // Get the array position of the resulting month.
            $monthPosition = $newValue % 12;
            $this->_month = $months [$monthPosition];
            // Arrays begin at 0, so if $monthPosition is 0,
            // it must be December.
            if ($monthPosition) {
                $this->_year -= ceil ( $newValue / 12 );
            } else {
                $this->_year -= ceil ( $newValue / 12 ) + 1;
            }
        }
        $this->checkLastDayOfMonth ();
        parent::setDate ( $this->_year, $this->_month, $this->_day );
    }
    
    /**
     * Add specified number of years to date.
     * 
     * Adding years to February 29 can produce an invalid date if
     * the resulting year is not a leap year. This method takes
     * this into account, and adjusts the result to February 28
     * if necessary
     *
     * @param int $numYears Number of years to be added.
     */
    public function addYears($numYears) {
        if (! is_numeric ( $numYears ) || $numYears < 1) {
            throw new Exception ( 'addYears() expects a positive integer.' );
        }
        $this->_year += ( int ) $numYears;
        $this->checkLastDayOfMonth ();
        parent::setDate ( $this->_year, $this->_month, $this->_day );
    }
    
    /**
     * Subtract specified number of years from date.
     * 
     * Subtracting years from February 29 can produce an invalid date if
     * the resulting year is not a leap year. This method takes
     * this into account, and adjusts the result to February 28
     * if necessary
     *
     * @param int $numYears Number of years to be subtracted.
     */
    public function subYears($numYears) {
        if (! is_numeric ( $numYears )) {
            throw new Exception ( 'subYears() expects an integer.' );
        }
        $this->_year -= abs ( intval ( $numYears ) );
        $this->checkLastDayOfMonth ();
        parent::setDate ( $this->_year, $this->_month, $this->_day );
    }
    
    /**
     * Determines whether the year is a leap year.
     *
     * @return bool True if it is a leap year, otherwise false.
     */
    public function isLeap() {
        if ($this->_year % 400 == 0 || ($this->_year % 4 == 0 && $this->_year % 100 != 0)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Calculates the number of days between two dates.
     * 
     * This differs from the static method in that it takes just one
     * argument. The start date is the object that calls the method, 
     * and the end date is passed to it as an argument. 
     *
     * @param Pos_Date $endDate Date that is to be compared with object.
     * @return int Number of days between both dates.
     */
    public function dateDiff2(Pos_Date $endDate) {
        $start = gmmktime ( 0, 0, 0, $this->_month, $this->_day, $this->_year );
        $end = gmmktime ( 0, 0, 0, $endDate->_month, $endDate->_day, $endDate->_year );
        return ($end - $start) / (60 * 60 * 24);
    }
    
    ####################################################
    # MAGIC METHODS                                    #
    ####################################################
    /**
     * Outputs date as string
     *
     * @return string Date formatted like Saturday, March 1st, 2008
     */
    public function __toString() {
        return $this->format ( 'l, F jS, Y' );
    }
}
/*try
{
    $cdt = new CustomDateTime();
    echo $cdt->getDate();
}catch(Exception $e)
{
    echo $e->getMessage();
}*/