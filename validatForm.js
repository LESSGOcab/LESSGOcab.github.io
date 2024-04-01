// Function to validate the form
function validateForm() {
    var numPassengers = document.getElementById('numPassengers').value;
    var pickupPoint = document.getElementById('pickupPoint').value;
    var destination = document.getElementById('destination').value;
    var pickupTime = document.getElementById('pickupTime').value;
    var specialRequirements = document.getElementById('specialRequirements').value;
    var additionalServices = document.getElementById('additionalServices').value;
    var promoCode = document.getElementById('promoCode').value;

    // Validate number of passengers
    if (numPassengers <= 0 || numPassengers > 7) {
        alert("Please enter a valid number of passengers (maximum 7).");
        return false;
    }

    // Validate pickup point
    if (pickupPoint.trim() === "") {
        alert("Please enter a pickup point.");
        return false;
    }

    // Validate destination
    if (destination.trim() === "") {
        alert("Please enter a destination.");
        return false;
    }

    // Validate pickup time
    if (pickupTime.trim() === "") {
        alert("Please enter a pickup time.");
        return false;
    }

    // If all validations pass, return true
    return true;
}

// Add event listener to the form submit event
document.querySelector("form").addEventListener("submit", function(event) {
    // Prevent the form from submitting if validation fails
    if (!validateForm()) {
        event.preventDefault();
    }
});
