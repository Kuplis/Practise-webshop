drop database if exists teashop;

create database teashop;

use teashop;

create table category (
	cat_id INTEGER primary key not null,
	cat_name varchar(50)
);

create table user (
	user_id INTEGER primary key not null,
  username varchar(200) not null,
  password varchar(200) not null
);

create table product (
	product_id INTEGER primary key not null,
	tea_name varchar(50) not null,
	cat_id INTEGER not null,
	price DECIMAL(6,2),
	--index cat_id(cat_id)
	foreign key(cat_id) references category(cat_id)
);

create table customer (
	customer_id INTEGER primary key not null,
	firstname varchar(50) not null,
	lastname VARCHAR(50) not null,
	address varchar(250) not null,
	postcode smallint(5) not null,
	city varchar(50) not null,
	telnro smallint(10) not null,
	email varchar(250) not null
);
create table image (
	
)



create table orders (
	order_id INTEGER primary key,
	customer_id int not null, 
	order_date timestamp default CURRENT_TIMESTAMP,
	foreign key(customer_id) references customer(customer_id)
	on delete restrict
);

create table order_specs (
	order_id INTEGER not null,
	product_id INTEGER not null,
	amount INTEGER not null,
	primary key(order_id, product_id),
	foreign key(order_id) references orders(order_id),
	foreign key(product_id) references product(product_id)
	on delete restrict
);
insert into category (cat_name) values ('Black');
insert into category (cat_name) values ('White');
insert into category (cat_name) values ('Green');
insert into category (cat_name) values ('Rooibos');

