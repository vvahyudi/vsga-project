document
	.getElementById("login-form")
	.addEventListener("submit", function (event) {
		event.preventDefault() // Prevent form submission

		// Get the username and password values
		const username = document.getElementById("username").value
		const password = document.getElementById("password").value

		// Get the error message element
		const errorMessage = document.getElementById("error-message")

		// Perform login validation here
		// For simplicity, let's assume the username is "admin" and the password is "password"
		if (username === "admin" && password === "password") {
			alert("Login successful!")
			// Clear the error message if the login is successful
			setTimeout(function () {
				window.location.href = "home.html"
			}, 1000)
		} else {
			// Display an error message if the login is invalid
			errorMessage.style.display = "block"
			errorMessage.textContent = "Invalid username or password."
		}
	})
