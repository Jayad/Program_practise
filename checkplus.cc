#include <stdio.h>
#include <iostream.h>

using namespace std;

int main()
{
char *str="+998";
cout << str <<endl;

if (*str=='+')
{str=str++;
cout<<str;
}


return 0;
}
