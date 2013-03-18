#include<stdio.h>
#include<iostream.h>
#include<string.h>

int main()
{
/*char *str="hello";
cout << strlen((char*)str);
cout<< *str;
cout<< *(++str);
cout<< str;
return 0;*/

char *str = "6502007455@tmomail.net";
  char str1[12];
  for(int i=0;i<strlen((char*)str);i++){
 if (isdigit(*str)){ cout<< *str; str1[i] = *str; str++; } }
  cout << endl <<str1;
}
