#include<iostream>
using namespace std;

int main()
{
int prime,total;
cout<<"enter number";
cin >>prime;

for (int i=1; i<=prime; i++)
{
if(prime%i==0)
	total++;
}
if(total==2)
cout<< "prime";
else 
cout<< "Not Prime";

return 0;
}
