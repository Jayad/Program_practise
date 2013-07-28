#include <stdio.h>
#include <iostream.h>

using namespace std;

class Node
{
	public:
	int element;
	Node * next;
	Node * prev;
	Node(){}	
	Node(int elem)
	{
	element=elem;
	}
};


int main()
{
	Node * n1 = new Node();
	n1->element=10;
	n1->next= NULL;
	n1->prev=NULL;
	cout<<"N1 Element = " << n1->element <<endl;
	Node * n2 = new Node(20);
	cout<<"N2 Element = " << n2->element <<endl;
	return 0;	
}
