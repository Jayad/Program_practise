// Create a list
 MyIntLList myList;
 // Add some items to the list
 for(int i = 0; i < 10; ++i)
     myList.push_back(i);
 // Move through the list, adding 42 to each item.
 for(MyIntLList::Iterator it = myList.Begin(); it != myList.End(); ++it)
     (*it)->mValue += 42;
