/*(function() {
                var progress = document.getElementById('password-progress');
                var pwField = document.getElementById('new-password');        
                var lastClass = null;                var numbers = /[0-9]/
                var short_length = 3;
                var minimum_length = 8;
                var super_length = 12;

                function setClass(className) {
                        var currentClass = progress.className;
                        if (className !== currentClass) {
                                progress.className = className;
                        }
                }

                pwField.onchange = pwField.onkeypress = pwField.onkeydown = pwField.onkeyup = function(e) {
		var value = pwField.value;
                        var length = value.length;
                        var has_numbers;

                        if (length == 0) {
                                setClass('');
                                return;
                        }

                        if (length < minimum_length) {

                                if (length > short_length) {
                                        setClass('password-still-short');
                                } else {
                                        setClass('password-short');
                                }

                        } else {

                                has_numbers = numbers.test(value);

                                if (length < super_length) {

                                        if (!has_numbers) {
                                                setClass('password-weak');
                                        } else {
                                                setClass('password-strong');
                                        }

                                } else {

                                        if (has_numbers) {
                                                setClass('password-super');
                                        } else {
                                                setClass('password-strong');
                                        }

                                }

                        }

                }

        }());
(function() {

                // password toggle
                var toggle = document.getElementById('view-password-toggle');
                var pwField = document.getElementById('new-password');
                var css = toggle.className;
                var active = 'active';
                var is_active = false;

                toggle.onclick = function(e) {
                        toggle.className = css + (!is_active ? ' ' + active : '');
                        pwField.type = (!is_active ? 'text' : 'password');
                        is_active = !is_active;
                        e.preventDefault();
                        return false;
                }

        }());


*/
//Cancel button functionality

YUI().use('node', function(Y) {
		var cancelButton = function(e) {
                        var partner, src, intl, done;
                        var doneNode = Y.one("#done");
                        if (doneNode) {
                                done = encodeURIComponent(doneNode.get("value"));
                        }
                        var partnerNode = Y.one("#partner");
                        if (partnerNode) {
                                partner = partnerNode.get('value');
                        }
                        var srcNode = Y.one("#src");
                        if (srcNode) {
                                src = srcNode.get('value');
                        }
                        var intlNode = Y.one("#intl");
                        if (intlNode) {
                                intl = intlNode.get('value');
                        }
                        
                        var exitLink = "/mforgot?intl="+intl+"&src="+src+"&done="+done+"&partner="+partner+"&problem=exit&saveBtn=Next";
                        window.location.href = exitLink;
                };

                Y.on("click", cancelButton, ".btn btn-cancel");

		var submitFormForgotSelect = function() {
			var formForgotSelect	= Y.one("#forgot-select");
			formForgotSelect.submit();
			}

		var setVerifyOption = function(val) {
			var verifyOption	= Y.one("#verifyOption");
			verifyOption.set("value", val);
			}

		var optionEmailUt = function(em) {
			var emailSelected 	= em.currentTarget.one('> a #email-selected');
			var email		= Y.one("#email");
			email.set("value", emailSelected.getAttribute("value"));

			setVerifyOption("email");
			submitFormForgotSelect();
			}

		var optionNoAccess = function(em) {
			setVerifyOption("noAccess");
			submitFormForgotSelect();
		}

		var optionEmailT = function(em) {
			var emailSelected 	= em.currentTarget.one('> a #email-selected');
			setVerifyOption(emailSelected.getAttribute("value"));
			submitFormForgotSelect();
		}

		Y.all(".option-email-ut").on("click", optionEmailUt);
		Y.one(".option-noaccess").on("click", optionNoAccess);

		Y.all(".option-email-t").on("click", optionEmailT);

	});

