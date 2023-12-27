# NaBs: News and Blog System
A simple system for a blog or small news site that's easy for writers and you can get up and running fast.

### Warning: This is a work in progress, changes will probably break stuff

Features:
  - create blog or news posts easily
  - only people with accounts can edit posts
  - layouts and styles easy to apply to posts
  - can make your own layouts and styles with html and css

Coming soon:
  - customisable homepage that updates automatically
  - documentation
  - tags for posts
  - more layouts and styles out of the box
  - properly tested
  - writer overview page
  - create pages using a page template
  - writers with lower permission levels

Requirements:
  - PHP
  - SQLite
  - Any Web server, such as apache or lighttpd (testing pending)
  - A domain name (can be added later, or get a free subdomain at https://freedns.afraid.org)
  - Lets Encrypt Certbot (optional - for tls (https))

Quick Setup:
  - Follow any instructions to setup your web server with PHP and SQLite (if using)
  - Set up tls (https) with certbot (optional)
  - Clone this repo
  - Set the document root to be the news-and-blog-system directory
  - Set up redirecting to index (not needed for apache)
  - navigate to https://your.url/write and login as admin (initial password NaBs123) and set up a writer account
  - Start writing! (https://your.url/write)

Feel free to fork or clone (pls credit me)
