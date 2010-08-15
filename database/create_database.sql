#### login as mysql -u root
#### create bot_not db and user
#### Uncomment the following lines on first time database setup
drop database bot_not;
create database bot_not;
grant all privileges on bot_not.* to 'bot_not'@'localhost' identified by 'bot_not' with grant option;
# only do this if you need to access the db remotely as this is very insecure
# grant all privileges on bot_not.* to 'bot_not'@'%' identified by 'bot_not' with grant option;
update mysql.user set execute_priv='Y', super_priv='Y' where user='bot_not';
grant alter routine on bot_not.* to 'bot_not'@'localhost';
grant create routine on bot_not.* to 'bot_not'@'localhost';
GRANT SELECT ON mysql.proc to 'bot_not'@'%';