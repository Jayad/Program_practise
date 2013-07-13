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
        }).use('node', 'mbr-util','node-event-simulate','event',function(Y) {

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

	             var myElementMsg = Y.one("#AEAEntryErrorMsg");
	             var myParent = Y.one("#AEAEntryField");

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

		      notEmpty(e,validate.aea);

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
	          aea:   ["#em", "#AEAEntry"]
	      };

              var toggleDisplay = function(e, nd) {
                 e.preventDefault();
                 if( nd!==null )
                 {
                   nd.toggleView();
                 }
              }


	      // Form Handling for the main form body
	      Y.on("click", formHandler, "#saveBtn");

	      // Input Handling for Password Field 1
	      Y.on("blur", clearMsgs, "#em", null, validate.aea);
	      Y.on("focus", showTips, "#em");
	      Y.on("click", toggleDisplay, "#togglehowdiff", null, Y.one("#howdiff"));
	      //Making default submit as save and continue button
	      var savebutton = Y.one("#saveBtn");
              Y.one('doc').on('key', enterhandler, 'enter');
              function enterhandler(e){
                    e.preventDefault();
		    savebutton.simulate("click");
                      }
	});



