<script type="text/javascript">
var Person = function (name) {this.name=name;console.log(this.name)}; Person.prototype.say=function (words) {console.log(this.name +' says '+ words);}; var tom= new Person('tom');  tom.say("hello");
// tom says hello
var div=document.createElement('div');div.textContent ="Why there?"; div.setAttribute('class','note'); document.body.appendChild(div); // <div class="note">
var span=document.createElement('span'); span.textContent= "Hello";div.appendChild(span); //<span>
var span=document.createElement('span'); if(span.textContent) span.textContent = "Hello"; else if (span.innerText) span.innerText= "InnerHello"; div.appendChild(span); // innerText as in IE textContent doesnt work
var span=document.createElement('span'); if(span.textContent) span.textContent = "Hello"; else if (span.innerText) span.innerText= "InnerHello"; span.parentNode.removeChild(div); //span.parentNode is NULL
var regexp=/^[a-z\s]+$/; var string="I am loving it"; if(string.match(regexp)) alert("Does contain all lowercase");else alert("doesnot contains all lowercase");
//doesnot contains all lowercase
var text="I am having a bored life, oh God please do something and nothing"; text.replace(/(every|no)thing/gi,'everything');
//"I am having a bored life, oh God please do something and everything" // last g means all occurence,ideally it works on the first element only and i means case insensitive
var add = function (a) {return function(b){return a+b;};}; var addfive =add(5);console.log(addfive(10)); // this is called closure, u can understand like this add(5(10)); a=5, then b=10 here
try {JSON.parse("a");}catch(error){error.message;} //Try catch block in JS
throw new Error("I hungry. Fridge empty."); //Creating own Error
var fruits=["Banana", "Apples", "Guava", "Litchi", "Mango"];console.log(fruits.toString());
//Banana,Apples,Guava,Litchi,Mango
 var fruits=["Banana", "Apples", "Guava", "Litchi", "Mango"]; var number=["one", "two", "three"]; console.log(fruits.concat(number));
//["Banana", "Apples", "Guava", "Litchi", "Mango", "one", "two", "three"]
var fruits=["Banana", "Apples", "Guava", "Litchi", "Mango"]; fruits.splice(1,0,"lemon","cherry"); console.log(fruits);
//["Banana", "lemon", "cherry", "Apples", "Guava", "Litchi", "Mango"]
var num=15;n=num.valueOf();console.log(n);
//15
</script>
