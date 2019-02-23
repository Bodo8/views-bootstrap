let todayDate = new Date();
let rightNumberOfMonth = (todayDate.getMonth() + 1);
let monthsName = ["zero", "January", "February", "March",
    "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let tabWithNumberDays = [];
tabWithNumberDays[0] = 0;
let tabWithNumberDaysStars = [];

let currentDate = {
    yearCurrent: todayDate.getFullYear(),
    monthCurrent: rightNumberOfMonth,
    weekCurrent: getWeekNumber(todayDate),
    dayCurrent: todayDate.getDate(),
    numberDayWeek: todayDate.getDay(),
};

let dateTab = [];
dateTab["actualYear"] = currentDate.yearCurrent;
dateTab["actualMonth"] = currentDate.monthCurrent;
dateTab["actualWeek"] = currentDate.weekCurrent;
dateTab["actualDay"] = currentDate.dayCurrent;
dateTab["actualNumberDayWeek]"] = currentDate.numberDayWeek;

function getDateTab() {
    let actualDate = dateTab;
    return actualDate;
}

function getLastDayMonth() {
    let month = dateTab["actualMonth"];

    switch (month) {
        case 1:
            return 31;
        case 2:
            return 28;
        case 3:
            return 31;
        case 4:
            return 30;
        case 5:
            return 31;
        case 6:
            return 30;
        case 7:
            return 31;
        case 8:
            return 31;
        case 9:
            return 30;
        case 10:
            return 31;
        case 11:
            return 30;
        case 12:
            return 31;
    }
}

/**
 * generate tab with number of days actual view month, tab has 42 items.
 * @param refresh - when the month changes in "pagination" views.
 */
function generateNumberDays(refresh) {

    let numberFirstDay = getFirstDayMonth();
    let lastDayMonth = getLastDayMonth();
    let week = 0;
    let stringDayMonth = 1;
    let numberDayMonth = 1;
    let begin = 1;
    let endWeek = 8;
    let line = 7;
    let counter = 0;
    let endMonth = 0;

    if (refresh != null) {
        refresh = "refresh";
    }

    for (let m = 0; m < line; m++) {

        if (m > 0) {
            week += 7;
        }
        if (isSunday(numberFirstDay)) {
            numberFirstDay = 7;
        }

        for (let k = begin + week; k < (endWeek + week); k++) {
            stringDayMonth = k;
            numberDayMonth = k;

            if (k < numberFirstDay) {
                stringDayMonth = 0;
                tabWithNumberDays[k] = stringDayMonth;
                counter++;
            }
            endMonth = k - counter;
            if (endMonth > lastDayMonth) {
                stringDayMonth = 0;
                tabWithNumberDays[k] = stringDayMonth;

            }
            if (stringDayMonth > 0) {
                numberDayMonth -= counter;

                if (refresh === "refresh") {
                    tabWithNumberDays[k] = numberDayMonth;

                    if (lastDayMonth === 30) {
                        tabWithNumberDays.splice(k + 1, 1, 0);
                    }

                } else {
                    tabWithNumberDays[k] = numberDayMonth;
                }
            }
        }
    }
}
generateNumberDays();

function generateTabWithNumberDaysStars() {
    for (let i = 0; i < tabWithNumberDays.length; i++) {
        let day = tabWithNumberDays[i];
        if (day < 1) {
            day = "*";
        }
        tabWithNumberDaysStars[i] = day;
    }
}
generateTabWithNumberDaysStars();

function createListGroup() {
    let divRow = document.getElementById('rowList');
    let ul = document.createElement('ul');
    ul.className = 'list-group';
    ul.id = 'listTasks';
    let li = document.createElement('li');
    li.className = 'list-group-item list-group-item-action list-group-item-success';
    divRow.appendChild(ul);
    document.body.appendChild(ul);
}
createListGroup();

function setActiveCurrentButton() {
    let header = document.getElementById("daysMonthButton");
    let buttons = header.getElementsByClassName("btn");
    let currentDay = dateTab["actualDay"];
    let numberDayTab = getTabWithNumberDays();
    for (let i = 1; i < buttons.length; i++) {
        let numberDay = numberDayTab[i];
        if (currentDay === numberDay) {
            buttons[i - 1].className = buttons[i - 1].className.fixed();
        }
    }
}
setActiveCurrentButton();

function isSunday(numberWeekDay) {
    if (numberWeekDay === 0) {
        return true;
    } else {
        return false;
    }
}

function addOneYear(previousYear, numberYear) {
    return previousYear + numberYear;
}

function prevMonthPag(actualMonth) {
    if (actualMonth === 1) {
        return monthsName[12]
    } else {
        return monthsName[actualMonth - 1];
    }
}

function nextMonthPag(actualMonth) {
    if (actualMonth === 12) {
        return monthsName[1]
    } else {
        return monthsName[actualMonth + 1];
    }
}

function nextCurrentMonth() {
    let actualMonth = dateTab["actualMonth"];
    let actualYear = dateTab["actualYear"];
    if (actualMonth > 11) {
        actualMonth = 0;
        actualYear += 1;
    }
    actualMonth += 1;
    dateTab["actualYear"] = actualYear;
    dateTab["actualMonth"] = actualMonth;
    refreshPagination();
    refreshYearButton();
    generateNumberDays("refresh");
    generateTabWithNumberDaysStars();
    refreshMonthTable();
    removeOldListTask();
}

function prevCurrentMonth() {
    let actualMonth = dateTab["actualMonth"];
    let actualYear = dateTab["actualYear"];
    if (actualMonth < 2) {
        actualMonth = 13;
        actualYear -= 1;
    }
    actualMonth -= 1;
    dateTab["actualMonth"] = actualMonth;
    dateTab["actualYear"] = actualYear;
    refreshPagination();
    refreshYearButton();
    generateNumberDays("refresh");
    generateTabWithNumberDaysStars();
    refreshMonthTable();
    removeOldListTask();
}

function setCurrentYear(numberYear) {
    let actualYear = dateTab["actualYear"];
    dateTab["actualYear"] = actualYear + numberYear;
    refreshYearButton();
    generateNumberDays("refresh");
    refreshMonthTable();
    removeOldListTask();
}

function getActiveDate(dayActive) {
        let year = dateTab["actualYear"];
        let month = dateTab["actualMonth"];
        return new Date(year, (month - 1), dayActive);
}

function getFirstDayMonth() {
    let year = dateTab["actualYear"];
    let month = dateTab["actualMonth"];
    let tempDate = new Date(year, (month - 1), 1);
    let number = tempDate.getDay();
    return number;
}

function getTabWithNumberDays() {
    return tabWithNumberDays;
}

function setActualDayButton(numberDay) {
    let day = tabWithNumberDays[numberDay];
    if (day > 0) {
    dateTab["actualDay"] = day;
    let actualDate = getActiveDate(day);
    dateTab["actualWeek"] = getWeekNumber(actualDate);
        removeOldListTask();
        getTaskFromDatabase(dateTab);
    }else {
        removeOldListTask();
    }
}

function removeOldListTask() {
    let list = document.getElementById('listTasks');
    while (list.hasChildNodes()) {
            list.removeChild(list.firstChild);
    }
}

function addElementToList(lineFromDB) {
    let input = document.getElementById("textToList");
    let textTask = input.value;
    dateTab["descriptionTask"] = textTask;
    dateTab["rangeTask"] = 0;
    let ul = document.getElementById('listTasks');

    if (lineFromDB === "new") {
        if (textTask.length > 0) {
            let liNew = document.createElement("li");
            liNew.className = "list-group-item list-group-item-action list-group-item-success";
            liNew.textContent = textTask;
            let actualDate = getCopyDateTab();
            saveTaskToDatabase(actualDate);
            removeOldListTask();
            ul.appendChild(liNew);
        }
    } else if (lineFromDB.length > 0) {

        for (let i = 0; i < lineFromDB.length; i++) {
            let li = document.createElement("li");
            li.className = "list-group-item list-group-item-action list-group-item-success";
            li.textContent = lineFromDB[i];
            ul.appendChild(li);
        }
    } else {
        let li3 = document.createElement("li");
        li3.className = "list-group-item list-group-item-action list-group-item-success";
        ul.appendChild(li3);
    }
}

function getCopyDateTab() {
    let actualDateTabCopy = [];
    for (let key in dateTab) {
        if (dateTab.hasOwnProperty(key)) {
            if (key === "actualNumberDayWeek") {

        } else {
                actualDateTabCopy[key] = dateTab[key];
            }
        }
    }
    return actualDateTabCopy;
}

function getWeekNumber(date) {
    date = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
    date.setUTCDate(date.getUTCDate() + 4 - (date.getUTCDay() || 7));
    let yearStart = new Date(Date.UTC(date.getUTCFullYear(), 0, 1));
    let weekNumber = Math.ceil((((date - yearStart) / 86400000) + 1) / 7);
    return weekNumber;
}

document.getElementById("yearButton").innerHTML = dateTab["actualYear"];
document.getElementById("nextYearButt").innerHTML = addOneYear(dateTab["actualYear"], 1);
document.getElementById("afterNextYearButt").innerHTML = addOneYear(dateTab["actualYear"], 2);

document.getElementById("firstMonth").innerHTML = prevMonthPag(dateTab["actualMonth"]);
document.getElementById("activeMonth").innerHTML = monthsName[dateTab["actualMonth"]];
document.getElementById("nextMonth").innerHTML = nextMonthPag(dateTab["actualMonth"]);

document.getElementById("but1").innerHTML = tabWithNumberDaysStars[1];
document.getElementById("but2").innerHTML = tabWithNumberDaysStars[2];
document.getElementById("but3").innerHTML = tabWithNumberDaysStars[3];
document.getElementById("but4").innerHTML = tabWithNumberDaysStars[4];
document.getElementById("but5").innerHTML = tabWithNumberDaysStars[5];
document.getElementById("but6").innerHTML = tabWithNumberDaysStars[6];
document.getElementById("but7").innerHTML = tabWithNumberDaysStars[7];
document.getElementById("but8").innerHTML = tabWithNumberDaysStars[8];
document.getElementById("but9").innerHTML = tabWithNumberDaysStars[9];
document.getElementById("but10").innerHTML = tabWithNumberDaysStars[10];
document.getElementById("but11").innerHTML = tabWithNumberDaysStars[11];
document.getElementById("but12").innerHTML = tabWithNumberDaysStars[12];
document.getElementById("but13").innerHTML = tabWithNumberDaysStars[13];
document.getElementById("but14").innerHTML = tabWithNumberDaysStars[14];
document.getElementById("but15").innerHTML = tabWithNumberDaysStars[15];
document.getElementById("but16").innerHTML = tabWithNumberDaysStars[16];
document.getElementById("but17").innerHTML = tabWithNumberDaysStars[17];
document.getElementById("but18").innerHTML = tabWithNumberDaysStars[18];
document.getElementById("but19").innerHTML = tabWithNumberDaysStars[19];
document.getElementById("but20").innerHTML = tabWithNumberDaysStars[20];
document.getElementById("but21").innerHTML = tabWithNumberDaysStars[21];
document.getElementById("but22").innerHTML = tabWithNumberDaysStars[22];
document.getElementById("but23").innerHTML = tabWithNumberDaysStars[23];
document.getElementById("but24").innerHTML = tabWithNumberDaysStars[24];
document.getElementById("but25").innerHTML = tabWithNumberDaysStars[25];
document.getElementById("but26").innerHTML = tabWithNumberDaysStars[26];
document.getElementById("but27").innerHTML = tabWithNumberDaysStars[27];
document.getElementById("but28").innerHTML = tabWithNumberDaysStars[28];
document.getElementById("but29").innerHTML = tabWithNumberDaysStars[29];
document.getElementById("but30").innerHTML = tabWithNumberDaysStars[30];
document.getElementById("but31").innerHTML = tabWithNumberDaysStars[31];
document.getElementById("but32").innerHTML = tabWithNumberDaysStars[32];
document.getElementById("but33").innerHTML = tabWithNumberDaysStars[33];
document.getElementById("but34").innerHTML = tabWithNumberDaysStars[34];
document.getElementById("but35").innerHTML = tabWithNumberDaysStars[35];
document.getElementById("but36").innerHTML = tabWithNumberDaysStars[36];
document.getElementById("but37").innerHTML = tabWithNumberDaysStars[37];
document.getElementById("but38").innerHTML = tabWithNumberDaysStars[38];
document.getElementById("but39").innerHTML = tabWithNumberDaysStars[39];
document.getElementById("but40").innerHTML = tabWithNumberDaysStars[40];
document.getElementById("but41").innerHTML = tabWithNumberDaysStars[41];
document.getElementById("but42").innerHTML = tabWithNumberDaysStars[42];

