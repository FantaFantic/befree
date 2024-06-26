const triggerPopupLimit = appLocalizer.triggerPopupLimit ?? 5
const triggerPopupMinutesSession = appLocalizer.triggerPopupMinutesSession ?? 60

function displayPopup() {
    console.log("DISPLAYING POPUP");

    if (appLocalizer.triggerPopupId && typeof elementorProFrontend !== 'undefined') {
        if (typeof elementorProFrontend !== 'undefined' && typeof elementorProFrontend.modules.popup !== 'undefined') {
            try {
                elementorProFrontend.modules.popup.showPopup({ id: appLocalizer.triggerPopupId });
                return; // Exit function after successfully displaying popup
            } catch (exception) {
                console.log("Error displaying popup:", exception);
            }
        } else {
            console.log("Elementor Pro frontend or popup module not available!");
        }
    } else {
        console.log("TriggerPopupId or Elementor Pro is not available yet. Retrying...");
    }
    
    // Retry after a short delay
    setTimeout(displayPopup, 1000); // Retry after 1 second
}


function setCookie(cookieName, cookieValue, expirationDays) {
    var d = new Date();
    d.setTime(d.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
}

// Function to get the value of a cookie
function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(';');
    for (var i = 0; i < cookieArray.length; i++) {
        var cookie = cookieArray[i];
        while (cookie.charAt(0) == ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) == 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return undefined;
}

let visitsCount = getCookie("visitCount")
let lastVisitTime = getCookie("lastVisitTime");


if (visitsCount === undefined || lastVisitTime === undefined) {
    // Set the cookie to indicate that the popup has been triggered

    visitsCount = 1
    lastVisitTime = new Date().getTime()
    setCookie("visitCount", visitsCount, 90); // Expires in 90 day
    setCookie("lastVisitTime", lastVisitTime.toString(), 90); // Expires in 90 day
    if (visitsCount >= triggerPopupLimit) {
        displayPopup()
    }
}
else {

    var currentTime = new Date().getTime();

    let minutesPassedSinceLastCount = (currentTime - lastVisitTime) / 1000 / 60

    console.log(minutesPassedSinceLastCount)
    console.log(visitsCount)

    if (lastVisitTime === undefined || minutesPassedSinceLastCount > parseFloat(triggerPopupMinutesSession)) {

        // Increment visit count
        visitsCount = parseInt(visitsCount) + 1;
        // Update last visit time
        setCookie("lastVisitTime", currentTime.toString(), 90); // Expires in 90 days
        setCookie("visitCount", visitsCount, 90); // Expires in 90 days

        if (visitsCount >= triggerPopupLimit) {
            displayPopup()
        }

    }
}




