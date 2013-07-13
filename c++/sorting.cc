#include <stdio.h>
#include <iostream.h>


int main(){

int i,j;
int array[4]= {5,4,7,2}; 
for(i=0;i<4;i++)
    {
        for(j=0;j<i;j++)
        {
            if(array[i]>array[j])
            {
                int temp=array[i]; //swap 
                array[i]=array[j];
                array[j]=temp;
            }

        }

    }


for (j=0;j<4;j++)
	cout << array[j];

return 0;
}
