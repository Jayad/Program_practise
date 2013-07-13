#include <string>
#include <map>
#include <algorithm>
#include <iostream>
#include <sstream>
#include <iterator>
#include <functional>

using namespace std;

class Square
  {
  int    num;

  public:

  // constructor
  Square ( const int number) :
   num (number) {};

  // default constructor
  Square () : num (0) {};

  // operator =
  Square & operator= (const Square & rhs)
    {
    // don't assign to self
    if (this == &rhs)
      return *this;

    num = rhs.num;
    return *this;
    };
  // access private members

  int GetSquare ()       const { return num*num; };
  int GetOneAdded()      const { return num+1;};

  }; // end of class Square

// function object to print one person
class fPrint
  {

  ostream & m_os;

  public:

  // constructor - remember which stream to use
  fPrint (ostream & os) : m_os (os) {};

  };  // end of class fPrint

typedef map<int, Square, less<int> > result_map;

int main (void)
  {
  // make a map of result
  result_map result;

  // add items to list
  result [1] = Square (2);
  result [2] = Square (4);
  result [3] = Square (6);

  result_map::const_iterator i = result.find (2);
  // best to declare this on its own line :)
  fPrint fo (cout);   // instance of function output object

  Square & p1 = result [1];
  Square & p2 = result [2];
  Square & p3 = result [3];

  cout << "Square of person[1]  is " << p1.GetSquare () << endl;
  cout << "Square of person[2]  is " << p2.GetSquare () << endl;
  cout << "Square of person[3]  is " << p3.GetSquare () << endl;

  cout << "Increment of person[1]  is " << p1.GetOneAdded () << endl;
  cout << "Increment of person[2]  is " << p2.GetOneAdded() << endl;
  cout << "Increment of person[3]  is " << p3.GetOneAdded() << endl;
  return 0;
  } // end of main

