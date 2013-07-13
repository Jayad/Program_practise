#include<iostream>
using namespace std;

void subsequence(char* a, char* b)
{
string s1 = a;
string s2 = b;

int arr1[256] ;
for(int i =0; i< s1.length(); i++){
arr1[s1.at(i)] = arr1[s1.at(i)] + 1;
}

for(int i=0; i<s2.length(); i++){
if(arr1[s2.at(i)]!=0){
arr1[s2.at(i)]--;
cout << s2.at(i) << endl;
}
}
}

int main() {
int arr[256];
subsequence("abc", "abcd");
return 0;
}


