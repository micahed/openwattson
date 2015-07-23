<html>
<head><title>Alan's Solar and power usage</title>
<link href="alan.css" rel="stylesheet" type="text/css" />
</head>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<body>
<h1>Alan's Solar generation and Power usage</h1>
<p>Power summaries are available for the following :</p>
<div class="container">
    <div class="header"><span>This month</span>

    </div>
    <div class="content open">
        <ul>
<?php
date_default_timezone_set ("Europe/London");
$stamp=date_create();
$month=date_format($stamp, 'm');
$year=date_format($stamp, 'Y');
$lastmonth=$month-2;  // Looking for not last month
if ($lastmonth==0) {$lastmonth=12;};
if ($lastmonth==-1) {$lastmonth=11;};
$currentmonth=3;
$currentYear=1;
$filesdone=0;

array_multisort(array_map('filemtime', ($files = glob("*.html"))), SORT_DESC, $files);
foreach($files as $entry)
{
                   $date=substr($entry, 6, 10);
		   $fmtDate=substr($date,0,4)."/".substr($date, 5,2)."/".substr($date,-2);
		   $filemonth=substr($date, 5,2);
		   $fileyear=substr($date,0,4);
		   $day=substr($entry, 17, -5);
		   //echo "<a href='$entry'>$day - $date</a><br>\n";
		   if (($currentYear==1) && ($currentmonth<=2) && ($fileyear != $year)) {
			   $currentmonth=0;
			   $currentYear=0;
			echo "</ul></div>\n";
			echo "<div class='header'><span>Last Year</span></div>\n";
			echo "<div class='content'><ul>\n";
		   }
		   if (($currentmonth === 2) && ($filemonth == $lastmonth)) {
			$currentmonth=1; // No longer last month
			echo "</ul></div>\n";
			echo "<div class='header'><span>This Year</span></div>\n";
			echo "<div class='content'><ul>\n";
		   }
		   if (($currentmonth === 3) && ($filemonth != $month)) {
			$currentmonth=2; // No longer this month
			if ($filesdone === 0) {
				echo "{No completed files so far this month}";
			}
			echo "</ul></div>\n";
			echo "<div class='header'><span>Last Month</span></div>\n";
			echo "<div class='content'><ul>\n";
		   }
                   echo "<li><a href='$entry'>$day - $fmtDate</a></li>\n";
		   $filesdone+=1;
}
echo "</ul></div>";
$adate=date_create('2015/03/20');
$Tstamp=date_format($adate, 'Y-m-d');
//$Tstamp=$adate->getTimestamp();
echo "<p>TT: $Tstamp</p>";
$nowtime=date_format($stamp, "H:i d-m-Y");
echo "<p>Time now is : $nowtime</p>";
echo "<p>month: $month and last filemonth: $filemonth</p>";
//phpinfo();
?>
<script>
$(".header").click(function () {

    $header = $(this);
    //getting the next element
    $content = $header.next();
    //open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
    //$content.slideToggle(500);
    $('.content').each(function(i,obj) {
       if (!$(obj).is($content) && $(obj).parent().is($content.parent())) {
            $(obj).slideUp();
       };
    });
    //$content.slideDown();
    $content.slideToggle(500);
});
</script>
</body>
</html>
