# Forward
## What is it?
A forward is a piece of software which you can put on a website (or directory or subdomain). It will then forward all
traffic to that page to another location.

For example, if you put this piece of code on the domain `foo.com` and configure it to redirect to `bar.com`, all
traffic to this domain will end up at `bar.com`

## How can i use it?
### Downloading & Installation
First go to https://github.com/DonMul/forward and download this code by pressing the green `Clone or download` button
and then pressing `Download zip`.

This codebase will then be downloaded. After the download is done, you should extract the zip that just downloaded and
the codebase in these need to be uploaded with your favorite client to your website. If you want to redirect all traffic
to your website, you need to put it in the document root of your website, or if you want to redirect a specific 
directory, create that directory and upload this to that directory.

### Configuration
Once everything is in place, you'll need to configure it. This can be done by going to the location that needs to be 
redirected and add a `/admin` to it. For example, if you uploaded this to `foo.com/bar`, go to `foo.com/bar/admin`.
This will show you a page which requires you to input an URL and a password. The URL should be the url the redirection
should go to. The password is `DMf0rwardP@ssword` by default, but this can be changed.

### Change password
If you want to change the password, you should edit the `configure.php` file. On line 13, you'll see 
```php
    private const PASSWORD = 'DMf0rwardP@ssword';
```

If you want to change the password, you'll need to edit what's between the quotes (`'`). For example, if you want to
change the password to `foobar`, it will end up looking like this:
```php
    private const PASSWORD = 'foobar';
```