/**
 *     News announcement scroll
 *     Copyright (C) 2011  www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function _gAnnounce()
{
	if((document.gAnnouncefrm.gNews_text.value).trim()=="")
	{
		alert("Please enter the news.")
		document.gAnnouncefrm.gNews_text.focus();
		return false;
	}
	else if((document.gAnnouncefrm.gNews_order.value).trim()=="")
	{
		alert("Please enter the display order.")
		document.gAnnouncefrm.gNews_order.focus();
		return false;
	}
	else if(isNaN(document.gAnnouncefrm.gNews_order.value))
	{
		alert("Please enter the display order in number.");
		document.gAnnouncefrm.gNews_order.focus();
		document.gAnnouncefrm.gNews_order.select();
		return false;
	}
	else if((document.gAnnouncefrm.gNews_type.value).trim()=="")
	{
		alert("Please enter the type(This is to group the announcement records).")
		document.gAnnouncefrm.gNews_type.focus();
		return false;
	}
	else if(document.gAnnouncefrm.gNews_status.value=="")
	{
		alert("Please select the display status.")
		document.gAnnouncefrm.gNews_status.focus();
		return false;
	}
	escapeVal(document.gAnnouncefrm.gNews_text,'<br>');
}
String.prototype.trim = function() 
{
	return this.replace(/^\s+|\s+$/g,"");
}

function escapeVal(textarea,replaceWith)
{
textarea.value = escape(textarea.value) //encode textarea strings carriage returns
for(i=0; i<textarea.value.length; i++)
{
	//loop through string, replacing carriage return encoding with HTML break tag
	if(textarea.value.indexOf("%0D%0A") > -1)
	{
		//Windows encodes returns as \r\n hex
		textarea.value=textarea.value.replace("%0D%0A",replaceWith)
	}
	else if(textarea.value.indexOf("%0A") > -1)
	{
		//Unix encodes returns as \n hex
		textarea.value=textarea.value.replace("%0A",replaceWith)
	}
	else if(textarea.value.indexOf("%0D") > -1)
	{
		//Macintosh encodes returns as \r hex
		textarea.value=textarea.value.replace("%0D",replaceWith)
	}
}
textarea.value=unescape(textarea.value) //unescape all other encoded characters
}

function ConvertBR(input) 
{
	var output = "";
	for (var i = 0; i < input.length; i++) 
	{
		if ((input.charCodeAt(i) == 13) && (input.charCodeAt(i + 1) == 10)) 
		{
			i++;
			output += "";
		} 
		else 
		{
			output += input.charAt(i);
		}
	}
	//return output;
	alert(output)
}

function _gHelp()
{
	window.open("http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/");
}