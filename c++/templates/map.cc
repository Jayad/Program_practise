#include<iostream>
#include<map>
#include<string>

int main(){
std::map<std::string,int> mymap={
	{"a",1},
	{"b",1},
	{"c",1}};
mymap.at("a")=15;
mymap.at("b")=25;
mymap.at("c")=35;
for (auto& x: mymap) 
{
cout << i.first << ":" << i.second ;
}
}
