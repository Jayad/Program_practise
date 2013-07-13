     /*
      *  The iterator class knows the internals of the linked list, so that it 
      *  may move from one element to the next. In this implementation, I have 
      *  chosen the classic traversal method of overloading the increment 
      *  operators. More thorough implementations of a bi-directional linked 
      *  list would include decrement operators so that the iterator may move 
      *  in the opposite direction.
      */
     class Iterator
     {
     public:
         Iterator(Node *position):mCurrNode(position){}
         // Prefix increment
         const Iterator &operator++()
         {
             if(mCurrNode == 0 || mCurrNode->mNextNode == 0)
                 throw IteratorCannotMoveToNext();e
             mCurrNode = mCurrNode->mNextNode;
             return *this;
         }
         // Postfix increment
         Iterator operator++(int)
         {
             Iterator tempItr = *this;
             ++(*this);
             return tempItr;
         }
         // Dereferencing operator returns the current node, which should then 
         // be dereferenced for the int. TODO: Check syntax for overloading 
         // dereferencing operator
         Node * operator*()
         {return mCurrNode;}
         // TODO: implement arrow operator and clean up example usage following
     private:
         Node *mCurrNode;
     };
     // The following two functions make it possible to create 
     // iterators for an instance of this class.
     // First position for iterators should be the first element in the container.
     Iterator Begin(){return Iterator(mHead);}
     // Final position for iterators should be one past the last element in the container.
     Iterator End(){return Iterator(0);}

