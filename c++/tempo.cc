#include <regex>
#include <string>
#include <sstream>
#include <iostream>

int main(int argc, char** argv)
{
   if (argc != 2)
   {
      std::cout << "Usage: " << argv[0] << " <data>" << std::endl;
      return -1;
   }

   boost::regex re("[*0-9*]");   // the regular expression
   std::string  data = argv[1];

   // Find the desired expression
   boost::sregex_iterator m1(data.begin(), data.end(), re);
   boost::sregex_iterator m2;
   std::stringstream      ss;

   // Save the result(s)
   while (m1 != m2)
   {
      ss << *m1++;
   }

   int num = -1;
   ss >> num;

   std::cout << "num = " << num << std::endl;
}

