function validateForm() {
    var numPassengers = document.getElementById('numPassengers').value;
    var pickupPoint = document.getElementById('pickupPoint').value;
    var destination = document.getElementById('destination').value;
    var pickupTime = document.getElementById('pickupTime').value;
    var specialRequirements = document.getElementById('specialRequirements').value;
    var additionalServices = document.getElementById('additionalServices').value;
    var promoCode = document.getElementById('promoCode').value;

    if (numPassengers <= 0 || numPassengers > 7) {
        alert("Please enter a valid number of passengers (maximum 7).");
        return false;
    }

    if (pickupPoint.trim() === "") {
        alert("Please enter a pickup point.");
        return false;
    }

    if (destination.trim() === "") {
        alert("Please enter a destination.");
        return false;
    }

    if (pickupTime.trim() === "") {
        alert("Please enter a pickup time.");
        return false;
    }

    if (pickupPoint.trim() === destination.trim()) {
        alert("Pickup point and destination cannot be the same. Please check again.");
        return false;
    }

    return true;
}

document.querySelector("form").addEventListener("submit", function(event) {
    if (!validateForm()) {
        event.preventDefault();
    }
});
