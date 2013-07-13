const int ARRAY_LEN = 42;
 int *myArray = new int[ARRAY_LEN];
 // Set the iterator to point to the first memory location of the array
 int *arrayItr = myArray;
 // Move through each element of the array, setting it equal to its position in the array
 for(int i = 0; i < ARRAY_LEN; ++i)
 {
    // set the value of the current location in the array
    *arrayItr = i;
    // by incrementing the pointer, we move it to the next position in the array.
    // This is easy for a contiguous memory container, since pointer arithmetic 
    // handles the traversal.
    ++arrayItr;
 }
 // Do not be messy, clean up after yourself
 delete[] myArray;
