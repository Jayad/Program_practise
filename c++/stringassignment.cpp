#include <iostream>
using namespace std;

int main ()
{
  char question[] = "Please, enter your first name: ";
  char greeting[] = "Hello, ";
  char yourname [80];
  cout << question;
  cin >> yourname;
  cout << greeting << yourname << "!";
  string mystring;
  char myntcs[]="Good Morning!";
  mystring = myntcs;
  cout << mystring;
  return 0;
}
