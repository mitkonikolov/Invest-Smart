Invest_smart
============

Project Description:

Invest smart allows users to create stock portfolios. As users generate and/or edit their portfolio, a plot
representing cost of portfolio vs time for the last two years updates simultaneously. As stated in the project's
requirements, stock data is gotten from Yahoo Finance.

I have used PHP annotations as much as possible besides for the config files, where although it's possible to
use PHP annotations, I used YAML as the files are auto-generated by Symfony in YAML and I only had to edit them
where desired.

I used the FOSUserBundle for the log in and registration forms of my application. I also give the user the opportunity
to change their usernames and emails.



Installation:
git clone https://github.com/mitkonikolov/Invest-Smart.git
composer install
bin/console doctrine:database:create



Timesheet:
I have significant experience in development with Java and C++. Before I made this application, I also had a limited
experience with PHP and MySQL, and I had made a very simple web application before.

To make this application, I had to start from the very basics and I spent time to:
Learn Symfony basics and undestand better web development - 12 hours
Integrate FOSUserBundle in my project - 2.5 hours
Fetch data from Yahoo Finance - 5 hours
Draw diagram - 5 hours

I know that this time is certainly not the best, but as I said this was my first application ever. I am sure that
in my future work I will be significantly faster and create a lot better designed code.
