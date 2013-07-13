<?php
$mobile="408349-5628";
          $r = $mobile;
          if(strlen($mobile) > 4) {
		  $lastdigit =  substr($mobile, -5) ;
 #		if (preg_match('/\s/',$lastdigit)) {echo "yes"; $star="****";}
	#	  $lastdigit = preg_replace('/\s+/',' ',$lastdigit);
#		$lastdigit=trim($lastdigit); 
			 echo $lastdigit;
			echo "\n";
                 $r = substr($mobile, 0, strlen($mobile) - 5);
                 $r = $r . "*" . " " .$star;

          echo $r;
  }
?>
