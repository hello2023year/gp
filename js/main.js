$(function () {
	"use strict";

	// Form

	var contactForm = function () {
		if ($("#contactForm").length > 0) {
			$("#contactForm").validate({
				rules: {
					name: "required",
					email: {
						required: true,
						// email: true,
					},
					message: {
						required: true,
						minlength: 5,
					},
					hostname: {
						required: true,
					},
					username: {
						required: true,
					},
					from_email: {
						required: true,
					},
					password: {
						required: true,
					},
					port: {
						required: true,
					},
				},
				messages: {
					name: "Please enter your name",
					email: "Please enter a valid email address",
					message: "Please enter a message",
					hostname: "Please enter smtp hostname",
					username: "Please enter smtp username",
					password: "Please enter smtp password",
					port: "Please enter smtp port",
					from_email: "Please enter from_email",
				},
				/* submit via ajax */
				submitHandler: function (form) {
					var $submit = $(".submitting"),
						waitText = "Submitting...";

					$.ajax({
						type: "POST",
						url: "./send-email.php",
						data: $(form).serialize(),

						beforeSend: function () {
							$submit.css("display", "block").text(waitText);
						},
						success: function (msg) {
							$submit.css("display", "none");
							$("#result").html("");
							$("#result").html(msg);
							if (msg.includes("Message sent to:")) {
								$("#form-message-warning").hide();

								setTimeout(function () {
									$("#form-message-success").fadeIn();
								}, 1400);
							} else if (msg.includes("Mailer Error")) {
								$("#form-message-success").hide();
								$("#form-message-warning").html(
									"Something went wrong. Please try again."
								);
								$("#form-message-warning").fadeIn(1400);
							} else {
								$("#form-message-success").hide();
								$("#form-message-warning").html(
									"Something went wrong. Please try again."
								);
								$("#form-message-warning").fadeIn(1400);
							}
						},
					});
				},
			});
		}
	};
	contactForm();
});
