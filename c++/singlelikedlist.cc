#include <stdio.h>
#include <iostream.h>
#include <alloc.h>

using namespace std;

struct Node {
	int element;
	Node *next;
};

void addelem(Node *a, int elem){
	struct Node *n= (Node *)malloc(sizeof(struct Node));
	if (n == NULL)
	cout << "No memory allocated";
	else{ 
		if(n->next==NULL){
		n->element=elem;
		n->next=NULL;}
		else
		{	
			while(n->next!=NULL)
			n=n->next;
			n->element=elem;
			n->next=NULL;
		}
	}
}

void display(Node *a){
	if(a==NULL)
		cout << "No Elements in array ";
		while (a->next!=NULL)
			cout << " Elements :" << a->element;
}

void delelem(Node *a, int elem)
{
	struct Node *temp= (Node *)malloc(sizeof (struct Node));
	struct Node *temp1= (Node *)malloc(sizeof (struct Node));
	
	while(temp->next!=NULL){
	if(temp->element==elem){
		temp1=temp;
		temp1->element=temp->element;
		temp->element=temp->next->element;
		temp->next=temp->next->next;
		}
	free (temp);
	}
}

void reverse (Node *a)
{
	struct Node *temp, *temp1,*temp2;
	temp=a;
	temp1=NULL;

	while (temp!=NULL){
		temp2=temp1;
		temp1=temp;
		temp=temp->next;
		temp->next=temp2;
	}
	a=temp2;
}


int main()
{
        cout <<  "Add Nodes " << endl;
        struct Node *n= (Node *)malloc(sizeof(struct Node));
        addelem(n,1);
        addelem(n,2);
        addelem(n,3);
        addelem(n,4);
        addelem(n,5);
        addelem(n,6);
        addelem(n,7);
        addelem(n,8);
        addelem(n,9);
        cout << "Display Nodes " << endl;
        display(n);
        cout << "Reverse Nodes " << endl;
        //reverse(n);
        cout << "Display Nodes " << endl;
        display(n);
        cout << "Deleting element 8" << endl;
        delelem(n,8);
        cout << "After deleting 8 " << endl;
        display(n);
        return 0;
}
