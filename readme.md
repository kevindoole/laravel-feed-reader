## Laravel + Vue Feed Gurgitator
This package lets you load in some data from various RSS feeds of your choosing
in order to display them in your browser, for a smooth and elegant reading
experience.

### Installation
Make sure you have VirtualBox and Vagrant installed so that you can run the
package as a virtual environment on your computer.

- [Install VirtualBox](https://www.virtualbox.org/wiki/Downloads)
- [Install Vagrant](https://www.vagrantup.com/downloads.html)
- Install Vagrant::Hostsupdater:
`$ vagrant plugin install vagrant-hostsupdater`

Once the VM stuff is installed, clone this repo and set it up:
```bash
$ git clone git@github.com:kevindoole/laravel-feed-reader.git
$ cd laravel-feed-reader
```

Install dependencies and set up the virtual machine:
```bash
$ composer install
$ php vendor/bin/homestead make # configure the VM environment
$ # vendor\bin\homestead make on windows
```

Install and boot the VM -- this might take a few minutes...
```bash
$ vagrant up
```
<small>This will set up your hosts file for you. On Mac, the terminal will ask you
for your password, but on Windows, you'll need to run your console with
administrator privileges so that it can edit your hosts file.</small>

At this point, you're pretty much there. Just need to log into the new VM and
load some feeds. And then read them.
```bash
$ vagrant ssh
$ cd /vagrant
$ mv .env.example .env # sets up some Laravel environment variables for you
$ php artisan migrate # set up the database
$ php artisan key:generate # set the application key
$ php artisan feeds:load http://your-fave-feed1.com/rss,
  http://your-fave-feed2.com/rss, etc
```

That last command loads all your feeds. Once it finishes, jump over to your
your favourite browser (which I hope is the latest version of Chrome, because
that's everywhere I've tested this thing) and visit http://laravel-feed-reader/, which
*should* be pointing you to your new VM.
