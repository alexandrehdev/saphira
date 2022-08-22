# saphira

This PHP package will help you to

- Create Data
- Read Data
- Update Data
- Delete Data

It'll do that by abstracting all the query stuff, and that means that you don't need to worry about typing something like this in your code:

`SELECT * FROM database.table`

For example, If you would like to get all the data from your table

`DataActions::selectAll("table_name");`


# Installation 

- Composer

If you have composer installed, all you gotta do is run the command above:

`composer require saphira/connectdb:dev-master`






