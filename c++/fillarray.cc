#include <iostream>
 
using namespace std;
 
class Stack
{
private:
    int *p;
    int top,length;
 
public:
    Stack(int = 0);
    ~Stack();
 
    void push(int);
    int pop();
    void sort();
    void display();
};
 
Stack::Stack(int size)
{
    top=-1;
    length=size;
    if(size == 0)
        p = 0;
    else
        p=new int[length];
}
 
Stack::~Stack()
{
    if(p!=0)
        delete [] p;
}
 
void Stack::push(int elem)
{
    if(p == 0)                //If the stack size is zero
    {
        cout<<"Stack is Empty Now"<<endl;
        length=3;   	     //Making a fixed size array, with value 10 
        cout<<"Enter a size for stack : " << length <<endl;
        p=new int[length];
    }
    if(top==(length-1))     //If the top reaches to the maximum stack size
    {
        //cout<<"\nCannot push "<< elem <<", Stack full"<<endl;
        cout<<"Stack full"<<endl;
	int i,j;
	bool flag=false;
	for(i=0;i<4;i++)
        {
        for(j=0;j<i;j++)
        {
            if(p[i]>p[j])
            {
                int temp=p[i]; //swap 
                p[i]=p[j];
                p[j]=temp;
            }
        }
    	}
        //return;
	//cout <<endl<< "hi"<< p[0]<< "" <<endl;
	/*if (elem < p[0]){
	cout << "Inserted Element" << elem << "is less than the current highest element in the list, replacing with highest element of the array" << endl ;
	    p[0]=elem; 
	}
	else 
		if (elem == p[0])
	   cout << "This number already present in the list!!!!" << endl;
	*/
	
	if (elem > p[0])
	    cout << "The number you inserted" << elem << " is greater than the current numbers present in the list, discarding." << endl;
	else {
	   for (i=0;i<4;i++)
		{
		if (elem==p[i]){flag=true; break;}
		}
	    if(flag==true) {cout << "Element found to be already present, no need to reprocess again. "<< endl;}
	    else {p[0]= elem; cout << "Inserting element " << elem << endl;}
	}	
    }
    else
    {
        top++;
        p[top]=elem;
    }
}

int Stack::pop()
{
    if(p==0 || top==-1)
    {
        cout<<"Stack empty!";
        return -1;
    }
    int ret=p[top];
    top--;
    length--;
 
    return ret;
}
 
void Stack::display()
{
    for(int i = 0; i <= top; i++)
        cout<<p[i]<<" ";
    cout<<endl;
}
 
int main()
{
    Stack s1;             //We are creating a stack of size 'zero'
    int option;
    int number;
    char c = 'y';
    do {
    bool flag=true;
    cout << "Options for you:" <<endl;
    cout << "Press 1 to insert new element" <<endl;
    cout << "Press 2 to display elements in the array" <<endl;
    cout << "Press 3 to terminate the program" << endl;
    cin >> option;
   
    while(flag==true)
    {
    switch(option){
	case 1: cout << "Enter the element you want to push :";
    		cin >> number;
        	s1.push(number);
    		s1.display();
    		cout << "Do u want to provide more input? Press 'Y' for Yes and 'N' for No " ;
    		cin >> c;
		if(c == 'N' ||c == 'n') flag=false;
		break;
	case 2: cout << endl <<"========================" << endl;
		cout << "Elements in the array :";
		cout << endl <<"========================" << endl;
		s1.display();
		cout << endl <<"========================" << endl;
		flag=false;
		break;
	case 3: cout << "Closing the program";
		cout << endl <<"========================" << endl;
		flag=false;
		return 0;
 	}
   }
 }while(true);
}
