#include<iostrem>
using namespace std;

//Computer, which is an abstract base class (interface) and its derived classes: Laptop and Desktop.
class Computer
 {
 public:
     virtual void Run() = 0;
     virtual void Stop() = 0;
 };
 class Laptop: public Computer
 {
 private:
     bool mHibernating; // Whether or not the machine is hibernating
 public:
     virtual void Run(){mHibernating = false;}
     virtual void Stop(){mHibernating = true;}
 };
 class Desktop: public Computer
 {
 private:
     bool mOn; // Whether or not the machine has been turned on
 public:
     virtual void Run(){mOn = true;}
     virtual void Stop(){mOn = false;}
 };

//The actual ComputerFactory class returns a Computer, given a real world description of the object.
//there is a compilation benefit. If we move the interface Computer into a separate header file with the factory, we can then move the implementation of the NewComputer() function into a separate implementation file. Now the implementation file for NewComputer() is the only one that requires knowledge of the derived classes. Thus, if a change is made to any derived class of Computer, or a new Computer subtype is added, the implementation file for NewComputer() is the only file that needs to be recompiled. Everyone who uses the factory will only care about the interface, which should remain consistent throughout the life of the application.

 class ComputerFactory
 {
 public:
     static Computer *NewComputer(const std::string &description)
     {
         if(description == "laptop")
             return new Laptop;
         if(description == "desktop")
             return new Desktop;
         return NULL;
     }
 };
