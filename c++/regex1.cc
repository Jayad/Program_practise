#include <stdio.h>
#include <ctype.h>
#include <stdlib.h>
int main() {
  int arr[10], idx=0, d, l=0;
  char *p, *str = "6502007455@tmomail.net";
  for (p = str; *p != 0; p+=l) {
    l = 1;
    if (isdigit(*p)){
      sscanf(p, "%d%n", &d, &l);
      arr[idx++] = d;
    }   
  }   
  for (l=0; l<idx; l++) {
    printf("%d\n", arr[l]);
  }
  return 0;
}


