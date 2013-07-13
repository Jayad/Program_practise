function myfunc(theobejct)
{
theobject.make ="toyota";
}

var mycar={make:"Honda", type: "car", model:"2009"},x,y;

x=mycar.make;//"Honda"
myfunc(mycar);
y=mycar.make; //"toyota", as overwritten in myfunc


function myFunc(theObject) {
  theObject = {make: "Ford", model: "Focus", year: 2006};
}

var mycar = {make: "Honda", model: "Accord", year: 1998},
    x,
    y;

x = mycar.make;     // x gets the value "Honda"

myFunc(mycar);
y = mycar.make;     // y still gets the value "Honda"
