let countdownInterval;

function startCountdown(duration, display) {
    let timer = duration, minutes, seconds;
    countdownInterval = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(countdownInterval);
            display.textContent = "00:00";
            document.getElementById("submit-btn").style.display = 'none'; // Hide the submit button when countdown ends
            document.getElementById("reset-btn").style.display = 'inline-block'; // Show the reset button when countdown ends
        }
    }, 1000);
}

document.getElementById('start-btn').onclick = function () {
    let oneMinute = 60,
        display = document.getElementById('countdown');
    startCountdown(oneMinute, display);
    this.style.display = 'none'; // Hide the start button
    document.getElementById("reset-btn").style.display = 'none'; // Hide the reset button
    document.getElementById("submit-btn").style.display = 'inline-block'; // Show the submit button
};

document.getElementById('reset-btn').onclick = function () {
    clearInterval(countdownInterval);
    document.getElementById('countdown').textContent = "1:00";
    document.getElementById("start-btn").style.display = 'inline-block'; // Show the start button
    document.getElementById("submit-btn").style.display = 'inline-block'; // Show the submit button
    this.style.display = 'none'; // Hide the reset button
};