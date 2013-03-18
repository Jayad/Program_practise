#include <stdio.h>
#include <stdlib.h>
#include <ctype.h>

int main() {
  int array[8], count=0, data;
  const char *s = "Trim(+2714,8256)++Trim(10056,26448)++Trim(28248,49165)";
  char *p;
  while(*s) {
    if(isdigit(*s) || *s=='-' && isdigit(s[1])){
      data = strtol(s, &p, 10);
      s = p;
      array[count++] = data;
    } else
        ++s;
  }
  {//test print
    int i;
    for(i=0;i<count;++i)
      printf("%d\n", array[i]);
  }
  return 0;
}


