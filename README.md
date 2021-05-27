# tamedia
Some technical organisation
```
root@7a7ab2bd909a:/# mysql -uroot -p tamedia < /var/lib/mysql/ff-2021-04-30.sql
Enter password:
root@7a7ab2bd909a:/# mysql -uroot -p tamedia < /var/lib/mysql/is24-2021-04-30.sql
Enter password:
root@7a7ab2bd909a:/# mysqldump -uroot -p tamedia "tamedia_listings" --result-file="/var/lib/mysql/dump.sql" --skip-add-locks --skip-disable-keys
```