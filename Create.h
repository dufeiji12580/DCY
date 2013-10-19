#ifndef CREATE_H_INCLUDED
#define CREATE_H_INCLUDED
#include <iostream>
#include <fstream>
#include <string>
#include<conio.h>
#include<stdlib.h>
#include <vector>
#include <iomanip>
#include "DFSQL.h"

using namespace std;

void SQL::CreateSQL(string str)
{
    string restr = str;
    string tempstr;
    string tablestr;
    string path;
    vector<string> primarykey;
    vector<string> storage;
    int i,j,m,flag;
    i = restr.find(" ");
    while(isspace(restr[i]))
        i++;
    j = i;
    while(isgraph(restr[j]))
        j++;
    tempstr = restr.substr(i,j-i);
    if(tempstr != "table")
    {
        Errorinput();
        return;
    }
    while(isspace(restr[j]))
        j++;
    i = j;
    while(isgraph(restr[j]) || restr[j]=='(')
        j++;
    tempstr = restr.substr(i,j-i);
    if(tempstr == "(")
    {
        cout <<"Error, The tablename can't be empty!"<<endl;
        return;
    }
    while(getline(fin,tablestr))
    {
        int t = 0;
        while(isgraph(tablestr[t]))
            t++;
        if(tempstr == tablestr.substr(0,t))
        {
            cout<< "Error, The table is already exist!" <<endl;
            fin.clear();
            fin.seekg(0);
            return;
        }
    }
    tablestr = tempstr;
    while(isspace(restr[j]))
        j++;
    i=j;
    while(isgraph(restr[j]))
        j++;
    tempstr = restr.substr(i,j-i);
    if(tempstr!="(")
    {
        Errorinput();
        return;
    }
    while(tempstr != ";" && tempstr != "primary")
    {
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr == "char" || tempstr == "int")
        {
            cout << "Error, there's no atribute!" <<endl;
            return;
        }
        for(int k = 0; k<storage.size(); k++)
        {
            if(storage[k]==tempstr)
            {
                cout<<"Error, there are two same name in your table"<<endl;
                return;
            }
        }
        storage.push_back(tempstr);
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr!="char"&&tempstr!="int")
        {
            cout << "Error, there's no type of the charactor"<<endl;
            return;
        }
        if(tempstr=="char")
        {
            while(isspace(restr[j]))
                j++;
            i = j;
            tempstr = restr.substr(i,1);
            j++;
            if(tempstr != "(")
            {
                Errorinput();
                return;
            }
            while(isspace(restr[j]))
                j++;
            i = j;
            while(isgraph(restr[j]))
                j++;
            tempstr = restr.substr(i,j-i);
            for(int k=0; k<tempstr.size(); k++)
                if(!isdigit(tempstr[k]))
                {
                    cout<<"Error, the length of char should be digital"<<endl;
                    return;
                }
            while(isspace(restr[j]))
                j++;
            i = j;
            while(isgraph(restr[j]))
                j++;
            tempstr = restr.substr(i,j-i);
            if(tempstr != ")")
            {
                Errorinput();
                return;
            }
        }
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr!="," && tempstr!=")")
        {
            Errorinput();
            return;
        }
        if(tempstr == ")")
        {
            while(isspace(restr[j]))
                j++;
            i = j;
            while(isgraph(restr[j]))
                j++;
            tempstr = restr.substr(i,j-i);
            if(tempstr != ";" && tempstr != "primary")
            {
                Errorinput();
                return;
            }
        }
    }
    if(tempstr == "primary")
    {
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr != "key")
        {
            Errorinput();
            return;
        }
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr != "(")
        {
            Errorinput();
            return;
        }
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        primarykey.push_back(tempstr);
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        while(tempstr == ",")
        {
            while(isspace(restr[j]))
                j++;
            i = j;
            while(isgraph(restr[j]))
                j++;
            tempstr = restr.substr(i,j-i);
            primarykey.push_back(tempstr);
            while(isspace(restr[j]))
                j++;
            i = j;
            while(isgraph(restr[j]))
                j++;
            tempstr = restr.substr(i,j-i);
        }
        if(tempstr != ")")
        {
            Errorinput();
            return;
        }
        while(isspace(restr[j]))
            j++;
        i = j;
        while(isgraph(restr[j]))
            j++;
        tempstr = restr.substr(i,j-i);
        if(tempstr!=";")
        {
            Errorinput();
            return;
        }
    }
    while(isspace(restr[j]))
        j++;
    if(j!=restr.size())
    {
        Errorinput();
        return;
    }
    for(i = 0; i<primarykey.size(); i++)
    {
        for(j = i+1; j<primarykey.size(); j++)
        {
            if(primarykey[i] == primarykey[j])
            {
                cout << "Error, there shouldn't be two same primarykey!" <<endl;
                return;
            }
        }
    }
    for(i = 0; i<primarykey.size(); i++)
    {
        flag = 0;
        for(j = 0; j<storage.size(); j++)
        {
            if(primarykey[i] == storage[j])
            {
                flag = 1;
                break;
            }
        }
        if(flag == 0)
        {
            cout << "Error, the primary key you input is not the atribute of the table!" <<endl;
            return;
        }
    }
    path = rootpath + tablestr + ".dfsql";
    m = restr.find("table");
    m += 5;
    while(isspace(restr[m]))
        m++;
    restr = restr.substr(m,restr.size()-m);
    m = restr.size()-1;
    int n = m;
    for (i = 0; i<restr.size(); i++)
    {
        if(restr[i] == ' ' && restr[i+1] == ' ')
        {
            restr.replace(i,2," ");
            m--;
            n--;
        }
        if(restr[i] == ';')
        {
            while(restr[m]!=')')
                m--;
            restr.replace(m,n-m+1,")");
        }
    }
    fout << restr.c_str();
    fout << endl;
    fout.flush();
    ofstream tout;
    tout.open(path.c_str());
    if(!tout.is_open())
        systemout();
    tout.close();
    fin.clear();
    fout.clear();
    fin.seekg(0);
    storage.clear();
    cout << "Query OK!" <<endl;
}


#endif // CREATE_H_INCLUDED
