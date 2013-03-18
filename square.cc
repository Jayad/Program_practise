#include<iostream>
#include<map>
using namespace std;

template<typename T>
T square(T i)
{
        return i * i;
}

int main(int c, char *argv[])
{
        int (*fp) (int) = square;

        int t = std::map(fp, 6, 8);

        cout <<"i" <<endl;

        return 0;
}
