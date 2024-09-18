// Helper function to get the ordinal suffix for a date
function getOrdinalSuffix(day) {
    if (day > 3 && day < 21) return 'th'; // Covers 11th, 12th, 13th, etc.
    switch (day % 10) {
        case 1: return "st";
        case 2: return "nd";
        case 3: return "rd";
        default: return "th";
    }
}

// Helper function to get the first three letters of the day
function getDayName(date) {
    return date.toLocaleDateString('en-US', { weekday: 'short' }).substring(0, 3);
}

// Helper function to get the first three letters of the month
function getMonthName(date) {
    return date.toLocaleDateString('en-US', { month: 'short' }).substring(0, 3);
}

// Function to format the date
function formatDate(inputDate) {
    // Step 1: Parse the input date
    let date = new Date(inputDate);

    // Step 2: Format the date into the desired string format with the correct ordinal suffix
    let dayName = getDayName(date);
    let monthName = getMonthName(date);
    let day = date.getDate();
    let ordinalSuffix = getOrdinalSuffix(day);

    return `${dayName}, ${monthName} ${day}${ordinalSuffix}`;
}

function formatAMPM(inputDate) {
    let date = new Date(inputDate)
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12; // the hour '0' should be '12'
    minutes = minutes < 10 ? '0' + minutes : minutes;
    let strTime = hours + ':' + minutes + ' ' + ampm;
    return strTime;
}


export {
    formatDate,
    formatAMPM
}
