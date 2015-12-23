/* Contact Form Script */

(function() {

	"use strict";

	var contactForm = {

		initialized: false,

		initialize: function() {

			if (this.initialized) return;
			this.initialized = true;

			this.build();
			this.events();

		},

		build: function() {

			this.validations();

		},

		events: function() {



		},

		validations: function() {

			var contactform = jQuery("#contact-form"),
				url = contactform.attr("action");

			contactform.validate({
				submitHandler: function(form) {

					// Loading State
					var submitButton = jQuery(this.submitButton);
					submitButton.button("loading");

					// Ajax Submit
					jQuery.ajax({
						type: "POST",
						url: url,
						data: {
							"name": jQuery("#contact-form #name").val(),
							"email": jQuery("#contact-form #email").val(),
							"subject": jQuery("#contact-form #subject").val(),
							"message": jQuery("#contact-form #message").val()
						},
						dataType: "json",
						success: function (data) {
							if (data.response == "success") {

								jQuery("#contact-alert-success").removeClass("hidden");
								jQuery("#contact-alert-error").addClass("hidden");

								// Reset Form
								jQuery("#contact-form .form-control")
									.val("")
									.blur()
									.parent()
									.removeClass("has-success")
									.removeClass("has-error")
									.find("label.error")
									.remove();

								if((jQuery("#contact-alert-success").position().top - 80) < jQuery(window).scrollTop()){
									jQuery("html, body").animate({
										 scrollTop: jQuery("#contact-alert-success").offset().top - 80
									}, 300);
								}

							} else {

								jQuery("#contact-alert-error").removeClass("hidden");
								jQuery("#contact-alert-success").addClass("hidden");

								if((jQuery("#contact-alert-error").position().top - 80) < jQuery(window).scrollTop()){
									jQuery("html, body").animate({
										scrollTop: jQuery("#contact-alert-error").offset().top - 80
									}, 300);
								}

							}
						},
						complete: function () {
							submitButton.button("reset");
						}
					});
				},
				rules: {
					name: {
						required: true
					},
					email: {
						required: true,
						email: true
					},
					subject: {
						required: true
					},
					message: {
						required: true
					}
				},
				highlight: function (element) {
					jQuery(element)
						.parent()
						.removeClass("has-success")
						.addClass("has-error");
				},
				success: function (element) {
					jQuery(element)
						.parent()
						.removeClass("has-error")
						.addClass("has-success")
						.find("label.error")
						.remove();
				}
			});

		}

	};

	contactForm.initialize();

})();