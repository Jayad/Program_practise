#include<iostream>
#include<string>

void change(char *first,char* second)
{
 char temp;
    temp = *first;
    *first = *second;
    *second = temp;
}

void permutation(char *word, int i, int count) 
{
   int j; 
   if (i == count)
     printf("%s\n", word);
   else
   {
        for (j = i; j <= count; j++)
       {
          change((word+i), (word+j));
          permutation(word, i+1, count);
          change((word+i), (word+j));
	  printf("%s\n",word);
       }
   }
}

int main(){
char array[]="abc"; 
//   for (int i=0;i<4;i++){
   permutation(array, 0, 3);
   getchar();
return 0;
}
