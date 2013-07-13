#include<iostream>
using namespace std;

int addition(int a, int b)
{
return (a+b);
}

int subtraction(int a, int b)
{
return (a-b);
}

int operation(int a, int b, int (*func)(int a, int b))
{
int g;
g=(*func)(a,b);
return g;
}

int main()
{
int m,n,p;
//minus is a pointer to a function that has two parameters of type int. It is immediately assigned to point to the function subtraction, all in a single line:
int (*minus)(int,int) =subtraction;

m=operation(5,6,addition);
n=operation(25,m,minus);
p=operation(25,m,subtraction);
cout << n <<endl;
cout << p <<endl;
return 0;
}
