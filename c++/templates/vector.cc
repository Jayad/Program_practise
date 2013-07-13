#include<iostream>
#include<vector>
using namespace std;

int main(){

std::vector<int> first; //Can be alternatively written as vector::<int> first;
std::vector<int> second;
std::vector<int> third;

first.assign(7,100);
cout << "First Element size:" << int (first.size()) << endl; 

std::vector<int>::iterator it;

it=first.begin()+1;
second.assign(it,first.end()-1);

cout << "Second Element size:" << int (second.size()) << endl; 
int myints[]={1,2,3};
third.assign(myints,myints+6);
cout << "Third Element size:" << int (third.size()) << endl; 

std::vector<int>::iterator  myit = {1,2,3,4,5};

for (auto it = myit.crbegin(); it != myit.crend(); it++)
std::cout << *it;
}

