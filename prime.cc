#include<iostream>

using namespace std;

int main()
{
int prime;

cout<<"enter your number"<<;
cin >> prime;

for(int i =3;i<=prime;i++)
{
bool var=true;
for(int j=2;j<=1-1; j++)
	{
	if(i % j==0)
	var=false;
	}
}
if(var){
	cout << i << "is prime" << endl;
}

return 0;
}

