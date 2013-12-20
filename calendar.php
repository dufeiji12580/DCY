<link type="text/css" rel="stylesheet" href="style/link.css">
<style type="text/css">
            table.calendar {
                
            }
            .calendar th, .calendar td {
                width:30px;
                text-align:center;
            }            
            .calendar th {
                background-color:#09F;
                color:#fff;
            }
            .today{
		color:#fff;
		background-color:#09F;                
            }
        </style>
<?php
class Calendar
{
    private $year;
    private $month;
    private $weeks  = array('日','一','二','三','四','五','六');
    
    function __construct($options = array()) {
        $this->year = date('Y');
        $this->month = date('m');
        
        $vars = get_class_vars(get_class($this));
        foreach ($options as $key=>$value) {
            if (array_key_exists($key, $vars)) {
                $this->$key = $value;
            }
        }
    }
    
    function display()
    {
        echo '<table class="calendar">';
        $this->showChangeDate();
        $this->showWeeks();
        $this->showDays($this->year,$this->month);
        echo '</table>';
    }
    
    private function showWeeks()
    {
        echo '<tr>';
        foreach($this->weeks as $title)
        {
            echo '<th>'.$title.'</th>';
        }
        echo '</tr>';
    }
    
    private function showDays($year, $month)
    {
        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $starDay = date('w', $firstDay);
        $days = date('t', $firstDay);

        echo '<tr>';
        for ($i=0; $i<$starDay; $i++) {
            echo '<td>&nbsp;</td>';
        }
        
        for ($j=1; $j<=$days; $j++) {
            $i++;
            if ($j == date('d')) {
                echo '<td class="today">'.$j.'</td>';
            } else {
                echo '<td>'.$j.'</td>';
            }
            if ($i % 7 == 0) {
                echo '</tr><tr>';
            }
        }
        
        echo '</tr>';
    }
    
    private function showChangeDate()
    {
        
        $url = basename($_SERVER['REQUEST_URI']);
        if(isset($_GET['year']) && isset($_GET['month'])){
			if(stripos($url,"?year=")){
				$url = substr($url,0,stripos($url,"year="));
			}
			else if(stripos($url,"&year="))
				$url = substr($url,0,stripos($url,"year="));
		}
		else if(stripos($url,"?"))
			$url = str_pad($url,strlen($url)+1,"&");
		else
			$url = str_pad($url,strlen($url)+1,"?");
        echo '<tr>';
	echo '<td><a class="SelectedLeftMenu" href="'.$url.$this->preYearUrl($this->year,$this->month).'">'.'<<'.'</a></td>';
	echo '<td><a class="SelectedLeftMenu" href="'.$url.$this->preMonthUrl($this->year,$this->month).'">'.'<'.'</a></td>';
        echo '<td colspan="3"><form>';
        
        echo '<select name="year" onchange="window.location=\''.$url.'year=\'+this.options[selectedIndex].value+\'&month='.$this->month.'\'">';
        for($ye=2000; $ye<=2038; $ye++) {
            $selected = ($ye == $this->year) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$ye.'">'.$ye.'</option>';
        }
        echo '</select>';
        echo '<select name="month" onchange="window.location=\''.$url.'year='.$this->year.'&month=\'+this.options[selectedIndex].value+\'\'">';
        

        
        for($mo=1; $mo<=12; $mo++) {
            $selected = ($mo == $this->month) ? 'selected' : '';
            echo '<option '.$selected.' value="'.$mo.'">'.$mo.'</option>';
        }
        echo '</select>';        
        echo '</form></td>';        
	echo '<td><a class="SelectedLeftMenu" href="'.$url.$this->nextMonthUrl($this->year,$this->month).'">'.'>'.'</a></td>';
	echo '<td><a class="SelectedLeftMenu" href="'.$url.$this->nextYearUrl($this->year,$this->month).'">'.'>>'.'</a></td>';        
        echo '</tr>';
    }
    
    private function preYearUrl($year,$month)
    {
        $year = ($this->year <= 2000) ? 2000 : $year - 1 ;
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function nextYearUrl($year,$month)
    {
        $year = ($year >= 2038)? 2038 : $year + 1;
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function preMonthUrl($year,$month)
    {
        if ($month == 1) {
            $month = 12;
            $year = ($year <= 2000) ? 2000 : $year - 1 ;
        } else {
            $month--;
        }        
        
        return 'year='.$year.'&month='.$month;
    }
    
    private function nextMonthUrl($year,$month)
    {
        if ($month == 12) {
            $month = 1;
            $year = ($year >= 2038) ? 2038 : $year + 1;
        }else{
            $month++;
        }
        return 'year='.$year.'&month='.$month;
    }
    
}