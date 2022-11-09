drop database if exists shoppinglist;

create database shoppinglist;

use shoppinglist;

create table item (
    id int primary key auto_increment,
    description varchar(255) not null,
    amount smallint unsigned not null
);

insert into item (description,amount) values ("Omenia",3);

insert into item (description,amount) values ("Munia",30);

insert into item (description,amount) values ("Jauhelihaa",2);

insert into item (description,amount) values ("Maitoa",4);