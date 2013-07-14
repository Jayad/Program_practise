<?php

class_exists( 'adHocPage' ) || require('/home/y/share/pear/Yahoo/urap/adHocPage.php') ;
class_exists( 'PlatformUtils' ) || require('/home/y/share/pear/Yahoo/Utils/platformUtils.inc');
class_exists( 'UrlUtil' ) || require('/home/y/share/pear/Yahoo/Utils/url.inc');
class_exists( 'YMemAccntInfo' ) || require('/home/y/share/pear/Yahoo/member_accntinfo/member_accntinfo_util.php');

class AEAInfoTrapPage extends adHocPage {

    <?include common/yala.getCurrSpaceId.function.php /?>

	function renderContent() {
                $edit_server = getenv('regLogin_conf_data__edit_server');
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
		$canViewEmail = $this->_data['UI']['CAN_ADD_COMMCHANNELS'];

        	$emailDefaultVal = ($this->_data['commChannels'] && array_key_exists('EMAIL', $this->_data['commChannels'])) ? $this->_data['commChannels']['EMAIL'] : '';

		$mobileError = false;
		$genericError = false;
		$mobileErrStr = '';
		$genericErrStr = "<!!>CCM.GENERIC.ERROR</!!>";

		$errorCode = false;

		//to keep track of unique error codes since back-end returns multiple error codes for pwqa error
		//error codes like 0xxx are for questions & 1xxx are for answers
		//to stack up the error strings & show them as a bulleted list
	        //csp_log_debug(__method__, 'error list', $this->_data['ErrorList']);	
		if (isset($this->_data['ErrorList']) && !empty($this->_data['ErrorList'])) {
		  foreach($this->_data['ErrorList'] as $errorData){
		      $errorCode = $errorData['ErrorCode'];
		      switch ($errorCode) {
			    case 604:   /* Invalid Email addres */
    			  $mobileError = true;
    			  $mobileErrStr = (array_key_exists('ErrorArgs', $errorData) && $errorData['ErrorArgs']['em-code'] == 'E4') ? "<!!>STR.ARINFO.EMAIL_ERROR2</!!>" : "<!!>STR.ARINFO.EMAIL_ERROR1</!!>";
    			  break;

    		        case 75028: /* Alternate Email cannot be same as Account ID */
    		        case 75029: /* Alternate Email cannot be a Yahoo ID */
    			  $mobileError = true;
    			  $mobileErrStr = "<!!>STR.ARINFO.EMAIL_ERROR2</!!>";
    			  break;

    			case 77319: /* No more space */
    			  if ($this->_data['ErrorList'][1]['ErrorCode'] == 90001) {
                                $mobileError = true;
                                $mobileErrStr = "<!!>STR.ARINFO.MOBILE_EXCEEDED_ERR</!!>";
    			  } else if ($this->_data['ErrorList'][1]['ErrorCode'] == 90000) {
                                $mobileError = true;
                                $mobileErrStr = "<!!>CCM.MAXADDED.ERROR</!!>";
    			  } else {
                                $genericError = true;
    			  }
    			  break;

    			case 90000:
    			case 90001:
    				//These are only relevant if they are sub-error codes of 77319.
    				//On their own, we ignore them.
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
		
		$suppreg_status = $this->_data['sr_type'];
		switch($suppreg_status) {
			case 6: //MISSING STATUS
				$pageName = 'suppreg_aea_missing';
				break;
			default: 
				$pageName = 'suppreg_aea_review';
				break;
		}

	    	$space_id = $this->getCurrSpaceId($pageName);

	    	$showOptionalTxt = (getenv("ARDataUpdate_presentation__show_optional_text") == '1') ? true : false;
	
        include("/home/y/share/pear/Yahoo/member_headerfooter/accntinfo/controller.inc");
	$intlLang = array('intl'=> $this->intl, 'locale'=> $this->_data['lang']);
        $obj = new HeaderFooter($space_id, $intlLang, '', $this->partner, array('HEAD', 'FOOT', 'FOOT9'));
        $ucs = $obj->getHeader20(array('return_client'=>true));
        $ft = $obj->getFooter();   // from member_headerfooter package

	//Not required anymore      
        //$commChanMgmtUrl = 'https://'. $edit_server .'/commchannel/manage';
        //addArgsToUrl($commChanMgmtUrl, array('scrumb'=>$this->scrumb, 'done'=>$this->done));
	$useLocal = yahoo_get_data(YIV_REQUEST, 'local', YIV_FILTER_NUMBER)==='1' && ynet_db_is_yahoo_internal_addr(yapache_get_remote_ip());
        $arinfoAssetVer = getenv('ARDataUpdate_presentation__mobile_assets_version');
        $langDir = YMemAccntInfo::getDisplayDir($this->_data['lang']);
?>
<!DOCTYPE html>
<html dir="<?php echo $langDir;?>" class="<?php echo $langDir;?>">
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
<body class="yui3-skin-sam">
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
            		<!--<p class="callout-heading"><!!>STR.ARMOBILE.CALLOUT.HEADING</!!></p>
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

		<h1><!!>STR.ARMOBILE.NOMOBILE.ACCESS</!!></h1>
			<!-- description : start -->
			<div class="row description">
                       		<!-- info bubble : start -->
				<div class="bubble">
	    				<p class="bubble-body"><!!>STR.ARMOBILE.FORGOT.AEA</!!></p>
					<p class="bubble-body bubble-italic-text"><strong><!!>STR.ARMOBILE.ITS.FAST</!!></strong>&nbsp;<!!>STR.ARAEA.ENTER.AEA</!!></p>
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
                                        <p class="content-help-heading"><!!> STR.ARAEA.HELP.QUESTION1</!!></p>
                                        <p class="content-help-text"><!!> STR.ARAEA.HELP.ANSWER1 </!!></p>

					<p class="content-help-heading"> <!!>STR.ARAEA.HELP.QUESTION2</!!></p>
                                        <p class="content-help-text"><!!>STR.ARAEA.HELP.ANSWER2</!!></p>
                                </div>
                       <!-- content help : end -->
                        </div>
<!-- help : end -->
                </div>
                 <!-- description : end -->

	<form id="supRegForm" name="supRegForm" action="/recovery/update" method="POST" autocomplete="off">
		<!-- input : start -->
                <div class="row input">
			<input type="text" name="em" class="aea" tabindex="2" value="<?php echo $emailDefaultVal; ?>"  size="30" placeholder="<!! esc='dquote'>STR.ARINFO.AEA.EMAIL.GHOST</!!>"/>
		
		<div class="more-info">
                                <span class="private" id="private-text"><!!>STR.ARMOBILE.PRIVATE</!!></span>
		<p class="assurance" id="assurance-text"><!!>STR.ARAEA.KEEP.SECURE</!!></p>
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
	        empty:		"<!! esc='dquote'>STR.ARINFO.AEA.EMAIL.TIP</!!>"
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

<!!>STR.ARINFO.AEA.HEADING</!!>
<!!>STR.ARINFO.AEA.INTROPARA</!!>
<!!>STR.ARINFO.AEA.ENSURE</!!>
<!!>STR.ARINFO.AEA.REMINDLATER</!!>
<!!>STR.ARINFO.AEA.EMAIL.LABEL</!!>
<!!>STR.ARINFO.AEA.EMAIL.GHOST</!!>
<!!>STR.ARINFO.AEA.EMAIL.TIP</!!>
<!!>STR.ARINFO.AEA.EMAIL.ERROR</!!>
<!!>STR.ARINFO.AEA.HOWTIP</!!>
<!!>STR.ARINFO.AEA.REVIEW</!!>
<!!>STR.ARINFO.AEA.BUTTON</!!>
<!!>STR.ARMOBILE.FORGOT.AEA</!!>
<!!>STR.ARAEA.ENTER.AEA</!!>
<!!>STR.ARAEA.HELP.QUESTION1</!!>
<!!>STR.ARAEA.HELP.ANSWER1</!!>
<!!>STR.ARAEA.HELP.QUESTION2</!!>
<!!>STR.ARAEA.HELP.ANSWER2</!!>
<!!>STR.ARAEA.KEEP.SECURE</!!>
*/ }
} ?>

