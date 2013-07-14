<?php

class_exists( 'adHocPage' ) || require('/home/y/share/pear/Yahoo/urap/adHocPage.php') ;
class_exists( 'PlatformUtils' ) || require('/home/y/share/pear/Yahoo/Utils/platformUtils.inc');
class_exists( 'UrlUtil' ) || require('/home/y/share/pear/Yahoo/Utils/url.inc');
class_exists( 'YMemAccntInfo' ) || require('/home/y/share/pear/Yahoo/member_accntinfo/member_accntinfo_util.php');
class_exists('MbrPageUtil') || include('/home/y/share/pear/Yahoo/Utils/MbrPageUtil.php');
class_exists('MobilePhoneCountry') || include('/home/y/share/pear/Yahoo/member_accntinfo/MobilePhoneCountry.php');

class MobileTrapPage extends adHocPage {

    <?include common/yala.getCurrSpaceId.function.php /?>

	function renderContent() {
                $edit_server = getenv('regLogin_conf_data__edit_server');
        	$arinfoAssetVer = getenv('ARDataUpdate_presentation__mobile_assets_version');
                if( ! $edit_server) {
                   $edit_server = 'edit.yahoo.com';
                }
		$this->done = $this->_data['done'];
		$this->intl = $this->_data['intl'];
		$this->partner = $this->_data['partner'];
		$this->src = $this->_data['src'];
		$this->scrumb = $this->_data['scrumb'];
		$this->crumb = $this->_data['crumb'];
		$this->sig = $this->_data['sig'];
		$this->sts = $this->_data['sts'];
		$firstName = $this->_data['firstName'];
		$showRemindMeLaterBtn = array_key_exists('CAN_DEFER_AR_TRAP', $this->_data['UI']) ? $this->_data['UI']['CAN_DEFER_AR_TRAP'] : true;
		$allowCustomQuestions = array_key_exists('ALLOW_CUSTOM_QUESTIONS', $this->_data['UI']) ? $this->_data['UI']['ALLOW_CUSTOM_QUESTIONS'] : false;

		$canViewMobile = $this->_data['UI']['CAN_ADD_COMMCHANNELS'] && $this->_data['UI']['CAN_ADD_MOBILE_COMMCHANNELS'];

                $pageData['useLocal'] = $useLocal;
                $pageData['locale'] = ylang_get_default_language($this->intl);
                $rb = new PropertyResourceBundle('mbr_accntinfo/root', $pageData['locale']);
                $mbrPageUtil = new MbrPageUtil($rb, $pageData);
		$isMobileCollectionFlow = false; //false for suppreg. true for mobile #collection flow
		$isMobileCollectionFlow = array_key_exists('chn', $this->_data) ? true : false;
		$isARMobileCollectionFlow = false;

                $aMobileEligibleCountry = array();  
		if($isMobileCollectionFlow) {
			$isARMobileCollectionFlow = ($this->_data['chn'] === 'ar') ? true : false;
		}else {
			if(strlen(AgingGlueUtils::getEligibleCountryForMobileList())>0){
				$aMobileEligibleCountry = explode(',', AgingGlueUtils::getEligibleCountryForMobileList());
				foreach($aMobileEligibleCountry as $mobile_country){
					$mobileCountryCode = mobileUtils::getCountryCode(strtoupper($mobile_country));
				}
			}
		}
                $mobile = ($this->_data['commChannels'] && array_key_exists('MOBILE', $this->_data['commChannels'])) ? $this->_data['commChannels']['MOBILE'] : '';
 
		$emailError = false;
		$mobileError = false;
		$genericError = false;
		$emailErrStr = '';
		$mobileErrStr = '';
		$genericErrStr = "<!!>CCM.GENERIC.ERROR</!!>";

		$errorCode = false;

		//to keep track of unique error codes since back-end returns multiple error codes for Mobile error
		
		if (isset($this->_data['ErrorList']) && !empty($this->_data['ErrorList'])) {
		  foreach($this->_data['ErrorList'] as $errorData){
		      $errorCode = $errorData['ErrorCode'];
		      switch ($errorCode) {
    			case 76057: /* Invalid Mobile Number */
    			case 76078: /* Mobile Number Not Approved By Yahoo! */
    			  $mobileError = true;
    			  $mobileErrStr = "<!!>STR.ARINFO.MOBILE_ERROR1</!!>";
    			  break;

    			case 75001:
    			  $mobileError = true;
    			  $mobileErrStr = "<!!>STR.ARINFO.CARRIERNOTSUPPORTED</!!>";
    			  break;

    			case 77319: /* No more space */
    			  if ($this->_data['ErrorList'][1]['ErrorCode'] == 90001) {
                                $mobileError = true;
                                $mobileErrStr = "<!!>STR.ARINFO.MOBILE_EXCEEDED_ERR</!!>";
    			  } else if ($this->_data['ErrorList'][1]['ErrorCode'] == 90000) {
                                $emailError = true;
                                $emailErrStr = "<!!>CCM.MAXADDED.ERROR</!!>";
    			  } else {
                                $genericError = true;
    			  }
    			  break;
    			case 90000:
    			case 90001:
    				//These are only relevant if they are sub-error codes of 77319.
    				//On their own, we ignore them.
    			  break;

    			case 76077: /* Mobile Numbers Exceed Limit */
    			  $mobileError = true;
    			  $mobileErrStr = "<!!>STR.ARINFO.MOBILE_EXCEEDED_ERR</!!>";
    			  break;

    			case 77309: /* Comm Channel already disavowed */
    			  if ($this->_data['ErrorList'][1]['ErrorCode'] == 90001) {
                                $mobileError = true;
                                $mobileErrStr = "<!!>STR.ARINFO.DISAVOWED_MOBILE_ERR</!!>";
    			  } else if ($this->_data['ErrorList'][1]['ErrorCode'] == 90000) {
                                $mobileError = true;
                                $mobileErrStr = "<!!>CCM.ALREADYDISAVOWED.ERR</!!>";
    			  } else {
                                $genericError = true;
    			  }
    			  break;

    			case 5100: /* Invalid Cookie */
    			case 5101: /* Expired Cookie */
    			  $genericErrStr = "<!!>CCM.EXPIRED.ERROR</!!>";
    			  $genericError = true;
    			  break;

    			default:
    			  $genericError = true;
    			  break;
    		      }
		  }
		}

        	  // Differentiatng Space IDs Bug#5875783 	
		$suppreg_status = $this->_data['sr_type'];
		if(empty($suppreg_status)) {
                	$pageName = ($this->_data['commChannels'] && array_key_exists('MOBILE', $this->_data['commChannels'])) ? 'suppreg_mobile_review' : 'suppreg_mobile_missing';

		} else {
			switch($suppreg_status) {
				case 6: //MISSING STATUS
					$pageName = 'suppreg_mobile_missing';
					break;
				default: 
					$pageName = 'suppreg_mobile_review';
					$flag =true;
					break;
			}
		}

	    	$space_id = $this->getCurrSpaceId($pageName);

	    	$showOptionalTxt = (getenv("ARDataUpdate_presentation__show_optional_text") == '1') ? true : false;
	       //Pending: Need to enable this

		// no country code is being passed to FE so default to settings based on INTL from UDB
		if(!strlen($this->_data['countrycode'])>0){
			// mobile intl support
			$mobile_var = (strlen($this->_data['ip_country'])>0) ? $this->_data['ip_country'] : $this->intl;
		}else{
			// use country code coming from BE
			$countrycode = strtolower(mobileUtils::getCountryName($this->_data['countrycode']));
			//Hack for countrycode=1 till mobileutilsconf is fixed to map "1" only to "US" or enable suppreg for all intls
			if(($this->_data['countrycode'])=="1")
                        $countrycode ="us";
			$mobile_var = $countrycode;
		}

		$mobile_max_length = 15;
		switch($mobile_var){
			case 'us':
				$mobile_selected['us'] = "selected";
				break;
			case 'in':
				$mobile_selected['in'] = "selected";
				break;
			case 'id':
				$mobile_selected['id'] = "selected";
				break;
			case 'vn':
				$mobile_selected['vn'] = "selected";
				break;
			case 'my':
				$mobile_selected['my'] = "selected";
				break;
			case 'ph':
				$mobile_selected['ph'] = "selected";
				break;
			case 'br': 
				$mobile_selected['br'] = "selected";
                                break;
                        case 'ca':
                                $mobile_selected['ca'] = "selected";
                                break;
                        case 'mx':
                                $mobile_selected['mx'] = "selected";
                                break;
                        case 'de':
                                $mobile_selected['de'] = "selected";
                                break;
			default:
				$mobile_selected['us'] = "selected";
                                break;

		}		

        include("/home/y/share/pear/Yahoo/member_headerfooter/accntinfo/controller.inc");
	$intlLang = array('intl'=> $this->intl, 'locale'=> $this->_data['lang']);
        $obj = new HeaderFooter($space_id, $intlLang, '', $this->partner, array('HEAD', 'FOOT', 'FOOT9'), '', true, false);
        $ucs = $obj->getHeader20(array('return_client'=>true));
        $ft = $obj->getFooter();   // from member_headerfooter package
      
	$useLocal = yahoo_get_data(YIV_REQUEST, 'local', YIV_FILTER_NUMBER)==='1' && ynet_db_is_yahoo_internal_addr(yapache_get_remote_ip());
        $langDir = YMemAccntInfo::getDisplayDir($this->_data['lang']);
        $lang = $this->_data['lang'];
?>
<!DOCTYPE html>
<!--[if !IE]> -->
<html lang="<?php echo $lang; ?>">
<!-- <![endif]-->

<!--[if gte IE 8]>
<html>
<![endif]-->

<!--[if IE 7]>
<html class="ie7">
<![endif]-->

<!--[if IE 6]>
<html class="ie6">
<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http_equiv="CACHE-CONTROL" content="no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
    <meta name="viewport" content="width=1024" />
    <meta name="Category" content="Support" />
    <title><!!>STR.ARINFO.SUPREG_TITLE</!!></title> 
    <link rel="stylesheet" type="text/css" media="screen" href="https://s.yimg.com/zz/combo?yui:3.4.1/build/cssreset/cssreset-min.css&yui:3.4.1/build/cssfonts/cssfonts.css&sf/chpw/1.0.2/c/main-min.css&<?php echo $ucs->getMarkup('universalheader:css');?>">
    <?php if ($useLocal): ?>
    <link rel="stylesheet" type="text/css" media="screen" href="/unittest/membership/suppreg/css/mobiletrap.css">
    <?php else: ?>
    <link rel="stylesheet" type="text/css" media="screen" href="https://s.yimg.com/sf/suppreg/<?php echo $arinfoAssetVer;?>/c/mobiletrap-min.css">
    <?php endif;?>

    <script type="text/javascript">if(top != self){top.location.href = "http://www.yahoo.com" }</script>
</head>
<body>
<!-- header-and-contents : start -->
<div class="header-and-contents">
<!-- header : start -->
                <div class="header">

        <!-- universal header : start -->
        <div>
         <?php echo $ucs->getMarkup('universalheader:markup'); ?>
        </div>
        <!-- universal header : end -->
       	<div class="callout">
  	   <!-- <p class="callout-heading"><!!>STR.ARMOBILE.CALLOUT.HEADING</!!></p>
            <p class="callout-message"><!!>STR.ARMOBILE.CALLOUT.SUBHEADING</!!></p>
     	    <p class="callout-message-more"><!!>STR.ARMOBILE.CALLOUT.BODY</!!></p>
            <div class="callout-triangle"></div>-->
       </div>
       <div class="clear"></div>
   </div>
   <!-- header : end -->

   <!-- section detail : start -->
        <?php
            if ($errorCode == 5100 || $errorCode == 5101) {
        ?>
            <p id="genericErr"><!!>CCM.EXPIRED.ERROR</!!></p>
        <?php
           } else {
// begin not expired
        ?>
  	<div class="section-detail">
	    <h1>	
	    <?php if($isARMobileCollectionFlow) : ?>
		<!!>STR.ARMOBILE.CHANNEL.AR.GREETING</!!>
		<br>
	    <?php endif; ?>   
		<!!>STR.ARMOBILE.NOMOBILE.ACCESS</!!>
	    </h1>
                   <!-- description : start -->
 
       		<div class="row description">
                       <!-- info bubble : start -->             
                	<div class="bubble">
                		<?php if ($pageName == 'suppreg_mobile_missing'): ?>
                     			<!--<h2 class="bubble-heading"><!!> STR.ARMOBILE.MISSING.SUBHEADING </!!></h2>-->
                     			<p class="bubble-body"><!!>STR.ARMOBILE.FORGOT.MOBILE</!!>
					<p class="bubble-body bubble-italic-text"><strong><!!>STR.ARMOBILE.ITS.FAST</!!></strong>&nbsp;<!!>STR.ARMOBILE.ENTER.MOBILE</!!> </p>
                		<?php else: ?>
                     			<h2 class="bubble-heading"><!!> STR.ARMOBILE.VERIFY.RECOVER </!!></h2>
                     			<p class="bubble-text"><!!> STR.ARMOBILE.FORGETTING.MOBILE </!!></p>
                     			<p class="bubble-text"><!!> STR.ARMOBILE.RECOVER.INSECONDS </!!></p>
                		<?php endif; ?>
                                        <div class="pointer-back"></div>
                                        <div class="pointer-front"></div>
                	</div>
                         <!-- info end -->

                         <!-- help : start -->
       			<div class="help">
		 		<div class="icon help" id="icon-help"></div>
                                 <!-- content help : start -->
				<div class="content help" id="content-help">
                                	<div class="icon close" id="icon-close"></div>
      				   	<p class="content-help-heading"><!!>STR.ARMOBILE.HELP.QUESTION1</!!></p>
    					<p class="content-help-text"><!!>STR.ARMOBILE.HELP.ANSWER1</!!></p>
       					
  			                <p class="content-help-heading"> <!!>STR.ARMOBILE.HELP.QUESTION2</!!></p>
      			    		<p class="content-help-text"><!!>STR.ARMOBILE.HELP.ANSWER2</!!></p>
        			</div>
                       <!-- content help : end -->
		 	</div>
                        <!-- help : end -->
		</div>
                 <!-- description : end -->
		<form id="supRegForm" class="supReg" name="supRegForm" action="<?php echo yahoo_get_data(YIV_SERVER, 'SCRIPT_NAME');?>" method="POST" autocomplete="off">
                 <!-- input : start -->
     		<div class="row input">
    		 	<label class="clipped" for="countrycode">Mobile country code</label>
      				<?php   
      	                 		$o = new MobilePhoneCountry($rb, $aMobileEligibleCountry);
                         		$countryCode = "<select name=\"countrycode\" class=\"countrycode\">";
         		 		foreach( $o->aEligibleCountries as $intl => $cname )        { 
               		 			$ccode = $o->getCountryCode($intl);
                	 			$countryCode .= "<option value=\"$ccode\"";
                	 			if(strtolower($mobile_var) == strtolower($intl)) {
                         				$countryCode .= " selected ";
                				}
                	 			$countryCode .= ">$cname (+$ccode)</option>";
              		 		} // foreach
         		 		$countryCode.= "</select>";
         		 		echo $countryCode;
      			 	?>
                                <label class="clipped" for="mobile">Mobile Number</label>       
       			 	<input type="text" name="mobile" class="mobile" maxlength="<?php echo $mobile_max_length ?>" value="<?php echo $mobile;?>" autocomplete="off" size="13">

                	<div class="more-info">
 				<span class="private" id="private-text"><!!>STR.ARMOBILE.PRIVATE</!!></span>
		<?php if ($pageName == 'suppreg_mobile_missing'): ?>
				<p class="assurance" id="assurance-text"><!!>STR.ARMOBILE.KEEP.SECURE</!!></p>
		<?php else: ?>
        			<p class="assurance" id="assurance-text"><!!>STR.ARMOBILE.MISSING.HELP</!!></p>
		<?php endif; ?>
		
       		</div>
            </div>
            <!-- input : end --> 

        	<div class="errTxt" style="<?php echo($mobileError ? 'display:block' : 'display:none'); ?>">
        		<?php echo $mobileErrStr; ?>
        	</div>

                <!-- buttons : start -->
		<div class="row button">
					<input type="submit" value="<!!>STR.ARINFO.MOBILE.REMINDLATER</!!>" name="remind" class="remind">
					<input type="submit" value="<!!>STR.ARINFO.MOBILE.BUTTON</!!>" name="save" class="save"> 
             <!-- buttons : end -->
    <input type="hidden" name="scrumb" value="<?php echo $this->scrumb; ?>">
    <input type="hidden" name="done" value="<?php echo $this->done; ?>">
    <input type="hidden" name="crumb" value="<?php echo $this->crumb; ?>">
    <input type="hidden" name="src" value="<?php echo $this->src; ?>">
    <input type="hidden" name="sig" value="<?php echo $this->sig; ?>">
    <input type="hidden" name="sts" value="<?php echo $this->sts; ?>">
    <input type="hidden" name="intl" value="<?php echo $this->intl; ?>">
    <input type="hidden" name="customq" id="customq" value="0">
    <input type="hidden" name="tn" value="<?php echo $this->_data['sr_trapname'];?>">
    <input type="hidden" name="st" value="<?php echo $this->_data['sr_type'];?>">
    <input type="hidden" name="chn" value="<?php echo $this->_data['chn'];?>">
             </form>
 		</div>
 	</div>
           <!-- section detail : end -->
      </div>
           <!--  header-and-contents: end -->
          <!-- footer : start -->
        <div class="footer">
	<?php echo $ft;?>
        </div>
                <!-- footer : end -->
        <?php
	}
        echo $obj->getAds('FOOT9'); // Roundtrip Beacon
        echo "<!-- " . $_SERVER["SERVER_NAME"] . " " . date("D M j G:i:s T Y") . " -->";
        ?>
    </div>
    <script type="text/javascript" charset="UTF-8" src="https://s.yimg.com/zz/combo?yui:3.4.1/build/yui/yui-min.js"></script>
    <script>
	var YUI_config = {
           debug: false,
           combine: true,
           comboBase: "https://s.yimg.com/zz/combo?",
           root: "yui:3.4.1/build/"
	};

	var config = {
	        tests:          "off",
	        logging:        "off"
	};

	var errorCode = {
	        empty:		"<!! esc='dquote'>STR.ARINFO.MOBILE.TIP</!!>"
	};

	var infoMessages = {
                fldEm :   "<!! esc='dquote'>STR.ARINFO.AEA.EMAIL.TIP</!!>"
	};
	// preload all yui3 modules (UH20 and Page required modules)
	YUI().use(<?php echo $ucs->getMarkup('universalheader:yuimodules');?>, function(Y) {}); 
    </script> 
    <?php if( $useLocal ): ?>
    <script type="text/javascript" charset="UTF-8" src="/unittest/membership/suppreg/js/mobileinfo.js"></script>
    <?php else: ?>
    <script type="text/javascript" charset="UTF-8" src="https://s.yimg.com/sf/suppreg/<?php echo $arinfoAssetVer;?>/j/mobileinfo-min.js"></script>
    <?php endif;?>
    <?php if( $mobileError === true ):?>
    <script>
        YUI().use('node', 'mbr-util', function(Y) {
           Y.MbrUtil.handleError(Y.one('#MobileEntryField'), Y.one('#MobileEntryErrorMsg'), '<?php echo addcslashes($mobileErrStr,"'");?>');
        });
    </script>
    <?php endif;?>
    <script type="text/javascript" charset="UTF-8" src="https://s.yimg.com/zz/combo?<?php echo $ucs->getMarkup('universalheader:javascript');?>"></script>
</body>
</html>
<?php
/*

<!!>STR.ARMOBILE.MISSING.HEADING</!!>
<!!>STR.ARMOBILE.MISSING.SUBHEADING</!!>
<!!>STR.ARMOBILE.MISSING.BODY</!!>
<!!>STR.ARMOBILE.MISSING.HELP</!!>
<!!>STR.ARMOBILE.REVIEW.HEADING</!!>
<!!>STR.ARMOBILE.REVIEW.SUBHEADING</!!>
<!!>STR.ARMOBILE.REVIEW.BODY</!!>
<!!>STR.ARMOBILE.HELP.QUESTION1</!!>
<!!>STR.ARMOBILE.HELP.ANSWER1</!!>
<!!>STR.ARMOBILE.HELP.QUESTION2</!!>
<!!>STR.ARMOBILE.HELP.ANSWER2</!!>
<!!>STR.ARMOBILE.CALLOUT.HEADING</!!>
<!!>STR.ARMOBILE.CALLOUT.SUBHEADING</!!>
<!!>STR.ARMOBILE.CALLOUT.BODY</!!>
<!!>STR.ARMOBILE.PRIVATE</!!>
<!!>STR.ARINFO.MOBILE.BUTTON</!!>
<!!>STR.ARMOBILE.FORGOT.MOBILE</!!>
<!!>STR.ARMOBILE.NOMOBILE.ACCESS</!!>
<!!>STR.ARMOBILE.ITS.FAST</!!>
<!!>STR.ARMOBILE.ENTER.MOBILE</!!>
<!!>STR.ARMOBILE.KEEP.SECURE</!!>
<!!>STR.ARMOBILE.FORGETTING.MOBILE</!!>
<!!>STR.ARMOBILE.RECOVER.INSECONDS</!!>
<!!>STR.ARMOBILE.VERIFY.RECOVER</!!>
*/ }
} ?>

