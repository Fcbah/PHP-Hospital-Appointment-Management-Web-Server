# Configuring the mail funtion and php.ini in Ubuntu 18.04 XAMPP (LAMPP) with Post Fix
@OluwanifemiBam Please, can you send your configuration details for postfix.
Although I use Linux (Ubuntu), I believe the filesystem is similar.
For me, After installing Postfix, using information i got from googling I configured `/etc/postfix/main.cf`  by  adding these lines

```
relayhost = [smtp.mailtrap.io]:2525
smtp_sasl_auth_enable = yes
smtp_sasl_password_maps = hash:/etc/postfix/sasl_passwd
smtp_sasl_security_options = noanonymous
smtp_tls_CAfile = /etc/postfix/cacert.pem
smtp_use_tls = yes
```
Then I configured /etc/postfix/sasl_passwd  with `USERNAME:PASSWORD`
```
[smtp.mailtrap.io]:2525 33f95f1b599c5b:c424b52bd462a6
```
Then I validated certificates with
```
$ cat /etc/ssl/certs/thawte_Primary_Root_CA.pem | sudo tee -a /etc/postfix/cacert.pem
```

### Source of error:
Before reloading Postfix you must hash your `sasl_passwd` file to `sasl_passwd.db`
using `postmap` command
```
$ sudo postmap /etc/postfix/sasl_passwd
```

And reloaded postfix with
```
$ sudo /etc/init.d/postfix reload
```
I ran this test and got nothing in my mail box
```
echo "Test mail from postfix" | mail -s "Test Postfix" you@example.com
```
I ran the send reset mail code and got nothing also in my mail box.
Please I really need help, I just un-installed sendmail when it did not work.
I want to be sure that postfix won't work before I uninstall it and try PHP Mailer & Composer.

## Test email not working

check error log at the `/var/log/` folder. You can check the `mail.log` and/or `mail.err` file.
```
gedit /var/log/mail.log
```
If you have this error then you forgot to has the `sasl_passwd`.
```
Apr 20 01:23:02 hephzibah-HP15-ra0xx postfix/smtp[19624]: warning: hash:/etc/postfix/sasl_passwd is unavailable. open database /etc/postfix/sasl_passwd.db: No such file or directory
```

## Now that your test mail is working 

## After you have configured your `php.ini` file. You still have errors?

check you php logs folder `/opt/lampp/logs` especially the `error_log` file
```
$ gedit /opt/lampp/logs/error_log
``` 

The error reads thus

```
sendmail: /opt/lampp/lib/libstdc++.so.6: version `CXXABI_1.3.8' not found (required by /usr/lib/x86_64-linux-gnu/libicuuc.so.60)
```

This is a registered Apache Bug at [Apache Friends Support Forum](https://community.apachefriends.org/f/viewtopic.php?f=17&t=74404&p=252421&hilit=sendmail+solved&sid=f130671f03aaad434c5e5a975278cff7#p252421) and the solution is to move 
```
 $ sudo mv /opt/lampp/lib/libstdc++.so.6 /opt/lampp/lib/libstdc++.so.6.orig
```
Restart Xampp
```
$ sudo /opt/lampp/lampp restart
```

You should get a 1 whenever you run the php `mail()` function

### UNCONFIRMED