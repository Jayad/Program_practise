#include<iostream.h>
#include<stdio.h>

/*int main()
{
char arr[4]="abc";
//for (int i=0;i<3;i++)
//	cout << arr[i] <<endl;

for (int i=0;i<=2;i++)
{
	//cout << "when i and arr[i]=" <<i << "/" <<arr[i] << "arr " <<arr;
	//cout << arr <<endl;
//	for (int j=1;j<=2;j++){
 	if(arr[i]!=NULL){
	char temp= arr[i+1];
	arr[i+1]=arr[i+2];
	arr[i+2]=temp;//}
	cout << arr << endl;}
	else
	break;
}
return 0;
}*/

void combo(char a[],int start,int end)
{

char temp;
int j;
if(start==end)
{cout<< a <<endl; return;}
for(j=start;j<end;j++)
	{
		temp=a[start];
		a[start]=a[j];
		a[j]=temp;
		combo(a,start+1,end);
		temp=a[start];
                a[start]=a[j];
                a[j]=temp;
	}
}

int main()
{char a[10];
cout << "Enter ur string: ";
cin >> a ;
combo(a,0,strlen(a)-1);
return 0;
}
