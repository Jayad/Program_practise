#include<stdio.h>
#include <iostream.h>

using namespace std;

class A
{
public:
	void print()
	{cout << "I am inside Function A";}
};

int main()
{
 A *a=NULL;
  a->print(); 
return 0;
}
