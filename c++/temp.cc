// disable warnings about long names
#ifdef WIN32
  #pragma warning( disable : 4786)
#endif

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
  // private members
  string m_sName;
  string m_sEmail;
  int    m_iAge;

  public:

  // constructor
  Person (const string sName, 
          const string sEmail, 
          const int iAge) :
   m_sName (sName), m_sEmail (sEmail), m_iAge (iAge) {};

  // default constructor
  Person () : m_iAge (0) {};

  // copy constructor
  Person (const Person & p) :
    m_sName (p.m_sName), m_sEmail (p.m_sEmail), m_iAge (p.m_iAge) {};
    
  // operator =
  Person & operator= (const Person & rhs)
    {
    // don't assign to self
    if (this == &rhs)
      return *this;

    m_sName = rhs.m_sName;
    m_sEmail = rhs.m_sEmail;
    m_iAge = rhs.m_iAge;
    return *this;
    };

  // access private members

  string GetName ()   const { return m_sName; };
  string GetEmail ()  const { return m_sEmail; };
  int GetAge ()       const { return m_iAge; };

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
     m_os << "# " << item.first << " - name: "
          << item.second.GetName ()
          << " - "     << item.second.GetEmail ()
          << ", age "  << item.second.GetAge ()
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
  people [1234] = Person ("Nick", "nick@some-email-address.com", 15);
  people [4422] = Person ("Fred", "fred@nurk.com.au", 100);
  people [88]   = Person ("John", "john@smith.com.au", 35);
  // insert a different way ...
  people.insert (make_pair (42, Person ("Abigail", "abigail@blah.com.au", 22)));

  // best to declare this on its own line :)
  fPrint fo (cout);   // instance of function output object

  // print everyone (calls a function object to print)
  cout << "Printing all using fPrint ..." << endl;
  for_each (people.begin (), people.end (), fo);

  // find someone by key
  cout << "Finding person 4422 ..." << endl;

  people_map::const_iterator i = people.find (4422);

  if (i == people.end ())
    cout << "Not found." << endl;
  else
    {
    fo (*i);    // dereference and print

    // another way of printing - 

    // key itself is the "first" part of the map pair ...
    cout << "Found key = " << i->first << endl;

    // person object is the "second" part of the map pair...

    cout << "Found name = " << i->second.GetName () << endl;
    }

  // Note, this will not work:
  //   fPrint (cout) (*i);

  // However this will:
  //   0, fPrint (cout) (*i);

  // However I think the extra zero is a bit obscure. :)

  // An alternative way of finding someone.
  // Note - this will add them if they are not there.
  // Since this is a reference changing it will change the person in the 
  // map. Leave off the & to get a copy of the person.

  Person & p = people [1234];

  cout << "Person 1234 has name " << p.GetName () << endl;

  // Example of erasing an element correctly ...
  // If we did the j++ as part of the for loop we would end up
  // adding 1 to an iterator that pointed to an element that was
  // removed which would lead to a crash. See Josuttis p 205.

  cout << "Erasing people of age 100" << endl;

  for (people_map::iterator j = people.begin (); j != people.end (); )
    {
    if (j->second.GetAge () == 100)
      people.erase (j++); // iterator is advanced before the erase occurs
    else
      ++j;                  // advance the iterator
    } // end of erase loop


  // now display who is left
  cout << "Printing people left after erase ..." << endl;
  for_each (people.begin (), people.end (), fo);

  return 0;
  } // end of main

