#include <string>
#include <map>
#include <algorithm>
#include <iostream>
#include <sstream>
#include <iterator>
#include <functional>

using namespace std;

class Person
  {
  int    m_iAge;

  public:

  // constructor
  Person ( const int iAge) :
   m_iAge (iAge) {};

  // default constructor
  Person () : m_iAge (0) {};

  // operator =
  Person & operator= (const Person & rhs)
    {
    // don't assign to self
    if (this == &rhs)
      return *this;

    m_iAge = rhs.m_iAge;
    return *this;
    };
  // access private members

  int GetAge ()       const { return m_iAge*m_iAge; };

  }; // end of class Person

// function object to print one person
class fPrint
  {

  ostream & m_os;

  public:

  // constructor - remember which stream to use
  fPrint (ostream & os) : m_os (os) {};

  // person object arrives as a pair of key,object
  void operator() (const pair <const int, const Person> & item) const
    {
     m_os << ", age "  << item.second.GetAge ()
          << endl;
    };

  };  // end of class fPrint

// declare type for storing people (numeric key, person object)
typedef map<int, Person, less<int> > people_map;

int main (void)
  {
  // make a map of people
  people_map people;

  // add items to list
  people [1] = Person (2);
  people [2] = Person (4);
  people [3] = Person (6);

  people_map::const_iterator i = people.find (2);
  // best to declare this on its own line :)
  fPrint fo (cout);   // instance of function output object

  //if (i == people.end ())
//    cout << "Not found." << endl;
 // else
   // {
   // fo (*i);    // dereference and print

    // key itself is the "first" part of the map pair ...
  //  cout << "Found key = " << i->first << endl;

    //}

  Person & p = people [1];

  cout << "Square of person[1]  is " << p.GetAge () << endl;

  return 0;
  } // end of main

