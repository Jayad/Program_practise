// constructing maps
#include <iostream>
#include <map>

bool fncomp (int *arr, char rhs) {return lhs<rhs;}

struct classcomp {
  bool operator() (int lhs, const char& rhs) const
  {   cout<< "this is test\n"; return 1;}
};

int main ()
{
  std::map<char,int> first;
  int arr[]={1,2,3};

  first['a']=10;
  first['b']=30;
  first['c']=50;
  first['d']=70;

  std::map<char,int> second (first.begin(),first.end());

  std::map<char,int> third (second);

  std::map<char,int,classcomp> fourth;                 // class as Compare

  bool(*fn_pt)(int *,char) = fncomp;
  std::map<char,int,bool(*)(int*,char)> fifth (arr,fn_pt); // function pointer as Compare

  return 0;
}
