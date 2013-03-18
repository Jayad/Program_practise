#include<stdio.h>
#include<iostream.h>

using namespace std;

class Base 
{
	int length;int width;
	public:
	void setLength(int xyz, int abc){xyz=length; abc=width;}
	int area(int xyz, int abc){int temp =xyz*abc; return temp;}
};

class Rectangular : public  Base 
{
	public:
	int area(int xyz, int abc) {return xyz*abc*2;}
};

int main(){

	Base *b=new Base;
	b->setLength(2,3);
	cout << b->area(2,3) << endl;
	Rectangular *r=new Rectangular;
	r->setLength(2,3);
	cout << r->area(2,3) << endl;
	return 0;
}

/* checking charater pointer
int main(){
char *str= "hello";

cout << str <<endl;
cout << *str <<endl;
cout << *str++ <<endl;
str++;
cout << *str <<endl;

return 0;
}*/
