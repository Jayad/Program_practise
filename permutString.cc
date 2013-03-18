#include<stdio.h>
#include<string.h>

void prm(char s[],int begin,int end)
{
    char t;
    int k;
    if(begin==end)
    {
        printf("%s\n",s);
        return;
    }
    for(k=begin;k<=end;k++)
    {
        t=s[begin],s[begin]=s[k],s[k]=t;
        prm(s,begin+1,end);
        t=s[begin],s[begin]=s[k],s[k]=t;
    }
}
main()
{
    char s[100];
    printf("Enter the string\n");
    scanf("%s",s);
    prm(s,0,strlen(s)-1);
}
