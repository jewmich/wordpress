
/* kdate.js - Kaluach Javascript Hebrew date routines
 *   Version 1.00
 * Copyright (C) 5760,5761 (2000 CE), by Abu Mami and Yisrael Hersch.
 *   All Rights Reserved.
 *   All copyright notices in this script must be left intact.
 * Based on the formula by Gauss
 * Terms of use:
 *   - Permission will be granted to use this script on personal
 *     web pages. All that's required is that you please ask.
 *     (Of course if you want to send a few dollars, that's OK too :-)
 *   - Use on commercial web sites requires a $50 payment.
 * website: http://www.kaluach.net
 * email: abumami@kaluach.net
 */

function makeArray() {
	this[0] = makeArray.arguments.length;
	for (i = 0; i < makeArray.arguments.length; i = i + 1)
		this[i+1] = makeArray.arguments[i];
}

var hebMonth = new makeArray(
	'Nisan', 'Iyyar', 'Sivan', 'Tammuz', 'Av', 'Elul',
	'Tishrei', 'Cheshvan', 'Kislev', 'Tevet', 'Shevat',
	'Adar', 'Adar I', 'Adar II');

//var hebMonthH = new makeArray(
//	'ןסינ', 'רייא', 'ןויס', 'זומת', 'בא', 'אלול',
//	'ירשת',	'חושן',	'ולסכ',	'תבט',	'טבש',
//	'רדא', 'א רדא', 'ב רדא');

if(document.charset == 'windows-1255')
	// charset=windows-1255
	var hebMonthH = new makeArray(
		'ניסן', 'אייר', 'סיון', 'תמוז', 'אב', 'אלול',
		'תשרי', 'חשון', 'כסלו', 'טבת', 'שבט',
		'אדר', 'אדר א', 'אדר ב');
else
	// charset=visual
	var hebMonthH = new makeArray(
		'ןסינ', 'רייא', 'ןויס', 'זומת', 'בא', 'אלול',
		'ירשת',	'חושן',	'ולסכ',	'תבט',	'טבש',
		'רדא', 'א רדא', 'ב רדא');
	
var civMonth = new makeArray(
	'January', 'February', 'March', 'April', 'May', 'June',
	'July', 'August', 'September', 'October', 'November', 'December');

var weekDay = new makeArray(
	'Sun', 'Mon', 'Tues', 'Wed', 'Thur', 'Fri', 'Shabbat');

function Gauss(year) {
	var a,b,c;
	var m;
	var	Mar;	// "day in March" on which Pesach falls (return value)

	a = Math.floor((12 * year + 17) % 19);
	b = Math.floor(year % 4);
	m = 32.044093161144 + 1.5542417966212 * a +  b / 4.0 - 0.0031777940220923 * year;
	if (m < 0)
		m -= 1;
	Mar = Math.floor(m);
	if (m < 0)
		m++;
	m -= Mar;

	c = Math.floor((Mar + 3 * year + 5 * b + 5) % 7);
	if(c == 0 && a > 11 && m >= 0.89772376543210 )
		Mar++;
	else if(c == 1 && a > 6 && m >= 0.63287037037037)
		Mar += 2;
	else if(c == 2 || c == 4 || c == 6)
		Mar++;

	Mar += Math.floor((year - 3760) / 100) - Math.floor((year - 3760) / 400) - 2;
	return Mar;
}

function leap(y) {
	return ((y % 400 == 0) || (y % 100 != 0 && y % 4 == 0));
}

function civMonthLength(month, year) {
	if(month == 2)
		return 28 + leap(year);
	else if(month == 4 || month == 6 || month == 9 || month == 11)
	   return 30;
	else
		return 31;
}

function civ2heb(day, month, year) {
	var d = day;
	var	m = month;
	var y = year;
	var hy;
	var pesach;
	var anchor;
	var adarType;

	m -= 2;
	if (m <= 0) { // Jan or Feb
		m += 12;
		y -= 1;
	}

	d += Math.floor(7 * m / 12 + 30 * (m - 1)); // day in March
	hy = y + 3760;	// get Hebrew year
	pesach = Gauss(hy);
	if (d <= pesach - 15) { // before 1 Nisan
		anchor = pesach;
		d += 365;
		if(leap(y))
			d++;
		y -= 1;
		hy -= 1;
		pesach = Gauss(hy);
	}
	else
		anchor = Gauss(hy + 1);

	d -= pesach - 15;
	anchor -= pesach - 12;
	y++;
	if(leap(y))
		anchor++;

	for(m = 0; m < 11; m++) {
		var days;
		if(m == 7 && anchor % 30 == 2)
			days = 30; // Cheshvan
		else if(m == 8 && anchor % 30 == 0)
			days = 29; // Kislev
		else
			days = 30 - m % 2;
		if(d <= days)
			break;
		d -= days;
	}

	adarType = 0;			// plain old Adar
	if (m == 11 && anchor >= 30) {
		if (d > 30) {
			adarType = 2;	// Adar 2
			d -= 30;
		}
		else
			adarType = 1;	// Adar 1
	}

	if(m >= 6)		// Tishrei or after?
		hy++;		// then bump up year

	if(m == 11)			// Adar?
		m += adarType;	// adjust for Adars

	return (d + ' ' + m + ' ' + hy);
}


function Easter(Y) {
	// based on the algorithm of Oudin
    var C = Math.floor(Y / 100);
    var N = Y - 19 * Math.floor(Y / 19);
    var K = Math.floor((C - 17) / 25);
    var I = C - Math.floor(C / 4) - Math.floor((C - K) / 3) + 19 * N + 15;
    I = I - 30*Math.floor((I / 30));
    I = I - Math.floor(I / 28) * (1 - Math.floor(I / 28) * Math.floor(29 / (I + 1)) * Math.floor((21 - N) / 11));
    var J = Y + Math.floor(Y / 4) + I + 2 - C + Math.floor(C / 4);
    J = J - 7 * Math.floor(J / 7);
    var L = I - J;
    var M = 3 + Math.floor((L + 40) / 44);
    var D = L + 28 - 31 * Math.floor(M / 4);

	var ret = new Object();
	ret[1] = M;
	ret[2] = D;
	return ret;
}

function DOW(day,month,year) {
	var a = Math.floor((14 - month)/12);
	var y = year - a;
	var m = month + 12*a - 2;
	var d = (day + y + Math.floor(y/4) - Math.floor(y/100) +
			Math.floor(y/400) + Math.floor((31*m)/12)) % 7;
	return d + 1;
}

function NthDOW(nth,weekday,month,year) {
	if (nth > 0)
		return (nth - 1) * 7 + 1 + (7 + weekday - DOW((nth - 1) * 7 + 1, month, year)) % 7;
	var days = civMonthLength(month, year);
	return days - (DOW(days, month, year) - weekday + 7) % 7;
}

function holidays(cday, cmonth, cyear) {
	// American civil holidays and some major religious holiday
	if (cmonth == 1 && cday == 1)
		return "New Year's Day";
	else if (cmonth == 2 && cday == 12)
		return "Lincoln's Birthday";
	else if (cmonth == 2 && cday == 14)
		return "Valentine's Day";
	else if (cmonth == 2 && cday == NthDOW(3, 2, 2, cyear))
		return "President's Day";
	else if (cmonth == 3 && cday == 17)
		return "St. Patrick's Day";
	else if (cmonth == 3 || cmonth == 4) {
		var e = Easter(cyear);
	    if (cmonth == e[1] && cday == e[2])
			return "Easter";
	}
	else if (cmonth == 5 && cday == NthDOW(2, 1, 5, cyear))
		return "Mother's Day";
	else if (cmonth == 5 && cday == NthDOW(3, 7, 5, cyear))
		return "Armed Forces Day";
	else if (cmonth == 5 && cday == NthDOW(0, 2, 5, cyear))
		return "Memorial Day";
	else if (cmonth == 6 && cday == 14)
		return "Flag Day";
	else if (cmonth == 6 && cday == NthDOW(3, 1, 6, cyear))
		return "Father's Day";
	else if (cmonth == 7 && cday == 4)
		return "Independence Day";
	else if (cmonth == 9 && cday == NthDOW(1, 2, 9, cyear))
		return "Labor Day";
	else if (cmonth == 10 && cday == NthDOW(2, 2, 10, cyear))
		return "Columbus Day";
	else if (cmonth == 10 && cday == 31)
		return "Halloween";
	else if (cmonth == 11 && cday == 11)
		return "Veterans' Day";
	else if (cmonth == 11 && cday == NthDOW(4, 5, 11, cyear))
		return "Thanksgiving";
	else if (cmonth == 12 && cday == 25)
		return "Christmas";

	return "";
}

function moadim(cday, cmonth, cyear, hday, hmonth, dow) {
	if(hmonth == 6) {
		if(hday == 1 || hday == 2)
			return "Rosh Hashana"
		else if(hday == 3 && dow != 7)
			return "Fast of Gedalia";
		else if(hday == 4 && dow == 1)
			return "Fast of Gedalia";
		else if(hday == 10)
			return "Yom Kippur"
		else if(hday >= 15 && hday <= 22)
			return "Sukkot"
		else if(hday == 23)
			return "Sukkot (d)"
	}
	else if(hmonth == 8) {
		if(hday >= 25)
			return "Chanukkah"
	}
	else if(hmonth == 9) {
		if(hday <= 2) {
			return "Chanukkah"
		}
		else if(hday == 3) {
			// Kislev can be malei or chaser
			if(cday == 1) {
				cday = 29;
				cmonth = 11;
			}
			else if(cday == 2) {
				cday = 30;
				cmonth = 11;
			}
			else
				cday -= 3;
			var hdate = civ2heb(cday, cmonth, cyear);
			hd = eval(hdate.substring(0, hdate.indexOf(' ')));
			if(hd == 29)
				return "Chanukkah"
		}
		else if(hday == 10)
			return "Fast of Tevet"
	}
	else if(hmonth == 10) {
		if(hday==15)
			return "Tu b'Shvat"
	}
	else if(hmonth == 11 || hmonth == 13) {
		if(hday == 11 && dow == 5)
			return "Taanit Esther"
		else if(hday == 13 && dow != 7)
			return "Taanit Esther"
		else if(hday == 14)
			return "Purim"
		else if(hday == 15)
			return "Shushan Purim"
	}
	else if(hmonth == 0) {

		if(hday == 12 && dow == 5)
			return "Taanit Bechorot"
		else if(hday == 14 && dow != 7)
			return "Taanit Bechorot"
		else if(hday >= 15 && hday <= 21)
			return "Pesach"
		else if(hday == 22)
			return "Pesach (d)"
	}
	else if(hmonth == 1) {
		if(hday == 3 && dow == 5)
			return "Yom Ha'Atzmaut"
		else if(hday == 4 && dow == 5)
			return "Yom Ha'Atzmaut"
		else if(hday == 5 && dow != 6 && dow != 7)
			return "Yom Ha'Atzmaut"
		if(hday == 14)
			return "Pesah sheni"
		else if(hday == 18)
			return "Lag B'Omer"
		if(hday == 28)
			return "Yom Yerushalayim"
	}
	else if(hmonth == 2) {
		if(hday == 6)
			return "Shavuot"
		else if(hday == 7)
			return "Shavuot (d)"
	}
	else if(hmonth == 3) {
		if(hday == 17 && dow != 7)
			return "Fast of Tammuz"
		if(hday == 18 && dow == 1)
			return "Fast of Tammuz"
	}
	else if(hmonth == 4) {
		if(hday == 9 && dow != 7)
			return "Tisha B'Av"
		if(hday == 10 && dow == 1)
			return "Tisha B'Av"
		if(hday == 15)
			return "Tu B'Av"
	}

	return "";
}

/*

// other global variables

var holiDate = false
var holiMsg = ""


// Calculate and display U.S. National Holidays (plus Easter)

function getHolidates(dayNumber) {

		if (month == 0) {
	
		// Show New Year's Day
		
			if (dayNumber == 1) {
			return '<font size="-3" color=' + holicolor + '>New Year\'s Day</font>'
			} 
		
		
	
		// Calculate Martin Luther King, Jr. Day
 
            var n3 = new Date("January 1, " + year)
            var n4 = 2
            var n6 = n3.getDay() + 1
            n6 = 7 - n6
            var n8 = (14 + n4) + n6 + 1
            if (n4 + n6 >= 7) {
				n8 = n8 - 7
			}
            if (n8 == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>M. L. King, Jr. Day</font>'
			} 
		}
            
        // End Martin Luther King, Jr. Day
		
		
		if (month == 1) {
	
			// Calculate President's Day
 
            var n3 = new Date("February 1, " + year)
            var n4 = 2
            var n6 = n3.getDay() + 1
            n6 = 7 - n6
            var n8 = (14 + n4) + n6 + 1
            if (n4 + n6 >= 7) {
				n8 = n8 - 7
			}
            if (n8 == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>President\'s Day</font>'
			} 
            
        	// End President's Day
		}
		



	if (month == 2 || month == 3) {

        //  Calculate Easter
		//  Thanks to Marcos Montes for posting the Carter algorithm
		//  (http://www.smart.net/~mmontes/carter.html)
 
            var b = 225 - 11 * (year % 19)
			var d = ((b-21) % 30) + 21
			if (d > 48) {
				d = d - 1
			}
			var e = Math.floor((year + (year/4) + d + 1) % 7)
			var q = d + 7 - e
			if (q > 31) {
				q = q - 31
				var m = 3
			} else {
				var m = 2
			}
			if (m == month && q == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>Easter</font>'
			}
			
        // End Easter
		}
		
		
		if (month == 4) {
		
        // Calculate Memorial Day
		
        	var mWeek = new Date("May 31, " + year)
			var lDay = mWeek.getDay()
			if (lDay == 0) {
				lDay = 6
				}else{
				lDay = lDay - 1
			}
			var mDay = 31 - lDay
			if (mDay == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>Memorial Day</font>'
			}
		}
           
        // End Memorial Day
		
		if (month == 6) {
		
			// Show Independence Day
			
			if (dayNumber == 4) {
			return '<font size="-3" color=' + holicolor + '>Independence Day</font>'
			}
		}
		
		if (month == 8) {
		
			// Calculate Labor Day
 
            var n3 = new Date("September 1, " + year)
            var n4 = 2
            var n6 = n3.getDay() + 1
            n6 = 7 - n6
            var n8 = n4 + n6 + 1
            if (n4 + n6 >= 7) {
				n8 = n8 - 7
			}
            if (n8 == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>Labor Day</font>'
			}
            
        	// End Labor Day
		}
		
		if (month == 9) {
		
			// Calculate Columbus Day
 
            var n3 = new Date("October 1, " + year)
            var n4 = 2
            var n6 = n3.getDay() + 1
            n6 = 7 - n6
            var n8 = (7 + n4) + n6 + 1
            if (n4 + n6 >= 7) {
				n8 = n8 - 7
			}
            if (n8 == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>Columbus Day</font>'
			}
            
        	// End Columbus Day
		}
		
		if (month == 10) {
		
			// Show Veteran's Day
			
			if (dayNumber == 11) {
			return '<font size="-3" color=' + holicolor + '>Veteran\'s Day</font>'
			}
			
			
		
			// Calculate Thanksgiving Day
 
            var n3 = new Date("November 1, " + year)
            var n4 = 5
            var n6 = n3.getDay() + 1
            n6 = 7 - n6
            var n8 = (21 + n4) + n6 + 1
            if (n4 + n6 >= 7) {
				n8 = n8 - 7
			}
            if (n8 == dayNumber) {
			return '<font size="-3" color=' + holicolor + '>Thanksgiving Day</font>'
			}
            
        	// End Thanksgiving Day
		}
		
		if (month == 11) {
		
			// Show Christmas Day
			
			if (dayNumber == 25) {
			return '<font size="-3" color=' + holicolor + '>Christmas Day</font>'
			}
		}
		
	return ""
}

*/

function num2heb(num)
{
	var asarat_alafim = 0;
	var alafim = 0;
	var meot = 0;
	var asiriot = 0;
	var achadim = 0;
	var flgGershayim = 0;
	var alafimStr = '';
	var num;

	var ones = new makeArray('א', 'ב', 'ג', 'ד', 'ה', 'ו', 'ז', 'ח', 'ט');
	var tens = new makeArray('י', 'כ', 'ל', 'מ', 'נ', 'ס', 'ע',	'פ', 'צ');

	if(document.charset == 'windows-1255') {
		// 1255
		var hundreds = new makeArray('ק', 'ר', 'ש',	'ת', 'קת', 'תר', 'תש', 'תת', 'תתק');	// 1255
		var tu = 'ט"ו';
		var tz = 'ט"ז';
	}
	else {
		// visual
		var hundreds = new makeArray('ק', 'ר', 'ש',	'ת', 'קת', 'רת', 'שת', 'תת', 'קתת');
		var tu = 'ו"ט';
		var tz = 'ז"ט';
	}

	var tick = "'";
	var gershayim = "\"";

	var str = "";

	if(num > 1000) {
		alafim = Math.floor(num/1000);
		num -= alafim * 1000;
	}

	if(num > 100) {
		meot = Math.floor(num/100);
		num -= meot * 100;
	}

	if(num == 15) {
		str = tu;
		achadim = 0;
		asiriot = 0;
	}
	else if(num == 16) {
		str = tz;
		achadim = 0;
		asiriot = 0;
	}
	else {
		asiriot = Math.floor(num/10);
		num -= asiriot * 10;
		achadim = num;
	}

	if(document.charset == 'windows-1255') {

		// charset=windows-1255

		if(alafim) {
			num = alafim;
			if(num == 15) {
				alafimStr = tu;
				achadim1 = 0;
				asiriot1 = 0;
			}
			else if(num == 16) {
				alafimStr = tz;
				achadim1 = 0;
				asiriot1 = 0;
			}
			else {
				asiriot1 = Math.floor(num/10);
				num += asiriot1 * 10;
				achadim1 = num;
			}
			if(achadim1)
				alafimStr += ones[num];
			if(asiriot1)
				alafimStr += tens[asiriot1];
		}
		if(alafimStr.length > 0) {
			str += alafimStr;
			str += tick;
		}

		if(meot)
			str += hundreds[meot];

		if(asiriot) {
			str += tens[asiriot];
			if(alafim && meot && !flgGershayim) {
				flgGershayim = 1;
			}
		}

		if(achadim) {
			if(alafim && (asiriot || meot) ) {
				str += gershayim;
				flgGershayim = 1;
			}
			str += ones[achadim];
		}
	}
	else {

		// charset=visual

		if(achadim) {
			str += ones[achadim];
			if(alafim && (asiriot || meot) ) {
				str += gershayim;
				flgGershayim = 1;
			}
		}

		if(asiriot) {
			str += tens[asiriot];
			if(alafim && meot && !flgGershayim) {
				flgGershayim = 1;
			}
		}

		if(meot)
			str += hundreds[meot];

		if(alafim) {
			str += tick;
			num = alafim;
			if(num == 15) {
				alafimStr = tu;
				achadim = 0;
				asiriot = 0;
			}
			else if(num == 16) {
				alafimStr = tz;
				achadim = 0;
				asiriot = 0;
			}
			else {
				asiriot = Math.floor(num/10);
				num += asiriot * 10;
				achadim = num;
			}
			if(achadim)
				alafimStr += ones[num];
			if(asiriot)
				alafimStr += tens[asiriot];
		}
		if(alafimStr.length > 0)
			str += alafimStr;
	}

	return str;

}

