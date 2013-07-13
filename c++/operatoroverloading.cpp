#include<iostream.h>
using namespace std;

int oper(int a , int b)
{
return a*b;
}

float oper(float a,float b)
{
return (a/b);
}
int main(){
int a=10,b=3;
float e=10.0,f=3.0;
int c= oper(a,b);
float d= oper(e,f);
cout<<"C=" << c <<endl;
cout<<"D=" << d <<endl;
return 0;
}
