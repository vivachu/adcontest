#### login as mysql -u root
#### create adcontest db and user
#### Uncomment the following lines on first time database setup
drop database adcontest;
create database adcontest;
grant all privileges on adcontest.* to 'adcontest'@'localhost' identified by 'adcontest' with grant option;
# only do this if you need to access the db remotely as this is very insecure
# grant all privileges on adcontest.* to 'adcontest'@'%' identified by 'adcontest' with grant option;
update mysql.user set execute_priv='Y', super_priv='Y' where user='adcontest';
grant alter routine on adcontest.* to 'adcontest'@'localhost';
grant create routine on adcontest.* to 'adcontest'@'localhost';
GRANT SELECT ON mysql.proc to 'adcontest'@'%';