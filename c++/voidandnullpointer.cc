#include<iostream>
using namespace std;

void increase(void* data, int size)
{
	if(size==sizeof(char))
	{
	char *pchar;
	pchar=(char*)data;
	++(*pchar);
	}
	else if (size==sizeof(int))
	{
	int *pint;
	pint=(int*)data;
	++(*pint);
	}
}

int main()
{
 char a= 'x';
 int b = 1602;
 increase(&a,sizeof(a));
 increase(&b,sizeof(b));
 cout << a << "," <<b;
 return 0;
	
}
