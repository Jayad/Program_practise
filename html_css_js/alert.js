/* http://ofps.oreilly.com/titles/9781449383268/ch02_id35816688.html
http://jquery.com/download/
https://github.com/jquery/jquery
http://learn.jquery.com/about-jquery/how-jquery-works/
http://api.jquery.com/category/effects/
*/

var food= ["apple", "banana", "orange"];
for(var i=o; i<food.length; i++)
{ 
 if(food[i]=='apple')
	alert(food[i] + 'is my faaourite');
  else
 	alert(food[i] + 'is fine');
}
  

/*event handling*/

var hiddenbox =$("#button-hidden-message");
$('#button-display button').on("click", function (event){hiddenbox.show();});

/* Ajax call */
/*html() is used to insert html with returned text */
/*
$.ajax({
	url: "/api/getweather",
	data: {zipcode:700005},
	success: function(data){$("weathe-temp").html("<strong>" + data +"</strong> degrees");} 
})*/

/*onload function: broswer finishes loading document,prob is it waits even for banner ads load also, to avoid that ready event, which works as soon as document is ready */

window.onload =function(){
alert("Welcome");}


/*add and remove HTML class*/
/*in <head> section */

<style type="text/css">
a.test {font-weight:bold;}
</style>

$("a").addClass("test");
$("a").removeClass("test");
$("a").click(function(event)
	{event.preventDefault();
	$(this).hide("slow");
 })

/*callback functions execute after parent function is done with execution */
/*When get() parameter is done in getting the html page, mycallBack function starts executing*/

$.get("mypage.html",myCallBack);/*callback without arguments*/
$.get("mypage.html",function(){myCallBack(param1,param2)}); /*callback with arguments,adding anonymous function() because we dont want the return value of mycallback function instead calling the function with parameters*/

/*for mobile device,  max-device-width and  min-device-width, Wireless Universal Resource File contains information that you can use to identify a huge number of wireless devices, including Android devices. If you need to detect Android devices with a width greater than 480 (such as a tablet), or if you don't want the mobile version of the site to appear when users resize their browser window below 480, you can use WURFL's PHP API to precisely detect specific browsers. See Appendix A, Detecting Browsers with WURFL for more information on WURFL.*/

/*For Mobile specific add metadata vieweport in <head> element, by default android assuems 980px*/

<meta name="viewport" content="user-scalable=no, width=device-width" />
<div class="leftButton" onclick="toggleMenu()">Menu</div>


if(window.innerWidth && window.innerWidth < 480)
{
$(document).ready(function(){
	$('#header u1').addClass('hide');
	$('#header').append('<div class="leftbutton" onlclick="toggleMenu()">Menu</div>');
});
function toggleMenu(){
$('#header ul').toggleClass('hide');
$('#header .leftButton').toggleClass('pressed');
}
}


/*simulate real world traffic in Mac 
sudo ipfw pipe 1 config bw 4KByte/s
sudo ipfw add 100 pipe 1 tcp from any to me 80
*/
