CREATE TABLE Supplier(
   SPID varchar2(6),
   F_name varchar2(10),
   L_name varchar2(10),
   CONSTRAINT supplier_pk PRIMARY KEY(spid)
);


CREATE TABLE Superstore(
    branch_id varchar(6),
    Location varchar2(30),
    Branch_name varchar2(30),
   CONSTRAINT superstore_pk PRIMARY KEY(branch_id)
);


CREATE TABLE Employee(
    hiredate DATE,
    emp_id varchar(6),
    E_address varchar2(30),
    designation varchar2(20),
    dateofbirth date,
    E_phone varchar2(13),
   First_name varchar2(20),
 Last_name varchar2(15),
 branch_id varchar2(6),
   CONSTRAINT employee_pk PRIMARY KEY(emp_id),
 CONSTRAINT branchid_fk FOREIGN KEY (branch_id)  REFERENCES superstore(branch_id)
  );

CREATE TABLE order(
O_date DATE,
No_of_items varchar2(3),
order_id varchar2(6),
order_status varchar(10),
CONSTRAINT order_pk PRIMARY KEY(order_id)
);
CREATE TABLE Shipment(
    SID varchar2(6),
    S_date DATE,
  s_time VARCHAR2(15),
  order_id varchar2(6),
   CONSTRAINT shipment_pk PRIMARY KEY(SID),
 constraint orderid_fk FOREIGN KEY(order_id)
 REFERENCES orrder(order_id)
  );


CREATE TABLE customerx(
  C_address varchar2(30),
  first_name varchar2(10),
  last_name varchar2(10),
  C_phone varchar(13),
  C_id varchar2(4),
  CONSTRAINT costumer_pk PRIMARY KEY(C_ID)
);
CREATE TABLE Category(
CT_name varchar2(10),
CT_ID varchar2(4),
CONSTRAINT category_pk PRIMARY KEY(CT_ID)
);

CREATE TABLE Item(
I_ID varchar2(4),
I_name varchar2(25),
Item_count number,
item_location varchar2(5),
saleprice number,
purchaseprice number,
description varchar2(150),
SPID varchar2(6),
CT_ID varchar2(4),
CONSTRAINT item_pk PRIMARY KEY(I_ID),
CONSTRAINT spid_fk FOREIGN KEY(spid)
REFERENCES supplier(spid),
CONSTRAINT ctid_fk FOREIGN KEY(CT_ID)
REFERENCES category(CT_ID)
);
