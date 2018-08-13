function openClose(theID) {
	if (document.getElementById(theID).style.display == "block") {
		document.getElementById(theID).style.display = "none";
	} else {
		document.getElementById(theID).style.display = "block";
	}
}

function display_date () {
	var day, month, year;

	var today = new Date;
	var yesterday = new Date(today.getTime() - 86400000);

	yd = yesterday.getDate();
	ym = yesterday.getMonth() + 1;
	yy = yesterday.getYear();
	if(yy < 1900)
		yy += 1900; // if date from Netscape, then add 1900

	td = today.getDate();
	tm = today.getMonth() + 1;
	ty = today.getYear();
	if(ty < 1900)
		ty += 1900; // if date from Netscape, then add 1900

	var hebDate = civ2heb(td, tm, ty);
	var hmS = hebDate.substring(hebDate.indexOf(' ')+1, hebDate.length);
	var	hDay = eval(hebDate.substring(0, hebDate.indexOf(' ')));
	var hMonth = eval(hmS.substring(0, hmS.indexOf(' ')));
	var hYear = hmS.substring(hmS.indexOf(' ')+1, hmS.length);

	document.write(hDay + ' ' + hebMonth[hMonth+1] + ' ' + hYear);
	document.write(' &#8226; ');		
	document.write(civMonth[tm] + ' ' + td + ', ' + ty);
}

function textCounter(field, countfield, maxlimit) {
	if (field.value.length > maxlimit) {
		// if too long...trim it!
		field.value = field.value.substring(0, maxlimit);
	} else {
		// otherwise, update 'characters left' counter
		countfield.value = maxlimit - field.value.length;
	}
}

function currencyFormat(fld, milSep, decSep, e) {
	var sep = 0;
	var key = '';
	var i = j = 0;
	var len = len2 = 0;
	var strCheck = '0123456789';
	var aux = aux2 = '';
	var whichCode = (window.Event) ? e.which : e.keyCode;
	if (whichCode == 13) return true;  // Enter
	key = String.fromCharCode(whichCode);  // Get key value from key code
	if (strCheck.indexOf(key) == -1) return false;  // Not a valid key
	len = fld.value.length;
	for(i = 0; i < len; i++)
		if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
	aux = '';
	for(; i < len; i++)
		if (strCheck.indexOf(fld.value.charAt(i))!=-1) aux += fld.value.charAt(i);
	aux += key;
	len = aux.length;
	if (len == 0) fld.value = '';
	if (len == 1) fld.value = '0'+ decSep + '0' + aux;
	if (len == 2) fld.value = '0'+ decSep + aux;
	if (len > 2) {
		aux2 = '';
		for (j = 0, i = len - 3; i >= 0; i--) {
			if (j == 3) {
				aux2 += milSep;
				j = 0;
			}
			aux2 += aux.charAt(i);
			j++;
		}
		fld.value = '';
		len2 = aux2.length;
		for (i = len2 - 1; i >= 0; i--)
			fld.value += aux2.charAt(i);
		fld.value += decSep + aux.substr(len - 2, len);
	}
	return false;
}

function checkRadios() {
	var el = document.forms[0].elements;
	for(var i = 0 ; i < el.length ; ++i) {
		if(el[i].type == "radio") {
			var radiogroup = el[el[i].name]; // get the whole set of radio buttons.
			var itemchecked = false;
			for(var j = 0 ; j < radiogroup.length ; ++j) {
				if(radiogroup[j].hasAttribute('data-skipCheckRadios') || radiogroup[j].checked) {
					itemchecked = true;
					break;
				}
			}
			if(!itemchecked) { 
				alert("Please choose an option for "+el[i].name+".");
				if(el[i].focus)
					el[i].focus();
				return false;
			}
		}
	}
	return true;

} 

// for the drop-down menu in the header
sfHover = function() {
	var sfEls = document.getElementById("nav").getElementsByTagName("LI");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" sfhover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);



function fmtPrice(value) {
result="$"+Math.floor(value)+".";
var cents=100*(value-Math.floor(value))+0.5;
result += Math.floor(cents/10);
result += Math.floor(cents%10);
return result;
}
function compute() {
var unformatted_tax = (document.forms[0].cost.value)*(document.forms[0].tax.value);
document.forms[0].unformatted_tax.value=unformatted_tax;
var formatted_tax = fmtPrice(unformatted_tax);
document.forms[0].formatted_tax.value=formatted_tax;
var cost3= eval( document.forms[0].cost.value );
cost3 += eval( (document.forms[0].cost.value)*(document.forms[0].tax.value) );
var total_cost = fmtPrice(cost3);
document.forms[0].total_cost.value=total_cost;
}
function resetIt() {
document.forms[0].cost.value="19.95";
document.forms[0].tax.value=".06";
document.forms[0].unformatted_tax.value="";
document.forms[0].formatted_tax.value="";
document.forms[0].total_cost.value="";
}