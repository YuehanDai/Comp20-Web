

# Assignment 12: NoSQL Practice

Student Name: Yuehan Dai

CS login: ydai05



## Part 1: 

![Part 1 1](C:\Users\70908\OneDrive - Tufts\2021 Spring\Comp20 Web\Assignment12\Part 1\Part 1 1.png)

<img src="C:\Users\70908\OneDrive - Tufts\2021 Spring\Comp20 Web\Assignment12\Part 1\Part 1 2.png" alt="Part 1 2" style="zoom: 50%;" />

<img src="C:\Users\70908\OneDrive - Tufts\2021 Spring\Comp20 Web\Assignment12\Part 1\Part 1 3.png" alt="Part 1 3" style="zoom: 50%;" />



## Part 2

**Select the database**

```
use band
```

**Show all data from all songs**

```
db.set_list.find()
```

**Show all song titles from a particular genre**

```
db.set_list.find({genre:"Instrumental"}, {name: 1, _id: 0})
```

or

```
db.set_list.find({"genre":"Instrumental"}, {name: 1, _id: 0})
```

Both of them works

## Question

#### Identify the tools used to work with an SQL and a NoSQL database.

<u>SQL</u>: MySQL

<u>NoSQL</u>: I used the MongoDB compass to insert the data and the windows' terminal to connect MongoDB. 

#### Which do you prefer working with, a SQL or a NoSQL database and why.

I prefer SQL rather than NoSQL. This is because the syntax of SQL is more direct and easy to read. Further, SQL allows inner join. For example, one books can have multiple authors and one author can have multiple books, and they can be all connected. However, NoSQL is more likely to be the folders, which means the authors can only be the subset of the books. 