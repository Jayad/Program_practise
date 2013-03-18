#include <iostream>
#include <map>
using namespace std;

int square (int a) {cout<<"Square of" << a << "is" <<a*a;}

void test(char c,int i){ cout <<" I'm here "<<endl; }

/*int  square( int a)
{
cout<<"Square of" << a<<" is:"<< a*a;
}*/

int main()
{
std::map<char,int> first;
first['a']=2;
first['b']=4;
first['c']=6;
int (*ptr)(int) = square;
/*int i;
int a[3]={2,4,6};
for(i=0;i<3;i++)
cout<<"Square of" << i<<" is:"<< square(a[i]);*/

void (*test_ptr)(char,int) = test;
std::map<char,int> test(test_ptr);
return 0;
}
