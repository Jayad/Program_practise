class IteratorCannotMoveToNext{}; // Error class
 class MyIntLList
 {
 public:
     // The Node class represents a single element in the linked list. 
     // The node has a next node and a previous node, so that the user 
     // may move from one position to the next, or step back a single 
     // position. Notice that the traversal of a linked list is O(N), 
     // as is searching, since the list is not ordered.
     class Node
     {
     public:
         Node():mNextNode(0),mPrevNode(0),mValue(0){}
         Node *mNextNode;
         Node *mPrevNode;
         int mValue;
     };
     MyIntLList():mSize(0) 
     {}
     ~MyIntLList()
     {
         while(!Empty())
             pop_front();
     } // See expansion for further implementation;
     int Size() const {return mSize;}
     // Add this value to the end of the list
     void push_back(int value)
     {
         Node *newNode = new Node;
         newNode->mValue = value;
         newNode->mPrevNode = mTail;
         mTail->mNextNode = newNode;
         mTail = newNode;
         ++mSize;
     }
     // Remove the value from the beginning of the list
     void pop_front()
     {
         if(Empty())
             return;
         Node *tmpnode = mHead;
         mHead = mHead->mNextNode;
         delete tmpnode;
         --mSize;
     }
     bool Empty()
     {return mSize == 0;}
 
     // This is where the iterator definition will go, 
     // but lets finish the definition of the list, first
 
 private:
     Node *mHead;
     Node *mTail;
     int mSize;
 };

