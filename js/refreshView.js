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
}