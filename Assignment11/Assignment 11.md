# Assignment 11: SQL Practice

<u>Student Name:</u> Yuehan Dai

<u>CS login</u>: ydai05

## Part 1

**1-1.Display the company name, contact name and title for all CUSTOMERS.**

```sql
SELECT CompanyName, ContactName, ContactTitle FROM Customers
```

**1-2.Display all information for all French SUPPLIERS**

```sql
SELECT * FROM SUPPLIERS 
WHERE Region like "%France%"
```

**1-3.Display name of all EMPLOYEES whose birthday was in 1960 or later**

```sql
SELECT LastName, FirstName FROM Employees
WHERE year(BirthDate) >= 1960
```

**1-4.Display name, cost of all PRODUCTS whose price is between $10 and $20 sorted from highest to lowest price**

```sql
SELECT ProductName, UnitPrice FROM Products
WHERE UnitePrice BETWEEN 10 AND 20
ORDER BY UnitPrice DESC
```





## Part 2 – Advanced 

> You may use a manual lookup to necessary data for these queries

**2-1.Display all countries in which the company has CUSTOMERS - with no repeats**

```sql
SELECT DISTINCT Region FROM Customers
```

**2-2.Display the PRODUCT name and price for suppliers 9-15 sorted by supplier and then by product name**

```sql
SELECT ProductName, UnitPrice FROM Products
WHERE SupplierID BETWEEN 9 AND 15
ORDER By SupplierID, ProductName
```

**2-3.Display the name and price for PRODUCTS that are Dairy or Meat and are supplied by Formaggi Fortini s.r.l. or Norske Meierier.**

```sql
SELECT ProductName, UnitPrice FROM Products
WHERE CategoryID = 4 or CategoryID = 6
```

**2-4.Display all information for PRODUCTS that come in tins.**

```sql
SELECT * FROM Products
WHERE UnitsOnOrder like ‘%tin%’
```

**2-5.Display the name of all EMPLOYEES involved with sales (based on their “Notes”) sorted alphabetically by their last name.**

```sql
SELECT LastName, FirstName From Employees
Where Note like ‘%sale%’
```





### Part 3 – Joins

> Use a Join to solve each of the following (i.e., you may NOT use a manual lookup)

**3-1.Display the names of all products in the beverages category**

```sql
SELECT ProductName, UnitPrice FROM Products
INNER JOIN Categories
ON Products.CategoryID = Categories.CategoryID
WHERE Categories.CategoriesName = "beverages"
```

**3-2.Display the product name and supplier name of all products from suppliers: Mayumi's or Leka Trading**

```sql
SELECT ProductName, Suppliers.CompanyName FROM Products
INNER JOIN Suppliers
ON Products.SupplierID = Suppliers.SupplierID
WHERE Suppliers.CompanyName = "Mayumi's" or Suppliers.CompanyName = "Leka Trading"
```

**3-3.Display the product name and supplier name for all products that cost less than $10 but only for suppliers from Germany**

```sql
SELECT ProductName, Suppliers.CompanyName FROM Products
INNER JOIN Suppliers
ON Products.SupplierID = Suppliers.SupplierID
WHERE Products.UnitPrice < 10 and Suppliers.Region like "%Germany%"
```
