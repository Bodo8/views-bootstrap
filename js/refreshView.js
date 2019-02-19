function refreshPagination() {
    document.getElementById("firstMonth").innerHTML = prevMonthPag(dateTab["actualMonth"]);
    document.getElementById("activeMonth").innerHTML = monthsName[dateTab["actualMonth"]];
    document.getElementById("nextMonth").innerHTML = nextMonthPag(dateTab["actualMonth"]);

}

function refreshYearButton() {
    document.getElementById("yearButton").innerHTML = dateTab["actualYear"];
    document.getElementById("nextYearButt").innerHTML = addOneYear(dateTab["actualYear"], 1);
    document.getElementById("afterNextYearButt").innerHTML = addOneYear(dateTab["actualYear"], 2);

}

function refreshMonthTable() {
    document.getElementById("but1").innerHTML = tabWithNumberDays[1];
    document.getElementById("but2").innerHTML = tabWithNumberDays[2];
    document.getElementById("but3").innerHTML = tabWithNumberDays[3];
    document.getElementById("but4").innerHTML = tabWithNumberDays[4];
    document.getElementById("but5").innerHTML = tabWithNumberDays[5];
    document.getElementById("but6").innerHTML = tabWithNumberDays[6];
    document.getElementById("but7").innerHTML = tabWithNumberDays[7];
    document.getElementById("but8").innerHTML = tabWithNumberDays[8];
    document.getElementById("but9").innerHTML = tabWithNumberDays[9];
    document.getElementById("but10").innerHTML = tabWithNumberDays[10];
    document.getElementById("but11").innerHTML = tabWithNumberDays[11];
    document.getElementById("but12").innerHTML = tabWithNumberDays[12];
    document.getElementById("but13").innerHTML = tabWithNumberDays[13];
    document.getElementById("but14").innerHTML = tabWithNumberDays[14];
    document.getElementById("but15").innerHTML = tabWithNumberDays[15];
    document.getElementById("but16").innerHTML = tabWithNumberDays[16];
    document.getElementById("but17").innerHTML = tabWithNumberDays[17];
    document.getElementById("but18").innerHTML = tabWithNumberDays[18];
    document.getElementById("but19").innerHTML = tabWithNumberDays[19];
    document.getElementById("but20").innerHTML = tabWithNumberDays[20];
    document.getElementById("but21").innerHTML = tabWithNumberDays[21];
    document.getElementById("but22").innerHTML = tabWithNumberDays[22];
    document.getElementById("but23").innerHTML = tabWithNumberDays[23];
    document.getElementById("but24").innerHTML = tabWithNumberDays[24];
    document.getElementById("but25").innerHTML = tabWithNumberDays[25];
    document.getElementById("but26").innerHTML = tabWithNumberDays[26];
    document.getElementById("but27").innerHTML = tabWithNumberDays[27];
    document.getElementById("but28").innerHTML = tabWithNumberDays[28];
    document.getElementById("but29").innerHTML = tabWithNumberDays[29];
    document.getElementById("but30").innerHTML = tabWithNumberDays[30];
    document.getElementById("but31").innerHTML = tabWithNumberDays[31];
    document.getElementById("but32").innerHTML = tabWithNumberDays[32];
    document.getElementById("but33").innerHTML = tabWithNumberDays[33];
    document.getElementById("but34").innerHTML = tabWithNumberDays[34];
    document.getElementById("but35").innerHTML = tabWithNumberDays[35];
    document.getElementById("but36").innerHTML = tabWithNumberDays[36];
    document.getElementById("but37").innerHTML = tabWithNumberDays[37];
    document.getElementById("but38").innerHTML = tabWithNumberDays[38];
    document.getElementById("but39").innerHTML = tabWithNumberDays[39];
    document.getElementById("but40").innerHTML = tabWithNumberDays[40];
    document.getElementById("but41").innerHTML = tabWithNumberDays[41];
    document.getElementById("but42").innerHTML = tabWithNumberDays[42];
}