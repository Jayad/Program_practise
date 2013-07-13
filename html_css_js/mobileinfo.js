YUI.add('mbr-util', function(Y) {
	Y.MbrUtil = {
	    // display error message and set class to "errormessage"
	    handleError : function(myParent, myElementMsg, errorMsg) {
	            myParent.removeClass('goodinput');
	            myParent.removeClass('infomessage');
	            myParent.addClass('errormessage');
	            myElementMsg.set('innerHTML',errorMsg);
	            myElementMsg.show(true);                
	    },

	    // clear up any error message and set class to "goodinput"
	    clearError : function(myParent, myElementMsg) {
	            myParent.removeClass('infomessage');
	            myParent.removeClass('errormessage');
	            myParent.addClass('goodinput');
	            myElementMsg.set('innerHTML',"");
	            myElementMsg.show(true);
	    }
		
	};
}, '0.0.1', { 
  requires: ['node']
});

	YUI({
           debug: false,
           combine: true,
           comboBase: "https://s.yimg.com/zz/combo?",
           root: "yui:3.4.1/build/"
        }).use('node', 'mbr-util', function(Y) {

	    // Handles writing to the console
	    var writeLog = function(message) {
	            if (config.logging === "on") {
	                    Y.log(message, "info", "formHandler");
	            }
	    };

	    /*
	    Show/Hide functions
	    */

	    // Clears the divs of any error,info,good classes and messages
	    var clearMsgs = function(e,obj) {
	            var myElementMsg = Y.one(obj[1]+"ErrorMsg");
	            var myParent = Y.one(obj[1]+"Field");

	            myParent.removeClass('infomessage');
	            myParent.removeClass('errormessage');
	            myElementMsg.hide(true);
	    };


	    /*
	     Basic Form Validations
	     */

	     // This is the basic form check - it checks to see if the value is empty
	     var notEmpty = function(e,obj) {
	             var myElementMsg = Y.one(obj[1]+"ErrorMsg");
	             var myParent = Y.one(obj[1]+"Field");

	             if (Y.one(obj[0]).get('value') == "") {
	                     hasError = true;
	                     Y.MbrUtil.handleError(myParent, myElementMsg, errorCode.empty); 
	                     writeLog("Found Error, empty " + obj[0]);
	             } else {
		   	     hasError = false;
	            	     writeLog("clearing out " + myParent);
	                     Y.MbrUtil.clearError(myParent, myElementMsg);
	             }
	     };

	     // This compares a to b and ensures they match
	     var isMatch = function(e,obj, obj2) {
	             var myElementMsg = Y.one(obj[1]+"ErrorMsg");
	             var myParent = Y.one(obj[1]+"Field");
                             
	             var a = Y.one(obj[0]).get('value');
	             var b = Y.one(obj2[0]).get('value');

	             if (a != b) {
	                     hasError = true;
	                     Y.MbrUtil.handleError(myParent, myElementMsg, errorCode.pwdnotmatch); 
	                     writeLog("Found Error, match " + obj[0]);
	             } else {
		   	     hasError = false;
	            	     writeLog("clearing out " + myParent);
	                     Y.MbrUtil.clearError(myParent, myElementMsg);
	             }
	     };

	     // Shows the small tip below the password entry field
	     var showTips = function(e,obj) {
             var myElementMsg = Y.one("#MobileEntryErrorMsg");
	             var myParent = Y.one("#MobileEntryField");
                     
	             myParent.removeClass('goodinput');
	             myParent.removeClass('errormessage');
	             myParent.addClass('infomessage');
	             myElementMsg.set('innerHTML',infoMessages.fldEm);
	             myElementMsg.show(true);

	     };

	     /*
	      The function we use to handle the event and stop page submission until all is valid
	      */
	      var formHandler = function(e) {
		      notEmpty(e,validate.mobile);

	              // if there are any errors, then we need to stop form submission
	              if (hasError) {
	                      writeLog("Errors Found, Stopping Form Submit");                         
	                      e.preventDefault();
	              }
	      };


	      // Switch for validation errors
	      var hasError = false;

	      // The validation config object 
	      var validate = {
	          mobile:   ["#mobile", "#MobileEntry"]
	      };
              
              var toggleDisplay = function(e, cd,nd) {
                 e.preventDefault();
                 if(cd!==null)
                 {
                 cd.toggleView();
                 }
                 if( nd!==null )
                 {
                   nd.toggleView();
                 }
              }
//the div should contain a target attribute set to _blank

	      // Form Handling for the main form body
	      Y.on("click", formHandler, "#saveBtn");

	      // Input Handling for Password Field 1
	      Y.on("blur", clearMsgs, "#mobile", null, validate.mobile);
	      Y.on("focus", showTips, "#mobile");
	      Y.on("click", toggleDisplay, "#togglehowdiff", null,Y.one("#togglehowdiff"), Y.one("#howdiff")); 
	      Y.on("click", toggleDisplay, "#close", null, Y.one("#howdiff"),Y.one("#togglehowdiff")); 
              Y.on("click", toggleDisplay, "#lock", null, null, Y.one("#toggletext"));
              Y.on("click", toggleDisplay, "#private-text", null, null, Y.one("#assurance-text"));
    
	});

YUI().use('node', 'event', function (Y) {
          var toggleDisplay = function(selector) {
            var node = Y.one(selector);
            if (node.getStyle('display') === 'block') {
                node.setStyle('display', 'none');
            } else {
                node.setStyle('display', 'block');
            }
          };
          Y.one('#icon-help').on('click', function(e){
              toggleDisplay('#content-help')
          });
          Y.one('#icon-close').on('click', function(e){
              toggleDisplay('#content-help')
          });
        });


YUI().use('node','node-event-simulate','event', function(Y) {
		var mobilefield = Y.one(".mobile");
		var aeafield = Y.one(".aea");
		var savebutton = Y.one(".save");	
		if (mobilefield != null)
		Y.on('available',formload_validation,'.mobile');
		else
		Y.on('available',formload_validation,'.aea');
                function formload_validation() {
			if (aeafield != null){
                	if(aeafield.get('value').length == 0){	
                	savebutton.set('disabled',true);
                	savebutton.addClass('savedisable');	
               		 }
                	else{
                	savebutton.set('disabled',false);
                	savebutton.removeClass('savedisable');	
               		 }
               		 }
			else
			{
			if(mobilefield.get('value').length==0){ 
                        savebutton.set('disabled',true);
                        savebutton.addClass('savedisable');
                         }
                        else{
                        savebutton.set('disabled',false);
                        savebutton.removeClass('savedisable');
                         }
                         }
			}
		Y.one('doc').on('key', enterhandler, 'enter');
		function enterhandler(e){
               		e.preventDefault();
			if(aeafield != null){
                	if(aeafield.get('value').indexOf('@') === -1)  {
                	Y.one(".errTxt").setStyle('display','block');
                	Y.one(".errTxt").set('innerHTML',errorCode.empty);
                	aeafield.addClass('mobileerror');
                	}
                	else{
                	savebutton.simulate("click");
              		}
                	}
			else {
			if(mobilefield.get('value').length < 5)   {
                        Y.one(".errTxt").setStyle('display','block');
                        Y.one(".errTxt").set('innerHTML',errorCode.empty);
                        aeafield.addClass('mobileerror');
                        }
                        else{
                        savebutton.simulate("click");
                        }
                        }
}
		if (mobilefield != null){
			mobilefield.on("keyup", function (e){
			if(mobilefield.get('value').length < 5){    
			savebutton.set('disabled',true);
			savebutton.addClass('savedisable');
			} else {
			savebutton.set('disabled',false);
			savebutton.removeClass('savedisable');
			}
			});
		}else if(aeafield != null){
			aeafield.on("keyup", function (e){
                        if((aeafield.get('value').length === -1) || (aeafield.get('value').indexOf('@') === -1)){
                        savebutton.set('disabled',true);
                        savebutton.addClass('savedisable');
                        } else {
                        savebutton.set('disabled',false);
                        savebutton.removeClass('savedisable');
                        }
                        });}
});
	

