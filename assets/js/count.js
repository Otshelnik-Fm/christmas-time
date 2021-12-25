function timeLeft(end_time) {
    let t = Date.parse(end_time) - Date.parse(new Date());
    let seconds = Math.floor((t / 1000) % 60);
    let minutes = Math.floor((t / 1000 / 60) % 60);
    let hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    let days = Math.floor(t / (1000 * 60 * 60 * 24));
    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
    };
}

jQuery(document).ready(function () {
    let today = new Date();
    let deadline = 'January 1 ' + (today.getFullYear() + 1) + " 00:00:00";
    if (today.getMonth() == 0 && today.getDate() == 1) {
        deadline = 'January 1 ' + (today.getFullYear()) + " 00:00:00";
    }

    let setClock = function (new_year) {
        let time_interval = setInterval(function () {
            let t = timeLeft(new_year);
            jQuery('#chr_days').text(t.days);
            jQuery('#chr_hours').text(t.hours);
            jQuery('#chr_mins').text(('0' + t.minutes).slice(-2));
            jQuery('#chr_secs').text(('0' + t.seconds).slice(-2));
            if (t.total <= 0) {
                clearInterval(time_interval);
                let now = new Date();
                let yearStr = now.getFullYear().toString();
                jQuery('#chr_header').text("С новым годом!!!");
                jQuery('#chr_days').text(yearStr[0]);
                jQuery('#chr_days_text').text("Пусть");
                jQuery('#chr_hours').text(yearStr[1]);
                jQuery('#chr_hours_text').text("исполняются");
                jQuery('#chr_mins').text(yearStr[2]);
                jQuery('#chr_mins_text').text("мечты");
                jQuery('#chr_secs').text(yearStr[3]);
                jQuery('#chr_secs_text').text("!!!");
                jQuery('#chr_info').text("Завтра начнется обратный отсчёт!");
            }
        }, 1000);
    };

    setClock(deadline);

});
