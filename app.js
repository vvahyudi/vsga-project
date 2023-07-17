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
		// Send an AJAX request to the server to check the credentials
		const xhr = new XMLHttpRequest()
		xhr.open("POST", "login.php", true)
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		xhr.onreadystatechange = function () {
			if (xhr.readyState === XMLHttpRequest.DONE) {
				if (xhr.status === 200) {
					const response = JSON.parse(xhr.responseText)
					if (response.success) {
						// Login successful
						alert("Login successful!")
						// Clear the error message if the login is successful
						setTimeout(function () {
							window.location.href = "dashboard.php"
						}, 1000)
					} else {
						// Login failed
						errorMessage.style.display = "block"
						errorMessage.textContent = response.message
					}
				} else {
					// Request failed
					errorMessage.style.display = "block"
					errorMessage.textContent = "An error occurred. Please try again."
				}
			}
		}
		const data =
			"username=" +
			encodeURIComponent(username) +
			"&password=" +
			encodeURIComponent(password)
		xhr.send(data)
	})
