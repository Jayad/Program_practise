#include<stdio.h>
#include<iostream>
#include<string.h>

using namespace std;
void pallindrome(char strg[])
{
cout <<"Yes it is." << strg;
int i;
char *front;
//char *end;
front=strg;
int end=strlen(strg);
cout <<front;
cout<<end;
}

int main()
{
char string[100];
cout << "Enter your string: " ;
cin >> string;

pallindrome(string);
return 0;

}
